<?php
namespace phyzikz\TransHandler;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

// csaninak helper osztály
class TransHandler
{

    private $yamlDirectory = 'translations';
    private $yamlFile = '';

    private $langName = '';

    private $transArray = [];

    public function getLangName()
    {
        return $this->langName;
    }

    public function setLangName($langName)
    {
        $this->langName = $langName;
        $this->setYamlFile();
    }

    public function getYamlDirectory()
    {
        return $this->yamlDirectory;
    }

    public function setYamlDirectory($yamlDirectory)
    {
        $this->yamlDirectory = $yamlDirectory;
    }

    public function createYamlDirectory()
    {
        if (!file_exists($this->yamlDirectory)) 
        {
            return mkdir($this->yamlDirectory, 0777, true);
        }
        return true;
    }

    private function setYamlFile()
    {
        $this->yamlFile =  str_replace('/', DIRECTORY_SEPARATOR, $this->yamlDirectory . "/" . $this->langName . '.yaml');
    }

    public function getTransArray()
    {
        return $this->transArray;
    }

    public function setTransArray($transArray)
    {
        $this->transArray = $transArray;
    }

    public function getTrans($key)
    {
        if (array_key_exists($key, $this->transArray)) 
        {
            return $this->transArray[$key];
        }
        return false;
    }

    public function setTrans($key, $value)
    {
        $this->transArray[$key] = $value;
    }

    public function isLangExists($langName)
    {
        $yamlFile =  str_replace('/', DIRECTORY_SEPARATOR, $this->yamlDirectory . "/" . $langName . '.yaml');
        if (file_exists($yamlFile)) 
            return true;
        return false;
    }

    public function parseYaml($langName="") 
    {
        if ($langName != "")
            $this->setLangName($langName);
        if (!file_exists($this->yamlFile)) 
            return false;
        if (($yaml = file_get_contents($this->yamlFile)) === false) 
            return false;
        try 
        {
            $this->transArray = Yaml::parse($yaml);
        }
        catch (ParseException $e) 
        {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
            die();
        }   
        $this->transArray = Yaml::parse($yaml);
        return true;
    }

    public function createYaml() 
    {
        if (file_put_contents($this->yamlFile, Yaml::dump($this->transArray)) === false)
            return false;
        return true;
    }
    

}


# PHP Translation
##A translation handler class using symfony/yaml

Please read the [docs of symfony/Yaml component](https://symfony.com/doc/current/components/yaml.html)

## How to use:

### Initialize class:
```
require_once 'vendor/autoload.php';
use \phyzikz\TransHandler\TransHandler as TH;
$t = new TH();
```

Your translations will be held at default yaml directory, `./translations`.
You can change this directory or get current translation directory
```
$t->setYamlDirectory($yamlDirectory);   // set
$yamlFolder = $t->getYamlDirectory();   // get
```

### Creating directory if not exists
```
$t->->createYamlDirectory();
```

### Setting desired language / locale / whatever name
```
$t->setLangName('de'); 
```

### Creating translation file from code
```
$t->setLangName('de'); 
$t->setTrans('Welcome', 'Willkommen');  // key, value
$t->setTrans('Hello', 'Hallo');         // key, value
$t->createYaml();                       // saves de.yaml with given key, value pairs              
```

### Extending translation file from code
```
if (!$t->isLangExists('de'))            // checking language file
{
    die("Missing file.");
}
/*
$t->setLangName('de');                  // desired language file
$trans->parseYaml();                    // reading and parsing translation
*/
$trans->parseYaml('de');                // shorthand for setLanguage and parseYaml

$t->setTrans('motorcycle racing', 'Motorradrennen');
$t->createYaml();                       // saves / overwrites de.yaml with extended key/value pairs
```

### Using translation keys
```
$t->parseYaml('hu'); 
echo $t->getTrans('Greetings')."<br>";
```

### Using translation array
```
$t->parseYaml('hu');
$tArray = $t->getTransArray();          // puts translations into an array
foreach($tArray as $k => $v)            // dumping all translation
    echo $k.": ".$v."<br>";
```

### Adding translation outside the class and writing back to file
```
$t->parseYaml('hu');
$tArray = $t->getTransArray();          // puts translations into an array
$tArray['cucumber'] = 'uborka';
$t->setTransArray($tArray);             // fills class variable
$t->createYaml();                       // writing out
echo "<pre>";
var_dump($trans->getTransArray());      // dumps current class var
echo "</pre>";
```


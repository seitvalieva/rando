<?php

namespace App;

class Autoloader {
    
    public static function register(){

        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($class) {

        //$class = Model\Managers\TopicManager (FullyQualifiedClassName)
        //namespace = Model\Managers, nom de la classe = TopicManager

        $parts = preg_split('#\\\#', $class);
		//$parts = ['Model', 'Managers', 'TopicManager']

        $className = array_pop($parts);
		//$className = TopicManager

        $path = strtolower(implode(DS, $parts));
        //$path = 'model/manager'

		$file = $className.'.php';
		//$file = TopicManager.php

        $filepath = BASE_DIR.$path.DS.$file;
		//$filepath = model/managers/TopicManager.php

		if(file_exists($filepath)){
			require $filepath;
		}
    }
}
<?php
spl_autoload_register(function ($classname) {
    $classname = str_replace('App\\', "", $classname);
    $classname = "./" . str_replace('\\', '/', $classname . '.php');
 	if(file_exists($classname)){
 		require_once($classname);
 	}  
});

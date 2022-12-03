<?php
spl_autoload_register(function ($className) {
    $className = str_replace('App\\', "", $className);
    $className = "./" . str_replace('\\', '/', $className . '.php');
    require_once($className);
});
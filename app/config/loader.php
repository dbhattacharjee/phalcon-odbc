<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
)
->registerNamespaces(
    [
         "FutureFoam\PhalconPHP\PROGRESSQQL\Adapter" => APP_PATH."/library/db/Adapter/",
         "FutureFoam\PhalconPHP\PROGRESSQQL\Dialect" => APP_PATH."/library/db/Dialect/",
        "FutureFoam\Model" => APP_PATH."/models/" 
    ]
)        
->register();

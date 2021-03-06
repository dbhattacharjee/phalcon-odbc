<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;

use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $this);

            $volt->setOptions([
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ]);

            return $volt;
        },
        '.phtml' => PhpEngine::class

    ]);

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();
    putenv("ODBCINI=/etc/odbc.ini");
//    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
//    $connection = new $class([
//        'host'     => $config->database->host,
//        'username' => $config->database->username,
//        'password' => $config->database->password,
//        'dbname'   => $config->database->dbname,
//        'charset'  => $config->database->charset,
//        'dsn'  => $config->database->dsn
//    ]);
//
//    return $connection;
    $eventsManager = new EventsManager();

$eventsManager->attach(
    "db:afterQuery",
    function (Event $event, $connection) {
        echo 'Q : =>'.$connection->getSQLStatement().'<br/><BR/>';
    }
);

    $class = 'FutureFoam\PhalconPHP\PROGRESSQQL\Adapter\\' . $config->database->adapter;
    try{
    $connection = new $class([
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset,
        'dsn'  => $config->database->dsn
    ]);
    }  catch (\Exception $e) {
        echo 'E:'.$e->getMessage();die;
    }
    $connection->setEventsManager($eventsManager);
    return $connection;
});

//$config = $this->getConfig();
//echo $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

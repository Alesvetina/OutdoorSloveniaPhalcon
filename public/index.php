<?php
require '../app/config/Config.php';
require '../vendor/autoload.php';

try {
    // Autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs([
        '../app/controllers/',
        '../app/models/',
        '../app/config/'
    ]);

    $loader->registerClasses([
        'Component\User' => '../app/components/User.php',
        'Component\Helper' => '../app/components/Helper.php',
        'Component\View' => '../app/components/View.php',
        'Component\Form' => '../app/components/Form.php'
    ]);

    $loader->register();


    // Dependancy Injection
    $di = new \Phalcon\DI\FactoryDefault();

    // Return CONFIG
    $di->setShared('config', function() use ($config){
        return $config;
    });

    // Session
    $di->setShared('session', function() {
        $session = new \Phalcon\Session\Adapter\Files();
        $session->start();
        return $session;
    });

    // Return custom components
    $di->setShared('component', function() {
        $obj = new stdClass();
        $obj->helper = new \Component\Helper;
        $obj->user = new \Component\User;
        $obj->view = new \Component\View;
        $obj->form = new \Component\Form;
        return $obj;
    });

    // Database
    $di->set('db', function() use ($di) {
        $dbConfig = (array) $di->get('config')->get('db');
        $db = new \Phalcon\Db\Adapter\Pdo\Mysql($dbConfig);
        return $db;
    });

    // View
    $di->set('view', function() {
        $view = new \Component\View;
        $view->setViewsDir('../app/views');
        $view->registerEngines([
            ".volt" => 'Phalcon\Mvc\View\Engine\Volt'
        ]);
        return $view;
    });

    // Routing
    $di->set('router', function() {
        $router = new \Phalcon\Mvc\Router();
        $router->mount(new GlobalRoutes());
        return $router;
    });

    // Flash Data
    $di->set('flash', function() {
        $flash = new \Phalcon\Flash\Session([
            'error'     => 'alert alert-danger',
            'success'   => 'alert alert-success',
            'notice'    => 'alert alert-info',
            'warning'   => 'alert alert-warning'
        ]);
        return $flash;
    });

    // Meta-Data
    $di['modelMetadata'] = function() {
        $metaData = new \Phalcon\Mvc\Model\MetaData\Apc([
            'lifetime' => 86400,
            'prefix' => 'metaData'
        ]);
        return $metaData;
    };

    // Custom Dispatcher
    $di->set('dispatcher', function() use ($di) {
        $eventsManager = $di->getShared('eventsManager');

        // Custom ACL Class
        $permission = new Permission();

        // Listen for events from the permission class
        $eventsManager->attach('dispatch', $permission);

        $dispatcher = new \Phalcon\Mvc\Dispatcher();
        $dispatcher->setEventsManager($eventsManager);
        return $dispatcher;
    });

    // Deploy The App
    $app = new \Phalcon\Mvc\Application($di);
    echo $app->handle()->getContent();
}
catch(\Phalcon\Exception $e) {
    echo $e->getMessage();
}
<?php

$start = microtime(true);
$link = $_SERVER['PHP_SELF']; // gets self URL of index.php
$fullUrl = parse_url($link); // parse URL
$requestFile = substr($fullUrl['path'], strrpos($fullUrl['path'], 'index.php') + 10); // breaks the URL by /
require 'services.php';
require coreDir . 'initialize.php'; // calling initialization of object

if ($requestFile == FALSE) {
    $requestFile = defaultPage; // landing page definition
}
$status = (new mapper())->getController($requestFile, $path); // validates the path defined in path.php
if ($status == '404') {
    (new error())->fileNotFound(); // shows error if file not found
} elseif ($status == 'ctrlError') {
    (new error())->codingError($requestFile); // shows error if path is define incorrectly
} else {
    if (count($status) == 3) {
        $controllerClass = $status['controller']; // controller class name from path file
        $function = $status['function']; // function name from path file
        $argument = $status['argument']; // argument from the path fle
        if ($argument == 'any') {
            $filename = $requestFile; // loads any file with any name if exists
        } else {
            $filename = $argument; // loads specific file if defined in path file
        }
        callController($controllerClass, $function, $filename);
    } elseif (count($status) == 2) {
        $controllerClass = $status['controller']; // controller class name from path file
        $function = $status['function']; // function name from path file
        callController($controllerClass, $function);
    }
}

function callController($controllerClass, $function, $filename = NULL) {
    if (file_exists(controllerDir . $controllerClass . '.php')) {
        require controllerDir . $controllerClass . '.php';
        if (array_search($controllerClass, get_declared_classes())) {// checks name of controller class
            searchExecuteMethod($controllerClass, $function, $filename); // search and execute method inside a controller class
        } else {
            (new error())->noController($controllerClass);
            exit();
        }
    } elseif (!file_exists(controllerDir . $controllerClass . 'php') && environment == 'development') {
        (new error())->noController($controllerClass);
        exit();
    } else {
        (new error())->fileNotFound();
        exit();
    }
}

function searchExecuteMethod($controllerClass, $function, $filename) {
    if (array_search($function, get_class_methods($controllerClass))) {
        (new $controllerClass())->$function($filename); // Oneliner object create and method calling (PHP 5.4 +)
    } else {
        (new error())->noMethodError();
        exit();
    }
}

function redirect($path, $refresh = NULL, $http_response_code = 302) {
    if ($refresh == 'refresh' || $refresh == 'REFRESH') {
        echo 'here';
        header("Location: " . $path, TRUE, $http_response_code);
    } else {
        header("Refresh:0;url=" . $path);
    }
}

//echo $time_elapsed_us = microtime(true) - $start;

<?php

namespace src\application\core;

class Route
{
    public static function applicationStart()
    {
        $controllerName = 'Main';
        $actionName = 'index';
        $routes = explode('/', filter_input(INPUT_SERVER, 'REQUEST_URI'));

        if (! empty($routes[1])) {
            $controllerName = $routes[1];
        }

        if (! empty($routes[2])) {
            $actionName = $routes[2];
        }

        $modelName = 'Model'.ucfirst($controllerName);
        $controllerName = 'Controller'.ucfirst($controllerName);
        $actionName = $actionName.'Action';
        $modelFile = $modelName.'.php';
        $modelPath = "src/application/models/".$modelFile;

        if (file_exists($modelPath)) {
            include "src/application/models/".$modelFile;
        }

        $controllerFile = $controllerName.'.php';
        $controllerPath = "src/application/controllers/".$controllerFile;

        if (file_exists($controllerPath)) {
            include "src/application/controllers/".$controllerFile;
        } else {
            Route::errorPage();
        }

        $controllerName = "src\application\controllers\\".ucfirst($controllerName);
        $controller = new $controllerName;
        $action = $actionName;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Route::errorPage();
        }
    }

    public static function errorPage()
    {
        $host = 'http://'.filter_input(INPUT_SERVER, 'HTTP_HOST').'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}

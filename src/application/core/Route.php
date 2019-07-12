<?php
namespace src\application\core;

class Route
{
    public static function start()
    {
        $controllerName = 'Main';
        $actionName = 'index';
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if ( !empty($routes[1]) ) {
            $controllerName = $routes[1];
        }

        if ( !empty($routes[2]) ) {
            $actionName = $routes[2];
        }

        $modelName = 'Model'.ucfirst($controllerName);
        $controllerName = 'Controller'.ucfirst($controllerName);
        $actionName = $actionName.'Action';
        $modelFile = $modelName.'.php';
        $model_path = "src/application/models/".$modelFile;

        if(file_exists($model_path)) {
            include "src/application/models/".$modelFile;
        }

        $controllerFile = $controllerName.'.php';
        $controllerPath = "src/application/controllers/".$controllerFile;

        if(file_exists($controllerPath)) {
            include "src/application/controllers/".$controllerFile;
        } else {
            Route::ErrorPage404();
        }

        $controllerName = "src\application\controllers\\".ucfirst($controllerName);
        $controller = new $controllerName;
        $action = $actionName;

        if(method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Route::ErrorPage404();
        }
    }

    public static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}

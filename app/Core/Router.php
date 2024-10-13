<?php

namespace App\Core;

class Router {
    public function dispatch($uri, $db) {
        $uri = trim($uri, '/');
        $segments = explode('/', $uri);

        $controller = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
        $action = !empty($segments[1]) ? $segments[1] : 'index';

        $controllerClass = 'App\\Controllers\\' . $controller;

        if (class_exists($controllerClass)) {
            $controllerObject = new $controllerClass($db);
            if (method_exists($controllerObject, $action)) {
                if (!empty($segments[2])) {
                    $controllerObject->$action($segments[2]);
                } else {
                    $controllerObject->$action();
                }
            } else {
                echo "Akcja $action nie została znaleziona.";
            }
        } else {
            echo "Kontroler $controllerClass nie został znaleziony.";
        }
    }
}

<?php

namespace Api\Core;

class Router {

    protected static $routes;

    public static function getPageRoute($route = "") {
        if(stream_resolve_include_path("Api/Config/routes.inc")) {
            $router = include "Api/Config/routes.inc";
            self::$routes = $router['routes'];

            $page = "";

            if ($route) {
                $routeInfo = self::getControllerMethod($router["not-found"]);
            } else {
                $routeInfo = self::getControllerMethod($router["default"]);
                $page = $router["default"];
            }
            $route = rtrim($route, '/');
            $route .= "/";
            $controller = $routeInfo["controller"];
            $method = $routeInfo["method"];
            $params = [];

            foreach (self::$routes as $key => $value) {
                $regexKey = str_replace('/', '\/', $key);
                $regexKey = str_replace('*', '([^\/].+)?', $regexKey);
                if (preg_match("/^$regexKey\/$/", $route, $routeParams)) {
                    if (sizeof($routeParams) > 1) {
                        $routeParams = rtrim($routeParams[1], '/');
                        $params = explode('/', filter_var($routeParams, FILTER_SANITIZE_URL));
                    }
                    $routeInfo = self::getControllerMethod($key);
                    $controller = $routeInfo["controller"];
                    $method = $routeInfo["method"];
                    isset($value['page']) ? $page = $value['page'] : $page = $key;
                }
            }

            return [
                "controller" => $controller,
                "method" => $method,
                "page" => $page,
                "params" => $params
            ];

        } else {
            die ("Cannot find routes.inc inside Config folder");
        }
    }

    protected static function getControllerMethod($route) {
        !isset(self::$routes[$route]['controller']) and die("Cannot find controller for route: $route");
        !isset(self::$routes[$route]['method']) and die("Cannot find controller for route: $route");

        return [
            "controller" => self::$routes[$route]['controller'],
            "method" =>self::$routes[$route]['method']
        ];
    }

    public static function getRoutes() {
        return self::$routes;
    }

}

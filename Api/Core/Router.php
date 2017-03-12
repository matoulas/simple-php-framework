<?php

namespace Api\Core;

class Router {

    protected static $routes;

    public static function getPageRoute($route = "") {
        if(stream_resolve_include_path("Api/Config/routes.inc")) {
            $router = include "Api/Config/routes.inc";
            self::$routes = $router['routes'];
            $route ? $routeInfo = self::getControllerMethod($router["not-found"]) : $routeInfo = self::getControllerMethod($router["default"]);
            $route = rtrim($route, '/');
            $route .= "/";
            $controller = $routeInfo["controller"];
            $method = $routeInfo["method"];
            $page = "";
            $params = [];

            foreach (self::$routes as $key => $value) {
                $regexKey = str_replace('/', '\/', $key);
                if (preg_match("/^$regexKey\/([^\/].+)?$/", $route, $routeParams)) {
                    (sizeof($routeParams) > 1) and $params = explode('/', filter_var($routeParams[1], FILTER_SANITIZE_URL));
                    $routeInfo = self::getControllerMethod($key);
                    $controller = $routeInfo["controller"];
                    $method = $routeInfo["method"];
                    isset($value['page']) and ($page = $value['page']);
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

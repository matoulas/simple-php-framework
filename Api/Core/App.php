<?php

namespace Api\Core;

class App {

    protected $controller, $method;

    public function __construct() {
        $this->initController();
        Database::initialize();
    }
    
    protected function initController() {
        isset($_GET['url']) ? $url = $_GET['url'] : $url = "";
        $routerData = Router::getPageRoute($url);
        $page = $routerData['page'];
        $pagePath = $url;
        $params = $routerData['params'];

        $this->controller = new $routerData["controller"]($params);
        $this->method = $routerData["method"];
        call_user_func([$this->controller, 'config'], $page, $pagePath);
    }
    
    protected function startApp() {
        (method_exists($this->controller, $this->method)) ?
            call_user_func([$this->controller, $this->method]) :
            die ("Method '$this->method' does not exists in '".get_class($this->controller)."'");

        Database::me()->clear();
    }
}

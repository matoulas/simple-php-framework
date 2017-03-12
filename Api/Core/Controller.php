<?php

namespace Api\Core;

class Controller {

    protected $params,
              $view,
              $page,
              $pagePath,
              $layout,
              $assets;

    public function __construct($params = "") {
        $this->params = $params;
        $this->layout = 'Api/Views/layouts/layout.php';
    }

    protected function loadView($view = "", $data = []) {
        $this->view = $view;
        stream_resolve_include_path($this->layout) ? require($this->layout) : die ("Layout '$this->layout' does not exists");
    }

    protected function appendView($data = []) {
        if (stream_resolve_include_path("Api/Views/$this->view.php")) {
            extract($data);
            require("Api/Views/$this->view.php");
        } else {
            die ("View '$this->view.php' does not exists");
        }
    }

    protected function getMainRoutes() {
        return Router::getRoutes();
    }

    public function config($page = "", $pagePath = "") {
        $this->page = $page;
        $this->pagePath = $pagePath;
    }
    
    protected function i18n($key) {
        return Language::i18n($key);
    }

    public function getPagePath() {
        return $this->pagePath;
    }
}

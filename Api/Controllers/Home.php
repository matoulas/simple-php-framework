<?php

namespace Api\Controllers;

use Api\Core\Controller;

class Home extends Controller {

    public function index() {
        $data = [
            "params" => []
        ];

        if (sizeof($this->params) > 0) {
            $data = [
                "params" => $this->params
            ];
        }

        $this->assets = [
            "title" => "Simple Php Framework"
        ];

        $this->loadView("main/home.view", $data);
    }
}
<?php

namespace Api\Controllers;

use Api\Core\Controller,
    Api\Models\Home as HomeModel;

class Home extends Controller {

    public function index() {
        /*$data = [
            "params" => []
        ];

        if (sizeof($this->params) > 0) {
            $data = [
                "params" => $this->params
            ];
        }*/

        $this->assets = [
            "title" => "Simple Php Framework"
        ];

        $home  = new HomeModel();
        $name = $home->getInfo();
        $this->loadView("main/home.view", ["name" => $name]);
    }
}
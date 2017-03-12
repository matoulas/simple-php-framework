<?php

namespace Api\Controllers;

use Api\Core\Controller;

class NotFound extends Controller {

    public function index() {
        $this->loadView("main/404.view");
    }

}
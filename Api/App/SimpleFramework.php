<?php

namespace Api\App;

use Api\Core\App;

class SimpleFramework extends App {

    public function startApp() {
        ApplicationLanguage::configLocalization();
        parent::startApp();
    }
}

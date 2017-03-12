<?php

namespace Api\App;

use Api\Core\Language;

class ApplicationLanguage extends Language{

    public static function configLocalization() {
        parent::config('en');
    }

}
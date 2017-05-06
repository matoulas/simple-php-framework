<?php

namespace Api\App;

class Utils {

    public static function isInteger($value) {
        if (preg_match("/^\d+$/", $value, $output_array)) {
            return intval($value);
        }
        return false;
    }
}
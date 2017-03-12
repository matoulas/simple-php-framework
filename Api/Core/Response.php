<?php

namespace Api\Core;

class Response {

    public static function success() {
        return [
            "code" => 200,
            "description" => "Success"
        ];
    }

    public static function invalidRequest() {
        return [
            "code" => -500,
            "description" => "Invalid Request"
        ];
    }

    public static function accessDenied() {
        return [
            "code" => -403,
            "description" => "Access Denied"
        ];
    }

    public static function invalidCredentials() {
        return [
            "code" => -401,
            "description" => "Invalid Credentials"
        ];
    }

    public static function json() {
        header('Content-Type: application/json');
    }

    public static function xml() {
        header("Content-type: text/xml");
    }

    public static function javascript() {
        header('Content-Type: application/javascript');
    }

    public static function css() {
        header("Content-type: text/css; charset: UTF-8");
    }

    public static function image($mimeType = "") {
        header("Content-type: $mimeType");
    }

}
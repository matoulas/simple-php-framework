<?php

    return [
        "default" => "home",
        "not-found" => "404",

        "routes" => [
            "home" => [
                "controller" => 'Api\Controllers\Home',
                "method" => "index"
            ],

            "404" => [
                "controller" => 'Api\Controllers\NotFound',
                "method" => "index"
            ]
        ]
    ];
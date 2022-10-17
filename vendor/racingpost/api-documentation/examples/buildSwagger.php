<?php

require "../../../autoload.php";

$main = [
    "swagger" => "2.0",
    "info" => [
        "version" => 'v1',
        "title" => "Racingpost Horses API"
    ],
    "host" => "p1-api.rp-dev.com",
    "basePath" => "/horses",
    "schemes" => [
        "http",
        "https"
    ],
];

$swagger = new \RP\Documentation\Export\Swagger(new \RP\Documentation\Horses\Index());
$asd = $swagger->build('example.swagger', $main);
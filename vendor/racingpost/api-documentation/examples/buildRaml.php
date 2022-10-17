<?php

require "../../../autoload.php";

$main = [
    'title' => 'Horses REST API',
    'version' => '2',
    'mediaType' => 'application/json',
    'baseUri' => 'http://p1-api.rp-dev.com/horses',
    'protocols' => [
        'HTTP',
        'HTTPS'
    ],
];

$raml = new \RP\Documentation\Export\Raml(new \RP\Documentation\Horses\Index());
$asd = $raml->build('example.raml', $main);
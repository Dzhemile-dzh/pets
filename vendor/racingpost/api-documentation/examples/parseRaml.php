<?php

require "../../../autoload.php";

$inputDir = realpath(__DIR__ . '/../../../../') . '/raml';

$outputDir = realpath(__DIR__ . '/../../../../') . '/documentation/Documentation/Horses';
$namespace = 'RP\\Documentation\\Horses\\';

$parser = new \RP\Documentation\Parser\Raml2Php($inputDir);
$parser->parse($outputDir, $namespace);

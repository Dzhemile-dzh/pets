<?php

define('ROOT_DIR', realpath(__DIR__ . '/../'));
define('DATA_COLLECTOR_DISABLE', true);

require(ROOT_DIR . "/vendor/autoload.php");

include 'env.php';

/**
 * Read the configuration
 */
$config = new \Api\Config('_', '_API_HORSES');

/**
 * Include Services
 */
include ROOT_DIR . '/tests/services.php';

<?php

namespace PHREAPI;

use PHREAPI\kernel\Kernel;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$defaultAppDir = dirname(__FILE__, 2);

$kernel = new Kernel();

if(!defined('ROOT_DIR')) {
    throw new \RuntimeException('Could not find needed ROOT_DIR constant on boot-up.');
}

$kernel->init(ROOT_DIR ?? $defaultAppDir);

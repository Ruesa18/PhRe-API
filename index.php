<?php
const ROOT_DIR = __DIR__;
$http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
define('ROOT_URL', sprintf('%s://%s%s', $http, $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']));
require_once('vendor/autoload.php');
require_once('src/index.php');

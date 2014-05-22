<?php

require_once('vendor/autoload.php');
require_once('ext-packages/nest/nest.class.php');

require_once('vars.inc');

$data = json_decode(file_get_contents('router_data.json'));
$route = new cbulock\Simple\Router($_SERVER['REQUEST_URI'], $data, '\cbulock\home\Controller\\');
$route->get();
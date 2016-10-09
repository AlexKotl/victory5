<?php
ini_set('display_errors', 1);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'classes/class_screenshots.php';
require 'classes/class_database.php';
require 'controllers/capture.php';
require 'controllers/api.php';

// INIT

$config = array(
    'displayErrorDetails' => true,
    'webcam_url' => "https://streaming.ivideon.com/preview/live?server=100-6f53fb22b3db5a319ac2e83d472f0ab9&camera=0&sessionId=demo&q=2",
    'time_interval' => 60,
);

$routes = array(
    '/capture' => array(
        'action' => '\Capture:capture',
        'description' => 'Download and save picture from webcamera',
    ),

    '/api' => array(
        'action' => '\API:legend',
        'description' => 'Show all API functions',
    ),

    '/api/list' => array(
        'action' => '\API:getScreenshots',
        'description' => 'Get all screenshot records',
    )
);

$db = new Database("sqlite:db/victory.db");
$screenshots = new \Victory\Screenshots($config['webcam_url']);

$app = new \Slim\App([
    "settings" => $config,
    'db' => $db,
    'screenshots' => $screenshots,
    'routes' => $routes,
]);

// configure routes
foreach ($routes as $url => $data) {
    $app->get($url, $data['action']);
}


$app->run();

<?php
ini_set('display_errors', 1);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'classes/class_screenshots.php';
require 'classes/class_database.php';
require 'controllers/capture.php';
require 'controllers/api.php';
require 'controllers/site.php';
require 'config/config.' . ($_SERVER['SERVER_NAME'] === 'victory' ? 'dev' : 'production') . '.php';

// INIT

$routes = array(
	'/' => array(
		'action' => '\Site:index',
		'description' => 'Display frontend',
	),
	
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

$db = new Database($config['database']);
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

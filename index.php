<?php
ini_set('display_errors', 1);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//
//$res = $db->query('SELECT * FROM screenshots');
//while ($row = $res->fetch())
//{
//    echo $row['filename'] . "\n";
//}

require 'vendor/autoload.php';
require 'classes/class_screenshots.php';
require 'classes/class_database.php';
require 'controllers/capture.php';

// INIT

$config = array(
    'displayErrorDetails' => true,
    'webcam_url' => "https://streaming.ivideon.com/preview/live?server=100-6f53fb22b3db5a319ac2e83d472f0ab9&camera=0&sessionId=demo&q=2",
    'time_interval' => 60,
);

$db = new Database("sqlite:db/victory.db");
$screenshots = new \Victory\Screenshots($config['webcam_url']);

$app = new \Slim\App([
    "settings" => $config,
    'db' => $db,
    'screenshots' => $screenshots,
]);

$app->get('/capture', '\Capture:capture');

$app->run();

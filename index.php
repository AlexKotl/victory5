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

// INIT

$config = array(
    'webcam_url' => "https://streaming.ivideon.com/preview/live?server=100-6f53fb22b3db5a319ac2e83d472f0ab9&camera=0&sessionId=demo&q=2",

);

$db = new Database("sqlite:db/victory.db");
$screenshots = new \Victory\Screenshots($config['webcam_url']);

$app = new \Slim\App([
    "settings" => $config,
    'db' => $db,
    'screenshots' => $screenshots,
]);

$app->get('/capture', function (Request $request, Response $response) {

    $response->getBody()->write("<h1>Victory-V webcam capture</h1>");

    // check last time
    $last_timestamp = $this->db->getColumn("select timestamp from screenshots order by id desc limit 1");
    if (time() - $last_timestamp < 60 * 10) {
        die("Screenshot already retrieved. Come back later");
    }

    $screenshot = $this->screenshots->download();

    if ($screenshot) {
        $this->db->query("INSERT INTO `screenshots` 
            (`filename`,`timestamp`,`flag`) 
            VALUES ('{$screenshot['filename']}', '{$screenshot['timestamp']}', '1');");
    }
    else {
        die("Cannot download screenshot");
    }

    return $response;
});

$app->run();

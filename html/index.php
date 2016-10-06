<?php
ini_set('display_errors', 1);

$config = array(
    'webcam_url' => "https://streaming.ivideon.com/preview/live?server=100-6f53fb22b3db5a319ac2e83d472f0ab9&camera=0&sessionId=demo&q=2",
);


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// PDO TEST
$opt = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO("sqlite:../db/victory.db", "root", "root", $opt);

$stmt = $pdo->query('SELECT * FROM screenshots');
while ($row = $stmt->fetch())
{
    echo $row['filename'] . "\n";
}


require '../vendor/autoload.php';

$app = new \Slim\App(["settings" => $config]);

$app->get('/capture', function (Request $request, Response $response) {

    $response->getBody()->write("<h1>Victory-V webcam capture</h1>");

    $r = file_get_contents($this->settings['webcam_url']);
    
    if ($r) {
        file_put_contents(__DIR__ . "/upload/screenshots/" . time() . ".jpg", $r) or die("Cannot download file");
    }

    return $response;
});

$app->run();

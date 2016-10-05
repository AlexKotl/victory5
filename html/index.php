<?php
ini_set('display_errors', 1);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

$app->get('/capture', function (Request $request, Response $response) {

    $response->getBody()->write("<h1>Victory-V webcam capture</h1>");

    return $response;
});

$app->run();

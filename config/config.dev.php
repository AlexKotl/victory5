<?php
$config = array(
    'database' => array(
        'connection' => 'mysql:host=localhost;dbname=victory;charset=utf8', // for sqlite: sqlite:db/victory.db
        'user' => 'root',
        'password' => 'root',
    ),
    'displayErrorDetails' => true,
    'webcam_url' => "https://streaming.ivideon.com/preview/live?server=100-6f53fb22b3db5a319ac2e83d472f0ab9&camera=0&sessionId=demo&q=2",
    'time_interval' => 60,
);
<?php

namespace AxelSeemann\TestLog;

use WebSocket\Client;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/lib.php';

if(session_id()) {session_close();}

$id      = filter_var($_COOKIE['logbook'], FILTER_SANITIZE_STRING);
$cookies = [];

foreach ($_COOKIE as $key => $value) {
    $cookies[] = "$key=$value";
}

$client = new Client(
    "ws://{$settings['server']}:{$settings['port']}/api/v1/logbooks/$id/logs",
    [
        "options" => [
            "headers" => [
                "cookie: " . implode('; ', $cookies)
            ]
        ]
    ]
);

$client->setTimeout(60);
$timeOut = time() + 60;
$client->send('open');

if ($client->isConnected()) {
    while (time() < $timeOut) {
        $message = $client->receive();
        if ($message) {
            die($message);
        }
    }
}

<?php

$settingsFile = __DIR__ . '/settings.json';

$settings = [
    'server' => 'localhost',
    'port'   => '8088'
];

if (file_exists($settingsFile)) {
    $settings = json_decode(file_get_contents($settingsFile), true);
}

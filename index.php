<?php

require_once __DIR__ . '/UUID.php';

$content = file_get_contents('index.html');

$identifier = UUID::uuid5(UUID::NAMESPACE_DNS, 'logbook');

setcookie('logbook', $identifier, 0, '/', $_SERVER['HTTP_HOST']);

$replacements = [
    '{{.Identifier}}' => $identifier,
];

echo str_replace(array_keys($replacements), $replacements, $content);
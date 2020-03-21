<?php

require_once __DIR__ . '/UUID.php';

$content = file_get_contents(__DIR__ . '/index.html');

$identifier = UUID::uuid5(UUID::NAMESPACE_DNS, 'logbook');

setcookie('logbook', $identifier, 0, '/', $_SERVER['HTTP_HOST']);

shell_exec('find /tmp -type f -name "logbook*.log" -mtime +1 --delete');

$replacements = [
    '{{.Identifier}}' => $identifier,
];

echo str_replace(array_keys($replacements), $replacements, $content);
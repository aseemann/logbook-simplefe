<?php

require_once __DIR__ . '/lib.php';

$content = file_get_contents(__DIR__ . '/settings.html');
$isPost  = isset($_POST['server']) && isset($_POST['port']);

if ($isPost) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'server' && $key !== 'port') {
            unset($_POST[$key]);
            continue;
        }

        $_POST[$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }
    $settings = $_POST;
    file_put_contents($settingsFile, json_encode($settings, JSON_PRETTY_PRINT));
}

$replacements = [];
foreach ($settings as $key => $value) {
    $replacements['{{' . $key . '}}'] = $value;
}
echo str_replace(array_keys($replacements), $replacements, $content);
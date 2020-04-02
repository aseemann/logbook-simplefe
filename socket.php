<?php
namespace AxelSeemann\TestLog;
ini_set('display_errors','off');
session_abort();
header('Content-Type: application/json');
$message = null;
$file = "/tmp/logbook-" . $_COOKIE['logbook'] . ".log";
$timeOut = time() + 60;
$stateFile = "/tmp/logbook-" . $_COOKIE['logbook'] . ".state";

$line = 0;

if (file_exists($stateFile)) {
    $line = (int) file_get_contents($stateFile);
}
$line++;

while (time() < $timeOut) {
    $data = array_slice(file($file), $line, null, true);
    if (false === empty($data)) {
        end($data);
        $line = key($data);
        file_put_contents($stateFile, $line);
        die("[" . implode(',', $data) . "]");
    }
}

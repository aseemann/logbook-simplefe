<?php
namespace AxelSeemann\TestLog;
session_abort();
header('Content-Type: application/json');
$message = null;
$file = "/tmp/logbook-" . $_COOKIE['logbook'] . ".log";
$timeOut = time() + 60;
$lines = count(file($file));

while (time() < $timeOut) {
    $data = file($file);
    if (NULL !== $data[$lines]) {
        die(trim($data[$lines]));
    }
}
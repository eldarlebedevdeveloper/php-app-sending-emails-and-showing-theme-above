<?php
require_once __DIR__ . '/../src/cookies_deleting.php';
require_once __DIR__ . '/../host_connection.php';

$userData = $_COOKIE;
cookies_deleting($userData, $hostDomain);
header("Location: $hostPath");

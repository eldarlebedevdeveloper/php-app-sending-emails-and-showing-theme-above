<?php
require_once __DIR__ . '/../db/db_accesses.php';
require_once __DIR__ . '/../db/db_get_particular_user.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$userData = $_GET;
$user = db_get_particular_user($conn, $userData);

echo json_encode($user);

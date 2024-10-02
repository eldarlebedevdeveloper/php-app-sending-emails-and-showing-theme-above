<?php
require_once __DIR__ . '/../db/db_accesses.php';
require_once __DIR__ . '/../db/db_get_particular_user_id.php';
require_once __DIR__ . '/../db/db_table_exist.php';
require_once __DIR__ . '/../db/db_create_table_letters.php';
require_once __DIR__ . '/../db/db_add_letter.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$tableName = 'letters';
$letter = $_POST;
$uname = $letter['uname'];

$id = db_get_particular_user_id($conn, $uname);
$letterData = [...$letter, 'userid' => $id];

if (!db_table_exist($conn, $tableName)) {
    db_create_table_letters($conn);
    db_add_letter($conn, $letterData);
    $em = "The letter has been sent";
    header("Location: mailbox?success=$em");
} else {
    db_add_letter($conn, $letterData);
    $em = "The letter has been sent";
    header("Location: mailbox?success=$em");
    exit;
}

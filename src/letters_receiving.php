<?php
require_once __DIR__ . '/../db/db_accesses.php';
require_once __DIR__ . '/../db/db_get_particular_user_id.php';
require_once __DIR__ . '/../db/db_table_exist.php';
require_once __DIR__ . '/../db/db_get_all_letters.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);

$tableName = 'letters';
$userData = $_GET;
$uname = $userData['uname'];

if (db_table_exist($conn, $tableName)) {
    if (db_get_particular_user_id($conn, $uname)) {
        $userid = db_get_particular_user_id($conn, $uname);
    }
    $letters = db_get_all_letters($conn, $userid);


    $pageSize = $userData['pagesize'];
    $pageCount = ceil(count($letters) / $pageSize);

    $currentPage = (isset($userData['page'])) ? (int) $userData['page'] : 1;

    if ($currentPage < 1 || $currentPage > $pageCount) {
        $currentPage = 1;
    }

    $offset = ($currentPage - 1) * $pageSize;

    $lettersData = array(
        "count" => count($letters),
        "result" => array_chunk($letters, $pageSize),
    );

    $lettersData['next'] = ($currentPage < $pageCount) ? $currentPage + 1 : null;
    $lettersData['prev'] = ($currentPage > 1) ? $currentPage - 1 : null;

    echo json_encode($lettersData);
}

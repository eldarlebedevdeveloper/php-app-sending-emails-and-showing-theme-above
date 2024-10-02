<?php

function db_get_particular_user_id($conn, $uname)
{
    $sql = "SELECT id FROM users WHERE uname = :uname";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':uname', $uname, PDO::PARAM_STR);

    $stmt->execute();

    $userId = $stmt->fetch(PDO::FETCH_ASSOC);

    return $userId['id'];
}

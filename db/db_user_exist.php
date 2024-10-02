<?php

function db_user_exist($conn, $userData)
{
    $uname = $userData['uname'];

    $sql = "SELECT COUNT(*) FROM users WHERE uname = :uname";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':uname', $uname, PDO::PARAM_STR);

    $stmt->execute();

    $userExists = $stmt->fetchColumn() > 0;

    return (bool) $userExists;
}

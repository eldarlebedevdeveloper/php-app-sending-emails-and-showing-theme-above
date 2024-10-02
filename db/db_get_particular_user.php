<?php

function db_get_particular_user($conn, $userData)
{
    $uname = $userData['uname'];
    $sql = "SELECT email, uname, pass FROM users WHERE uname = :uname";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':uname', $uname, PDO::PARAM_STR);

    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user;
}

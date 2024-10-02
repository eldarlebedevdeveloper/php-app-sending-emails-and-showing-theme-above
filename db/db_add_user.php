<?php

function db_add_user($conn, $userData)
{
    try {
        $email = $userData['email'];
        $uname = $userData['uname'];
        $pass = $userData['pass'];
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO users (email, uname, pass)
        VALUES ('$email', '$uname', '$pass')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "New record created successfully";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}

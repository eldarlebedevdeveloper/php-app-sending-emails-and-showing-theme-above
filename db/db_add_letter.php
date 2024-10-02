<?php

function db_add_letter($conn, $letterData)
{
    try {
        $userid = $letterData['userid'];
        $recipient = $letterData['recipient'];
        $subject = $letterData['subject'];
        $message = $letterData['message'];
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO letters (userid, recipient, subject, message)
        VALUES ('$userid', '$recipient', '$subject', '$message')";
        // use exec() because no results are returned
        $conn->exec($sql);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}

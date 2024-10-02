<?php

function db_get_all_letters($conn, $userid)
{
    $sql = "SELECT * FROM letters WHERE uname = :uname";
    $sql = "SELECT id, userid, recipient, subject, message, reg_date FROM letters WHERE userid = :userid";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':userid', $userid);

    $stmt->execute();

    $letters = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($letters)) {
        echo "No user with this uname was found.";
        exit;
    }

    return $letters;
}

<?php

function db_table_exist($conn, $tableName)
{
    $sql = "SHOW TABLES LIKE :tableName";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':tableName', $tableName, PDO::PARAM_STR);

    $stmt->execute();

    $tableExists = $stmt->fetchColumn();

    return (bool) $tableExists;
}

<?php

function db_create_table_letters($conn)
{
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE letters (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userid VARCHAR(30) NOT NULL,
        recipient VARCHAR(50) NOT NULL,
        subject VARCHAR(100) NOT NULL,
        message VARCHAR(500) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        $conn->exec($sql);
        echo "Table Users created successfully";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
}

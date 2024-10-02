<?php

function cookies_authorization($userCookies)
{
    if (isset($userCookies['email']) && isset($userCookies['uname']) && isset($userCookies['pass'])) {
        require_once __DIR__ . '/../db/db_accesses.php';
        require_once __DIR__ . '/../db/db_table_exist.php';
        require_once __DIR__ . '/../db/db_user_exist.php';
        require_once __DIR__ . '/../db/db_get_particular_user.php';

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $tableName = 'users';
        $userData = array(
            'email' => $userCookies['email'],
            'uname' => $userCookies['uname'],
            'pass' => $userCookies['pass'],
        );
        $tableExist = db_table_exist($conn, $tableName);

        if ($tableExist) {

            $userExist = db_user_exist($conn, $userData);

            if ($userExist) {
                $user = db_get_particular_user($conn, $userData);
                $userData && $user ? $userValidation = array_diff_assoc($userData, $user) : $userValidation = false;

                if (empty($userValidation)) {
                    header("Location: mailbox");
                    exit;
                }
            }
        }
    }
}

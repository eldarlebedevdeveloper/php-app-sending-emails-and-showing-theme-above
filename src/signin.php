<?php
require_once __DIR__ . '/../host_connection.php';

$validation;
if (
    isset($_POST['uname']) &&
    isset($_POST['pass'])
) {

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $data = "uname=" . $uname;

    if (empty($uname)) {
        $validation = false;
        $em = "User name is required";
        header("Location: login?error=$em&$data");
        exit;
    } else if (empty($pass)) {
        $validation = false;
        $em = "Password is required";
        header("Location: login?error=$em&$data");
        exit;
    } else {
        $validation = true;
    }
} else {
    header("Location: login?error=error");
    exit;
}

if ($validation) {
    require_once __DIR__ . '/../db/db_accesses.php';
    require_once __DIR__ . '/../db/db_table_exist.php';
    require_once __DIR__ . '/../db/db_user_exist.php';
    require_once __DIR__ . '/../db/db_get_particular_user.php';
    require_once __DIR__ . '/../src/cookies_creation.php';

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);

    $tableName = 'users';
    $userData = array(
        'uname' => $uname,
        'pass' => base64_encode($pass),
    );

    if (!db_table_exist($conn, $tableName)) {

        $em = "Please create first account";
        header("Location: $hostPath?error=$em&$data");
        exit;
    }

    if (!db_user_exist($conn, $userData)) {
        $em = "Username does not exist";
        header("Location: login?error=$em&$data");
        exit;
    } else {
        $user = db_get_particular_user($conn, $userData);
        unset($user['email']);
        $userData && $user ? $userValidation = array_diff_assoc($userData, $user) : $userValidation = false;

        if (empty($userValidation)) {
            $user = db_get_particular_user($conn, $userData);
            cookies_creation($user);
            $em = "Successful authorization";
            header("Location: mailbox?success=$em");
            exit;
        } else {
            $em = "Username or password is incorrect";
            header("Location: login?error=$em&$data");
            exit;
        }
    }
}

<?php
require_once __DIR__ . '/../host_connection.php';

$validation;
if (
	isset($_POST['email']) &&
	isset($_POST['uname']) &&
	isset($_POST['pass'])
) {
	$email = $_POST['email'];
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];
	$data = "email=" . $email . "&uname=" . $uname;

	if (empty($email)) {
		$validation = false;
		$em = "Email is required";
		header("Location: $hostPath?error=$em&$data");
		exit;
	} else if (empty($uname)) {
		$validation = false;
		$em = "Username is required";
		header("Location: $hostPath?error=$em&$data");
		exit;
	} else if (empty($pass)) {
		$validation = false;
		$em = "Password is required";
		header("Location: $hostPath?error=$em&$data");
		exit;
	} else {
		$validation = true;
	}
} else {
	header("Location: $hostPath?error=error");
	exit;
}

if ($validation) {
	require_once __DIR__ . '/../db/db_accesses.php';
	require_once __DIR__ . '/../db/db_table_exist.php';
	require_once __DIR__ . '/../db/db_user_exist.php';
	require_once __DIR__ . '/../db/db_create_table_users.php';
	require_once __DIR__ . '/../db/db_add_user.php';
	require_once __DIR__ . '/../src/cookies_creation.php';

	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);

	$tableName = 'users';
	$userData = array(
		'email' => $email,
		'uname' => $uname,
		'pass' => base64_encode($pass),
	);

	if (!db_table_exist($conn, $tableName)) {
		db_create_table_users($conn);
		db_add_user($conn, $userData);
		cookies_creation($userData);
		$em = "Account created successfully";
		header("Location: mailbox?success=$em");
		exit;
	}

	if (!db_user_exist($conn, $userData)) {
		db_add_user($conn, $userData);
		cookies_creation($userData);
		$em = "Account created successfully";
		header("Location: mailbox?success=$em");
		exit;
	} else {
		$em = "Username with this username or email already exist";
		header("Location: $hostPath?error=$em&$data");
		exit;
	}
}

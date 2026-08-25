<?php

declare(strict_types=1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$username = $_POST["username"];
	$password = $_POST["passwd"];

	try {

		require_once 'dbh.inc.php';
		require_once 'login_model.inc.php';
		require_once 'login_contr.inc.php';

		if(is_input_empty($username, $password)) {
			$errors["empty_input"] = "Please fill in all fields";
		}
		if (is_username_taken($pdo, $username)){
			$errors["username_taken"] = "Username already taken!";
		}
		header("Location: ../index.php");
		die();
	} catch (PDOException $e) {
		die("Query failed: " . $e->getMessage());
	}
} else {
	header("Location: ../index.php");
	die();
}
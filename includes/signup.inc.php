<?php

declare(strict_types=1);

if($_SERVER["REQUEST_METHOD"] === "POST") {
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["passwd"];

	try {

		require_once 'dbh.inc.php';
		require_once 'signup_model.inc.php';
		//require_once 'signup_view.inc.php';
		require_once 'signup_contr.inc.php';

		// array that will collect validation errors.
		$errors = [];
		if(is_input_empty($username, $email, $password)) {
			$errors["empty_input"] = "Please fill in all fields";
		}
		if(is_email_invalid($email)) {
			$errors["invalid_email"] = "Please enter a valid email address!";
		}
		if (is_username_taken($pdo, $username)){
			$errors["username_taken"] = "Username already taken!";
		}
		if (is_email_regestred($pdo, $email)) {
			$errors["email_used"] = "Email already registred!";
		}

		require_once 'config_session.inc.php';

		if ($errors) {
			$_SESSION["errors_signup"] = $errors;
			foreach ($errors as $error){
				echo "<p>$error</p>";
			}
			die();
		}

	} catch (PDOException $e) {
		die("Query failed: " . $e->getMessage());
	}

} else {
	header("Location: ../index.php");
	die();
}
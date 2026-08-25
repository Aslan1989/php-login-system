<?php

declare(strict_types=1);

if($_SERVER["REQUEST_METHOD"] === "POST") {
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];

	require_once "signup_contr.inc.php";

	// array that will collect validation errors.
	$errors = [];
	if(is_input_empty($username, $email, $password)) {
		$errors["empty_input"] = "Please fill in all fields";
	}
	if(is_email_invalid($email)) {
		$errors["invalid_email"] = "Please enter a valid email address!";
	}

	if ($errors) {
		foreach ($errors as $error){
			echo "<p>$error</p>";
		}
		die();
	}
	echo "Validation successful!";
} else {
	header("Location: ../index.php");
	die();
}
<?php

declare(strict_types=1);

if($_SERVER["REQUEST_METHOD"] === "POST") {
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];

	echo "Signup request received.";
} else {
	header("Location: ../index.php");
	die();
}
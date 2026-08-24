<?php

$dsn = "mysql:host=localhost;dbname=logindatabase";
$dbUsername = "root";
$dbPassword = "";

try {
	$pdo = new PDO(
		$dsn,
		$dbUsername,
		$dbPassword
	);
} catch (PDOException $e) {
	die("Database connection failed: " . $e->getMessage());
}
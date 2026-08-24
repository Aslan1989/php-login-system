<?php

// use stricter type handling
declare(strict_types=1);

$dsn = "mysql:host=localhost;dbname=logindatabase";
$dbUsername = "root";
$dbPassword = "";

try {
	$pdo = new PDO(
		$dsn,
		$dbUsername,
		$dbPassword
	);
	$pdo->setAttribute(
		PDO::ATTR_ERRMODE,
		PDO::ERRMODE_EXCEPTION
	);
} catch (PDOException $e) {
	die("Database connection failed: " . $e->getMessage());
}
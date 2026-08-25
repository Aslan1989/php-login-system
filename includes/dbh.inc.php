<?php // Start the database connection script.

// Require strict type checking for any type declarations in this script.
declare(strict_types=1);
// Define the Data Source Name (DSN), which identifies the MySQL database to connect to.
$dsn = "mysql:host=localhost;dbname=logindatabase";
$dbUsername = "root";
$dbPassword = "";

try {
	// Create a PDO connection using the configured DSN and credentials.
	$pdo = new PDO(
		$dsn,
		$dbUsername,
		$dbPassword
	);
	// Configure PDO to throw exceptions when a database error occurs.
	$pdo->setAttribute(
		PDO::ATTR_ERRMODE,
		PDO::ERRMODE_EXCEPTION
	);
} catch (PDOException $e) {
	// Stop the request and show the database error when a connection cannot be made.
	die("Database connection failed: " . $e->getMessage());
}

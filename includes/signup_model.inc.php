<?php // Start the signup database model file.

declare(strict_types=1);

/**
 * Retrieves a username when it already exists in the database.
 *
 * @param object $pdo The database connection.
 * @param string $username The username to search for.
 * @return array|false The matching username record, or false when none exists.
 */
function get_username(object $pdo, string $username) 
{
	// Define a parameterized query that searches for the supplied username.
	$query = "SELECT username FROM users WHERE username = :username;";
	// Prepare the query before binding user-controlled data.
	$stmt = $pdo->prepare($query);
	// Bind the username value to its named placeholder.
	$stmt->bindParam(":username", $username);
	// Execute the prepared query.
	$stmt->execute();

	// Fetch one matching row as an associative array, or false if there is none.
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

/**
 * Retrieves an email address when it already exists in the database.
 *
 * @param object $pdo The database connection.
 * @param string $email The email address to search for.
 * @return array|false The matching email record, or false when none exists.
 */
function get_email(object $pdo, string $email) 
{
	// Define a parameterized query that searches for the supplied email address.
	$query = "SELECT email FROM users WHERE email = :email;";
	// Prepare the query before binding user-controlled data.
	$stmt = $pdo->prepare($query);
	// Bind the email value to its named placeholder.
	$stmt->bindParam(":email", $email);
	// Execute the prepared query.
	$stmt->execute();

	// Fetch one matching row as an associative array, or false if there is none.
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

/**
 * Hashes a password and inserts a new user record into the database.
 *
 * @param object $pdo The database connection.
 * @param string $username The new user's username.
 * @param string $email The new user's email address.
 * @param string $password The new user's plain-text password.
 */
function set_user(object $pdo,
    string $username,
    string $email,
    string $password) {
	// Define the parameterized query used to insert a new user record.
	$query = "INSERT INTO users (username, passwd, email) 
	VALUES (:username, :passwd, :email);";
	// Prepare the insert statement before binding values.
	$stmt = $pdo->prepare($query);

	// Configure the computational cost used by bcrypt password hashing.
	$options = [
		'cost' => 12
	];

	// Create a one-way bcrypt hash instead of storing the plain-text password.
	$hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);
	// Bind the username to the insert statement.
	$stmt->bindParam(":username", $username);
	// Bind the generated password hash to the insert statement.
	$stmt->bindParam(":passwd", $hashedPwd);
	// Bind the email address to the insert statement.
	$stmt->bindParam(":email", $email);
	// Execute the insert statement to create the user record.
	$stmt->execute();
}

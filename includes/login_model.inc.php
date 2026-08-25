<?php // Start the login database model file.

declare(strict_types=1);

/**
 * Retrieves a user record by username.
 *
 * @param object $pdo The database connection.
 * @param string $username The username to search for.
 * @return array|false The matching user record, or false when none exists.
 */
function get_user(object $pdo, string $username) 
{
	// Define a parameterized query that selects the user matching the supplied username.
	$query = "SELECT * FROM users WHERE username = :username;";
	// Prepare the query before binding user-controlled data.
	$stmt = $pdo->prepare($query);
	// Bind the username value to the named placeholder.
	$stmt->bindParam(":username", $username);
	// Execute the prepared query.
	$stmt->execute();

	// Fetch one matching row as an associative array, or false if there is none.
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

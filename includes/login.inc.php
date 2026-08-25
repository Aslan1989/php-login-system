<?php // Start the login form handler.

declare(strict_types=1);

// Only process requests submitted through the login form.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	// Read the username entered in the form.
	$username = $_POST["username"];
	// Read the password entered in the form.
	$password = $_POST["passwd"];

	// Catch database errors that may occur while processing the login.
	try {

		// Load the database connection, lookup function, and validation helpers.
		require_once 'dbh.inc.php';
		require_once 'login_model.inc.php';
		require_once 'login_contr.inc.php';

		// Create an empty list to collect validation or authentication errors.
		$errors = [];
		// Add an error when either required form field was left blank.
		if(is_input_empty($username, $password)) {
			$errors["empty_input"] = "Please fill in all fields";
		}

		// Look up the submitted username in the database.
		$result = get_user($pdo, $username);

		// Add a generic error when no account matches the username.
		if (is_username_wrong($result)){
			$errors["login_incorrect"] = "Incorrect login info!";
		}
		// Verify the password only when a matching user record was found.
		if (!is_username_wrong($result) && is_password_wrong($password, $result["passwd"])){
			$errors["login_incorrect"] = "Incorrect login infod!";
		}

		// Start the configured session so feedback or user data can be stored.
		require_once 'config_session.inc.php';

		// Return the user to the form when validation or authentication failed.
		if ($errors) {
			// Save the errors in the session so index.php can display them after the redirect.
			$_SESSION["errors_login"] = $errors;

			// Redirect back to the home page containing the login form.
			header("Location: ../index.php");
			die();
		}

		// Generate a unique ID for the authenticated session.
		$newSessionId = session_create_id();
		// Attach the user's database ID to the generated session ID.
		$sessionId = $newSessionId . "_" . $result["id"];
		// Apply the authenticated session ID.
		session_id($sessionId);

		// Store the user's ID to mark this session as authenticated.
		$_SESSION["user_id"] = $result["id"];
		// Store an HTML-escaped username so it is safe to output in the page.
		$_SESSION["user_username"] = htmlspecialchars($result["username"]);

		// Record the time at which the authenticated session ID was created.
		$_SESSION["last_generation"] = time();

		// Redirect to the home page with a flag that triggers the success message.
		header("Location: ../index.php?login=success");
		// Release the PDO connection and statement resources.
		$pdo = null;
		$stmt = null;
		die();
	} catch (PDOException $e) {
		// Stop the request and report a database query failure.
		die("Query failed: " . $e->getMessage());
	}
} else {
	// Send non-POST requests back to the home page without processing them.
	header("Location: ../index.php");
	die();
}

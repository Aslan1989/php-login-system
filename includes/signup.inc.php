<?php // Start the signup form handler.

declare(strict_types=1);

// Only process requests submitted through the signup form.
if($_SERVER["REQUEST_METHOD"] === "POST") {
	// Read the username supplied by the visitor.
	$username = $_POST["username"];
	// Read the email address supplied by the visitor.
	$email = $_POST["email"];
	// Read the password supplied by the visitor.
	$password = $_POST["passwd"];

	// Catch database errors that may occur while creating an account.
	try {

		// Load the database connection, model functions, and validation helpers.
		require_once 'dbh.inc.php';
		require_once 'signup_model.inc.php';
		require_once 'signup_contr.inc.php';

		// Create an empty array to collect validation errors.
		$errors = [];
		// Add an error when any required field was left blank.
		if(is_input_empty($username, $email, $password)) {
			$errors["empty_input"] = "Please fill in all fields";
		}
		// Add an error when the email address does not have a valid format.
		if(is_email_invalid($email)) {
			$errors["invalid_email"] = "Please enter a valid email address!";
		}
		// Add an error when the username is already in use.
		if (is_username_taken($pdo, $username)){
			$errors["username_taken"] = "Username already taken!";
		}
		// Add an error when the email address is already registered.
		if (is_email_regestred($pdo, $email)) {
			$errors["email_used"] = "Email already registred!";
		}

		// Start the configured session so errors and submitted form data can be retained.
		require_once 'config_session.inc.php';

		// Return to the form without creating an account when validation failed.
		if ($errors) {
			// Save the errors in the session for display after the redirect.
			$_SESSION["errors_signup"] = $errors;

			// Keep non-sensitive fields so the form can be repopulated later.
			$signupData = [
				"username" => $username,
				"email" => $email
			];
			// Store the preserved form data in the session.
			$_SESSION["signup_data"] = $signupData;
			// Redirect back to the page containing the signup form.
			header("Location: ../index.php");
			die();
		}
		
		// Hash the password and insert the validated user into the database.
		create_user($pdo, $username, $email, $password);

		// Redirect with a flag that triggers the signup success message.
		header("Location: ../index.php?signup=success");

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

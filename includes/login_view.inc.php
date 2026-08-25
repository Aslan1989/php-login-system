<?php // Start the login presentation helper file.

declare(strict_types=1);

/**
 * Outputs the current login status and username when a user is authenticated.
 */
function output_username(){
	// Check whether the session identifies an authenticated user.
	if (isset($_SESSION["user_id"])) {
		// Display the authenticated user's escaped username.
		echo "You are logged in as " . $_SESSION["user_username"];
	} else {
		// Inform a guest visitor that no account is currently logged in.
		echo "You are not logged in";
	}
}

/**
 * Displays stored login errors or a successful-login message, then clears the errors.
 */
function check_login_errors(){
	// Display errors saved by the login handler after it redirected back to this page.
	if (isset($_SESSION["errors_login"])) {
		// Copy the saved errors into a local variable for display.
		$errors = $_SESSION["errors_login"];

		// Add spacing before the list of error messages.
		echo "<br>";

		// Output every saved error as a styled paragraph.
		foreach ($errors as $error){
			echo '<p class="form-error">' . $error . '</p>';
		}

		// Remove displayed errors so they are not shown again after a refresh.
		unset($_SESSION["errors_login"]);

	} else if (isset($_GET["login"]) && $_GET["login"] === "success") {
		// Display feedback when the login handler redirected after a successful login.
		echo '<br>';
		echo '<p class="form-success">Login success!</p>';
	}
}

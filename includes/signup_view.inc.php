<?php // Start the signup presentation helper file.

declare(strict_types=1);

/**
 * Displays stored signup errors or a successful-signup message, then clears the errors.
 */
function check_signup_errors() {
	// Display errors saved by the signup handler after it redirected back to this page.
	if(isset($_SESSION["errors_signup"])){
		// Copy the saved errors into a local variable for display.
		$errors = $_SESSION["errors_signup"];

		// Add spacing before the list of error messages.
		echo "<br>";

		// Output every saved error as a styled paragraph.
		foreach ($errors as $error){
			echo '<p class="form-error">' . $error . '</p>';
		}

		// Remove displayed errors so they are not shown again after a refresh.
		unset($_SESSION["errors_signup"]);

	} else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
		// Display feedback when the signup handler redirected after successful registration.
		echo '<br>';
		echo '<p class="form-success">Signup success!</p>';
	}
}

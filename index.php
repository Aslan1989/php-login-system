<?php

// Load the session configuration before accessing session data.

require_once 'includes/config_session.inc.php';
// Load the helper that displays signup validation feedback.
require_once 'includes/signup_view.inc.php';
// Load the helpers for the current login status and login feedback.
require_once 'includes/login_view.inc.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Configure text encoding and responsive behavior for the page. -->
	<meta charset="UTF-8">
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1.0"
	>
	<!-- Set the browser-tab title and load the page stylesheets. -->
	<title>PHP Login System</title>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/main.css">

</head>

<body>

	<!-- Display the application title and the current login status. -->
    <h1>PHP Login System</h1>
	<br>
	<h3>
		<?php
		// Output the logged-in username or a guest status message.
		output_username();
		?>
	</h3>

	<?php
	 // Only show the login form when no user is authenticated.
	 if (!isset($_SESSION["user_id"])) { ?>
		<!-- Login form: submits credentials to the login handler. -->
		<h3>Login</h3>

		<form action="includes/login.inc.php" method="post">
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="passwd" placeholder="Password">
			<button>Login</button>
		</form>
	<?php } ?>
	
	<?php
	// Display login errors or the login-success message after a redirect.
	check_login_errors();
	?>
	<br>
	<!-- Signup form: creates a new account through the signup handler. -->
	<h3>Signup</h3>

	<form action="includes/signup.inc.php" method="post">
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="passwd" placeholder="Password">
		<input type="text" name="email" placeholder="Email">
		<button>Signup</button>
	</form>

	<?php
	// Display signup errors or the signup-success message after a redirect.
	check_signup_errors();
	?>

	<!-- Logout form: clears the current session. -->
	<h3>Logout</h3>

	<form action="includes/logout.inc.php" method="post">
		<button>Logout</button>
	</form>
</body>

</html>

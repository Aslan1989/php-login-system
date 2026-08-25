<?php

require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1.0"
	>
	<title>PHP Login System</title>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/main.css">

</head>

<body>

    <h1>PHP Login System</h1>

	<br>
	<h3>Login</h3>

	<form action="includes/login.inc.php" method="post">
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="passwd" placeholder="Password">
		<button>Login</button>
	</form>
	<br>
	<h3>Signup</h3>

	<form action="includes/signup.inc.php" method="post">
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="passwd" placeholder="Password">
		<input type="text" name="email" placeholder="Email">
		<button>Signup</button>
	</form>

	<?php
	check_signup_errors();
	?>
</body>

</html>
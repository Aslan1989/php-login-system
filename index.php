<?php

declare(strict_types=1);

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

</head>

<body>

    <h1>PHP Login System</h1>

    <h2>Create an account</h2>

    <form action="includes/signup.inc.php" method="post">

        <div>
            <label for="username">Username</label>

            <input
                type="text"
                id="username"
                name="username"
                required
            >
        </div>

        <div>
            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                required
            >
        </div>

        <div>
            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                required
            >
        </div>

        <button type="submit">
            Create account
        </button>

    </form>

</body>

</html>
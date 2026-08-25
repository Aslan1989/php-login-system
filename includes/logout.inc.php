<?php // Start the PHP script.

// Require strict type checking for any type declarations in this script.
declare(strict_types=1);

// Resume the user's current session so its stored login data can be removed.
session_start();
// Remove all variables currently stored in the session, including user login details.
session_unset();
// Destroy the session on the server so the user is fully logged out.
session_destroy();

// Redirect the user back to the home page after logging out.
header("Location: ../index.php");
// Stop this script immediately so no further output or processing occurs after the redirect.
die();

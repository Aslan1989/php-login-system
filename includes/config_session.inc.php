<?php // Start the session configuration script.

// Restrict session IDs to cookies so they cannot be passed in URLs.
ini_set('session.use_only_cookies', 1);
// Reject uninitialized session IDs to prevent session fixation attacks.
ini_set('session.use_strict_mode', 1);

// Configure the security and lifetime settings for the session cookie.
session_set_cookie_params([
	// Expire the cookie after 30 minutes.
	'lifetime' => 1800,
	'domain' => 'localhost',
	'path' => '/',
	'secure' => true,
	'httponly' => true
]);

// Start or resume the visitor's PHP session using the configuration above.
session_start();

// Use a user-specific session ID policy for authenticated users.
if (isset($_SESSION["user_id"])) {
	// Create an initial authenticated session ID when none has been recorded.
	if (!isset($_SESSION["last_generation"])) {
		regenerate_session_id_loggedin();
	} else {
		// Define the 30-minute interval for rotating session identifiers.
		$interval = 60 * 30;
		if (time() - $_SESSION["last_generation"] >= $interval) {
			// Rotate an expired authenticated session identifier.
			regenerate_session_id_loggedin();
		}
	}
} else {
	// Create or rotate a standard session ID for unauthenticated visitors.
	if (!isset($_SESSION["last_generation"])) {
		regenerate_session_id();
	} else {
		// Define the 30-minute interval for guest session ID rotation.
		$interval = 60 * 30;
		if (time() - $_SESSION["last_generation"] >= $interval) {
			// Rotate an expired guest session identifier.
			regenerate_session_id();
		}
	}
}

/**
 * Regenerates an authenticated user's session ID and associates it with their user ID.
 */
function regenerate_session_id_loggedin() {
	// Invalidate the previous session ID and generate a fresh one.
	session_regenerate_id(true);

	// Read the authenticated user's database record from the session.
	$user_id = $_SESSION["user_id"];
	// Generate a unique base ID for the replacement session.
	$newSessionId = session_create_id();
	// Append the user's ID to associate the session identifier with that user.
	$sessionId = $newSessionId . "_" . $user_id["id"];
	// Set the replacement session ID for subsequent session operations.
	session_id($sessionId);

	// Store the time of this rotation to enforce the configured interval.
	$_SESSION["last_generation"] = time();
}

/**
 * Regenerates a guest session ID and records when it was last generated.
 */
function regenerate_session_id() {
	// Invalidate the previous guest session ID and generate a fresh one.
	session_regenerate_id(true);
	// Store the time of this rotation to enforce the configured interval.
	$_SESSION["last_generation"] = time();
}


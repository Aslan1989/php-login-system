<?php // Start the signup validation helper file.

declare(strict_types=1);

/**
 * Determines whether any required signup field is empty.
 *
 * @param string $username The submitted username.
 * @param string $email The submitted email address.
 * @param string $password The submitted password.
 * @return bool True when a required field is empty; otherwise false.
 */
function is_input_empty(
    string $username,
    string $email,
    string $password
): bool { 
	// Return true as soon as any required signup value is empty.
	if (
		empty($username) ||
		empty($email) ||
		empty($password)
	) {
		return true;
	}
	// All required values are present, so no empty-input error exists.
	return false;
}
/**
 * Determines whether an email address has an invalid format.
 *
 * @param string $email The email address to validate.
 * @return bool True when the email is invalid; otherwise false.
 */
function is_email_invalid(
    string $email,
): bool { 
	// Ask PHP to validate that the value has a standard email-address format.
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	}
	// The supplied email address has a valid format.
	return false;
}

/**
 * Determines whether a username is already registered.
 *
 * @param object $pdo The database connection.
 * @param string $username The username to check.
 * @return bool True when the username exists; otherwise false.
 */
function is_username_taken(object $pdo,
    string $username,
): bool { 
	// Look up the username and return true when a matching record exists.
	if (get_username($pdo, $username)) {
		return true;
	}
	// No matching username record was found.
	return false;
}

/**
 * Determines whether an email address is already registered.
 *
 * @param object $pdo The database connection.
 * @param string $email The email address to check.
 * @return bool True when the email exists; otherwise false.
 */
function is_email_regestred(object $pdo,
    string $email,
): bool { 
	// Look up the email address and return true when a matching record exists.
	if (get_email($pdo, $email)) {
		return true;
	}
	// No matching email record was found.
	return false;
}

/**
 * Creates a new user with the supplied signup details.
 *
 * @param object $pdo The database connection.
 * @param string $username The new user's username.
 * @param string $email The new user's email address.
 * @param string $password The new user's plain-text password.
 */
function create_user(object $pdo,
    string $username,
    string $email,
    string $password
) { 
	// Delegate password hashing and database insertion to the model function.
	set_user($pdo,
    $username,
    $email,
    $password);
}

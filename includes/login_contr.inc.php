<?php // Start the login validation helper file.

declare(strict_types=1);

/**
 * Determines whether either required login field is empty.
 *
 * @param string $username The submitted username.
 * @param string $password The submitted password.
 * @return bool True when a required field is empty; otherwise false.
 */
function is_input_empty(
    string $username,
    string $password
): bool { 
	// Return true as soon as either required login value is empty.
	if (
		empty($username) ||
		empty($password)
	) {
		return true;
	}
	// Both values are present, so no empty-input error exists.
	return false;
}

/**
 * Determines whether no user was found for the submitted username.
 *
 * @param array|bool $result The user lookup result.
 * @return bool True when the lookup did not return a user; otherwise false.
 */
function is_username_wrong(array|bool $result,
) { 
	// A false lookup result means the submitted username was not found.
	if (!$result) {
		return true;
	}
	// A user record was found for the submitted username.
	return false;
}

/**
 * Verifies a submitted password against its stored hash.
 *
 * @param string $password The submitted password.
 * @param string $hashedPwd The stored password hash.
 * @return bool True when the password does not match; otherwise false.
 */
function is_password_wrong(string $password, string $hashedPwd) { 
	// Compare the submitted password against the password hash stored in the database.
	if (!password_verify($password, $hashedPwd)) {
		return true;
	}
	// The submitted password matches the stored hash.
	return false;
}

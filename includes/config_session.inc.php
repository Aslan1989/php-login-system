<?php
// Only store the session ID in a cookie.
// Don't accept it through the URL or other mechanisms.
// Without use_only_cookies,
// PHP can potentially accept a session ID through a URL
ini_set('session.use_only_cookies', 1);
// I will only accept a session ID if that session actually exists on the server
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
	'lifetime' => 1800,
	'domain' => 'localhost',
	'path' => '/',
	'secure' => true,
	'httponly' => true
]);
<?php
class Security
{
    /**
     * Sanitizes a given value to prevent XSS attacks by converting special characters to HTML entities.
     * Specifically, it encodes quotes and uses UTF-8 character encoding for the conversion.
     *
     * @param mixed $value The input value to be sanitized.
     * @return string The sanitized value with special characters converted to HTML entities.
     */
    public static function sanitize($value)
    {
        return htmlentities(trim($value), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Generates a unique token and stores it in the session.
     * This token can be used for form validation or CSRF protection.
     * The token is generated using a combination of the `uniqid()` function, a random number, and hashed with MD5.
     */
    public static function genToken()
    {
        Session::set('token', md5(uniqid(rand(100000, 999999))));
    }

    /**
     * Generates a unique token similar to `genToken` method but does not store it in the session.
     * This can be used where a token is needed without the necessity of storing it immediately in the session.
     *
     * @return string The generated token.
     */
    public static function token()
    {
        return md5(uniqid(rand(100000, 999999)));
    }

    /**
     * Validates a given token against the one stored in the session.
     * This is commonly used to prevent CSRF attacks by verifying that the submitted token matches the session token.
     *
     * @param string $token The token to check.
     * @return bool True if the token matches the session token, false otherwise.
     */
    public static function checkToken($token)
    {
        return Session::exists('token') && Session::get('token') === $token;
    }

    /**
     * Encrypts a password using a specified salt and the `password_hash` function.
     * This method is designed to securely hash passwords for storage in a database.
     *
     * @param string $password The password to encrypt.
     * @param string $salt The salt to append to the password before hashing.
     * @return string The hashed password.
     */
    public static function encrypt($password, $salt)
    {
        return password_hash($password . $salt, PASSWORD_DEFAULT);
    }

    /**
     * Verifies a given password against a hash to check if they match.
     * This is typically used during login processes to verify user credentials.
     *
     * @param string $hash The hash stored in the database.
     * @param string $password The password provided by the user.
     * @param string $salt The salt used when the password was originally hashed.
     * @return bool True if the password and hash match, false otherwise.
     */
    public static function verify($hash, $password, $salt)
    {
        return password_verify($password . $salt, $hash);
    }
}

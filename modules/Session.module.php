<?php
class Session
{
    /**
     * Sets a session variable with the specified name and value.
     * This method stores a value in the session identified by a name key.
     *
     * @param string $name The name of the session variable to set.
     * @param mixed $value The value to assign to the session variable.
     * @return void
     */
    public static function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Retrieves the value of a session variable by name.
     * If the session variable exists, its value is returned. Otherwise, false is returned.
     *
     * @param string $name The name of the session variable to retrieve.
     * @return mixed The value of the session variable if it exists, false otherwise.
     */
    public static function get($name)
    {
        if (self::exists($name)) {
            return $_SESSION[$name];
        } else {
            return false;
        }
    }

    /**
     * Checks if a session variable with the specified name exists.
     *
     * @param string $name The name of the session variable to check.
     * @return bool True if the session variable exists, false otherwise.
     */
    public static function exists($name)
    {
        return !empty($_SESSION[$name]);
    }

    /**
     * Deletes a session variable with the specified name.
     * If the session variable exists, it is removed from the session.
     *
     * @param string $name The name of the session variable to delete.
     * @return void
     */
    public static function delete($name)
    {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * Retrieves the user agent string from the current request's headers.
     * This method can be used as part of session security mechanisms to validate
     * the consistency of the user agent across requests.
     *
     * @return string The user agent string sent by the client.
     */
    public static function uagent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
}

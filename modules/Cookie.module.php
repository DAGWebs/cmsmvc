<?php
class Cookie
{
    /**
     * Sets a cookie with a specified name, value, and expiry time.
     * The cookie will expire after a certain number of hours specified by the $time parameter.
     *
     * @param string $name The name of the cookie.
     * @param string $value The value of the cookie.
     * @param int $time The time in hours after which the cookie will expire. Default is 1 hour.
     * @return void
     */
    public static function set($name, $value, $time = 1)
    {
        setcookie($name, $value, time() + ($time * 3600));
    }

    /**
     * Retrieves the value of a cookie if it exists.
     *
     * @param string $name The name of the cookie to retrieve.
     * @return string|null Returns the value of the cookie if it exists, or null if the cookie does not exist.
     */
    public static function get($name)
    {
        if (self::exists($name)) {
            return $_COOKIE[$name];
        }
        return null; // It's a good practice to explicitly return null if the cookie doesn't exist.
    }

    /**
     * Checks if a cookie with a specified name exists.
     *
     * @param string $name The name of the cookie to check.
     * @return bool Returns true if the cookie exists, false otherwise.
     */
    public static function exists($name)
    {
        return isset($_COOKIE[$name]);
    }

    /**
     * Deletes a cookie by setting its expiry time in the past.
     * If the cookie exists, its expiry time is set to one second before the current time, effectively deleting it.
     *
     * @param string $name The name of the cookie to delete.
     * @return void
     */
    public static function delete($name)
    {
        if (self::exists($name)) {
            setcookie($name, '', time() - 1);
        }
    }
}

<?php
class Cookie {
    public static function set($name, $value, $time = 1) {
        setcookie($name, $value, time() + ($time * 3600));
    }

    public static function get($name) {
        if(self::exists($name)) {
            return $_COOKIE[$name];
        }
    }

    public static function exists($name) {
        return isset($_COOKIE[$name]);
    }

    public static function delete($name) {
        if(self::exists($name)) {
            setcookie($name, '', time() - 1);
        }
    }
}
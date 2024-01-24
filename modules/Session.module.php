<?php
class Session {
    public static function set($name, $value) {
        $_SESSION[$name] = $value;
    }

    public static function get($name) {
        if(self::exists($name)) {
            return $_SESSION[$name];
        } else {
            return false;
        }
    }

    public static function exists($name) {
        return isset($_SESSION[$name]);
    }

    public static function delete($name) {
        if(self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    public static function uagent() {
        return $_SERVER['HTTP_USER_AGENT'];
    }
}
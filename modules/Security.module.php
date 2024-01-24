<?php
class Security {
    public static function sanitize($value) {
        return htmlentities($value, ENT_QUOTES, 'UTF-8');
    }

    public static function genToken() {
        Session::set('token', md5(uniqid((rand(100000, 999999)))));
    }

    public static function token() {
        return md5(uniqid((rand(100000, 999999))));
    }

    public static function checkToken($token) {
        if(Session::exists('token') && Session::get('token') === $token) {
            return true;
        } else {
            return false;
        }
    }

    public static function encrypt($password, $salt) {
        $pass = $password . $salt;
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    public static function verify($hash, $password, $salt) {
        $pass = $password . $salt;
        if(password_verify($pass, $hash)) {
            return true;
        } else {
            return false;
        }
    }
}
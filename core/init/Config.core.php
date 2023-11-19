<?php
class Config {
    protected static $_config = []; 

    public static function loadEnv($path) {
        $env = file_get_contents($path);

        $lines = explode(PHP_EOL, $env);

        foreach($lines as $line) {
            $line = trim($line);

            if(!empty($line) && strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                
                self::set($key, $value);
            }
        }
    }

    public static function set($key, $value) {
        $key = str_replace("_", ' ', $key);
        $key = str_replace("-", ' ', $key);
        $key = str_replace(".", ' ', $key);

        $key = ucwords(strtolower($key));

        return self::$_config[$key] = $value;
    }

    public static function get($key) {
        $key = str_replace("_", ' ', $key);
        $key = str_replace("-", ' ', $key);
        $key = str_replace(".", ' ', $key);

        $key = ucwords(strtolower($key));

        return self::$_config[$key];
    }
}
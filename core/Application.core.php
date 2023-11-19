<?php
class Application {
    public function __construct() {
        $this->_set_reporting();
        $this->_unregister_globals();
    }

    private function _set_reporting() {
        if(Config::get("Debug")) {
            error_reporting(E_ALL);
            ini_set("display_errors",1);
        } else {
            error_reporting(0);
            ini_set("display_errors",0);
            ini_set("log_errors", 1);
            ini_set('error_log', ERROR_LOG);
        }
    }

    private function _unregister_globals() {
        if(ini_get('register_globas')) {
            $globals = ["_SESSION", "_POST", "_GET", "_REQUEST", "_SERVER", "_ENV", "_COOKIE"];

            foreach($globals as $g) {
                foreach($GLOBALS[$g] as $key => $value) {
                    if($GLOBALS[$key] === $value) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }
}
<?php

const APP = ROOT . 'app' . DS;
const CON = APP . 'controllers' . DS;
const MOD = APP . 'modules' . DS;
const VIE = APP . 'views' . DS;
const LAY = VIE . 'layouts' . DS;
const API = APP . 'api' . DS;
const CONF = ROOT . 'config' . DS;
const CORE = ROOT . 'core' . DS;
const INIT = CORE . 'init' . DS;
const DWL = ROOT . "downloads" . DS;
const UPL = ROOT . 'uploads' . DS; 
const VND = ROOT . 'vendor' . DS;
const ERROR_LOG = ROOT . 'tmp' . DS . 'logs' . DS . 'errors.log';

$g = glob(CONF . "*.config.php");

require_once INIT . 'Config.core.php';

$config = Config::loadEnv(ROOT . '.env');


spl_autoload_register(function($class) {
    if(file_exists(CON . $class . DS . $class . '.controller.php')) {
        require_once CON . $class . DS . $class . '.controller.php';
    } else if(file_exists( MOD . $class . DS . $class . '.mdoel.php')) {
        require_once  MOD . $class . DS . $class . '.mdoel.php';
    } else if(file_exists(CORE . $class . '.core.php')) {
        require_once CORE . $class . '.core.php';
    } else if(file_exists(ROOT . 'modules' . DS . $class . '.module.php')) {
        require_once ROOT . 'modules' . DS . $class . '.module.php';
    } else if(file_exists(ROOT . 'components' . DS . $class . '.component.php')) {
        require_once ROOT . 'components' . DS . $class . '.component.php';
    }
});

foreach($g as $f) {
    require_once $f;
}

require_once VND . 'autoload.php';

$router = new Router();
$router->route();
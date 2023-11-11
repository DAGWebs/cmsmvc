<?php
const APP = ROOT . 'app' . DS;
const CON = APP . 'controllers' . DS;
CONST MOD = APP . 'modules' . DS;
const VIE = APP . 'views' . DS;
const LAY = VIE . 'layouts' . DS;
const API = APP . 'api' . DS;
const CONF = ROOT . 'config' . DS;
const CORE = ROOT . 'core' . DS;
const INIT = CORE . 'init' . DS;
const DWL = ROOT . "downloads" . DS;
const UPL = ROOT . 'uploads' . DS; 
const VND = ROOT . 'vendor' . DS;

$g = glob(CONF . "*.config.php");

foreach($g as $f) {
    require_once $f;
}
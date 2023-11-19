<?php
session_start();

const DS = DIRECTORY_SEPARATOR;
define("ROOT", dirname(__DIR__) . DS);

require_once ROOT . 'core' . DS .'init'. DS .'bootstrap.php';

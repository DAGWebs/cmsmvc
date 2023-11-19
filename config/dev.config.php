<?php
Config::set('default-controller', "home");
Config::set("default_action", 'index');
Config::set('debug', true);
Config::set('api.version', 'v1');
Config::set('domain', explode('.', $_SERVER['HTTP_HOST']));
Config::set('app.name', 'CMS MVC');
Config::set('layout.default', 'default');
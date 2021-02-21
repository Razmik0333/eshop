<?php
    ini_set('display_errors',1);
    error_reporting(E_ALL);            //при работе сайта не показывает ошибки ползвателей с целю безопасности
    session_start(); 
    define('ROOT',dirname(__FILE__));
    require_once(ROOT.'/components/Autoload.php');//подключение файлов системы
    $router = new Router();
    $router->run();

?>
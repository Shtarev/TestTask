<?php
require $_SERVER['DOCUMENT_ROOT'].'/config.php';
use routes\Router;
use vendor\src\Classes\Request;

/** 
* Главная сайта адрес - пустая строка
*/
Router::add('^$', ['controller' => 'Index', 'action' => 'index']);

/** 
* урл адрес - [controller]=>'слово'/[action]=>'слово'/[param]=>'слово или цыфра'
* при этом action и param не обязательны так как после низ стоит ?
* в param добавлены символы ?&= для get-ссылок
*/
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?/?(?P<param>[a-z0-9-?&=]+)?$');

/** 
* Админ
*/
Router::add('^(?P<controller>\'admin\')/?(?P<action>[a-z-]+)?/?(?P<param>[a-z0-9-?&=]+)?$'/*, ['controller' => 'Admin', 'action' => 'index']*/);

/**
* вызываем на обработку текущий урл Request::site() это из config.php
*/
Router::dispatch(Request::site());

?>
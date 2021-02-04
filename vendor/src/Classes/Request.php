<?php
/* 
|-------------------------------------------------------------------------- 
| Request
|-------------------------------------------------------------------------- 
| Браузерные и серверные пути к директориям. Названия исполняемых файлов.
| Содержимое массивов $_SERVER, $_GET, $_POST, $_PUT, $_DELETE
|-------------------------------------------------------------------------- 
| *** Часто используемые методы:
|-------------------------------------------------------------------------- 
| 
| браузерный путь к корню ( http://site.ru/ )
| Request::root();
|
| текущий браузерный путь ( http://site.ru/admin/index/ )
| Request::url();
|
| текущий браузерный путь без GET-параметров ( http://site.ru/admin/index?id=5&title=item  = http://site.ru/admin/index )
| Request::url_noparam();
|
| текущий путь из браузерного пути после http://, очищен от слэшей ( admin/index )
| Request::site();
|
| серверный путь к директории public ( C:/OSPanel/domains/site.ru/public/ )
| Request::_public();
|
| серверный путь к корню ( C:/OSPanel/domains/testtask/ )
| Request::_root();
|
| серверный путь до файла из которого сраболал скрипт ( C:/OSPanel/domains/testtask/public/index.php ) 
| Request::_datei();
|
| название файла из которого сраболал скрипт ( index.php )
| Request::datei();
|
| метод текущего запроса ( GET, POST, PUT, DELETE )
| Request::method();
|
| содержание текущего запроса GET, POST, PUT, DELETE
| Request::request();
|
| Остальное смотри ниже. Все методы подписаны
|
*/
namespace vendor\src\Classes;

class Request
{
    public function __construct() {
		//
	}
    // текущий браузерный путь ( http://site.ru/admin/index/ )
    public static function url() {
        return 'http://'.$_SERVER['SERVER_NAME'].'/'.$_SERVER['QUERY_STRING'];
    }
	// текущий браузерный путь без GET-параметров ( http://site.ru/admin/index?id=5&title=item  = http://site.ru/admin/index)
    public static function url_noparam() {
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
		return 'http://'.$_SERVER['HTTP_HOST'].$uri_parts[0];
    }
    // текущий путь из браузерного пути после http://, очищен от слэшей ( admin/index )
    public static function site() {
        return rtrim($_SERVER['QUERY_STRING'], '/');
    }
    // браузерный путь к корню ( http://site.ru/ )
    public static function root() {
        return 'http://'.$_SERVER['SERVER_NAME'].'/';
    }
	// браузерный путь к директории где файл ( http://site.ru/dir/ )
    public static function root_dir() {
        $pieces = explode('/', $_SERVER['PHP_SELF']);    
		$file = array_pop($pieces);
		$url = $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];  
        return "http://".mb_strstr($url, $file, true);
    }
	// серверный путь к директории где файл ( C:/OSPanel/domains/site.ru/dir/ )
    public static function _root_dir() {
        $pieces = explode('/', $_SERVER['PHP_SELF']);    
		$file = array_pop($pieces);
		$url = $_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'];  
        return mb_strstr($url, $file, true);
    }
    // домен (site.ru)
    public static function domen () {
        return $_SERVER['SERVER_NAME'];
    }
    // серверный путь к директории public ( C:/OSPanel/domains/site.ru/public/ )
    public static function _public() {
        $url = $_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'];
        return mb_strstr($url, array_pop(explode('/', $_SERVER['PHP_SELF'])), true);
    }
    // серверный путь к корню ( C:/OSPanel/domains/testtask/ )
    public static function _root() {
        return $_SERVER['DOCUMENT_ROOT'].'/';
    }
    // название файла из которого сраболал скрипт ( index.php )
    public static function datei() {
        return array_pop(explode('/', $_SERVER['PHP_SELF']));
    }
    // серверный путь до файла из которого сраболал скрипт ( C:/OSPanel/domains/testtask/public/index.php ) 
    public static function _datei() {
        return $_SERVER['SCRIPT_FILENAME'];
    }
    // IP сервера ( 127.0.0.1 )
    public static function _server_ip() {
        return $_SERVER['SERVER_ADDR'];
    }
    // порт сервера ( 80 )
    public static function _server_port() {
        return $_SERVER['SERVER_PORT'];
    }
    // тип сервера ( Apache )
    public static function _web_serwer() {
        return $_SERVER['SERVER_SOFTWARE'];
    }
    // протокол ( HTTP/1.1 )
    public static function protocol() {
        return $_SERVER['SERVER_PROTOCOL'];
    }
    // временная метка начала запроса, каждую секунду новая ( 1610454076 )
    public static function time_metka_s() {
        return $_SERVER['REQUEST_TIME'];
    }
    // временная метка начала запроса, каждую микросекунду новая ( 1610454076 )
    public static function time_metka_ms() {
        return $_SERVER['REQUEST_TIME_FLOAT'];
    }
    // при HTTP-аутентификации здесь имя пользователя ( admin )
    public static function auth_login() {
        return $_SERVER['PHP_AUTH_USER'];
    }
    // при HTTP-аутентификации здесь пароль пользователя ( 12345 )
    public static function auth_parol() {
        return $_SERVER['PHP_AUTH_PW'];
    }
    // тип аутентификации (  )
    public static function auth_type() {
        return $_SERVER['AUTH_TYPE'];
    }
    // заглолвок HTTP_ACCEPT ( text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8 )
    public static function http_accept() {
        return $_SERVER['HTTP_ACCEPT'];
    }
    // предпочтительный язык ( ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3 )
    public static function language() {
        return $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    }
    // информация о браузере ( Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:84.0) Gecko/20100101 Firefox/84.0 )
    public static function browser() {
        return $_SERVER['HTTP_USER_AGENT'];
    }
    // ip зашедшего на страницу юзера ( 127.0.0.1 )
    public static function client_ip() {
        return $_SERVER['REMOTE_ADDR'];
    }
    // метод текущего запроса ( GET, POST, PUT, DELETE )
    public static function method() {
        return $_SERVER['REQUEST_METHOD'];
    }
    // текущий запрос ( GET, POST, PUT, DELETE )
    public static function request() {
        $var = $_SERVER['REQUEST_METHOD'];
        switch ($var)
        {
            case 'GET':
            return $_GET;
            break;

            case 'POST':
            return $_POST;
            break;

            case 'PUT':
            return $_PUT;
            break;
            
            case 'DELETE':
            return $_DELETE;
            break;

            default:
            return 'Нет информации о методе запроса';
            break;
        }
    }
}
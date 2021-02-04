<?php
namespace app\view\src;
use vendor\src\Classes\Request;

class View
{
    /* ПОЛЬЗОВАТЕЛЬСКАЯ ЧАСТЬ */
    // проверяем есть ли базовый шаблон
    public static function viewTemplate() {
        if(is_file(Request::_root().'app/view/'.'template.php')) {
            return Request::_root().'app/view/'.'template.php'; // путь до базового шаблона
        }
        else {
            die("В директории видов отсутствует базовый шаблон <b>'template.php'</b>");
        }
    }
	// выбор вида текущей страницы
	public static function viewView($route) {
        $view = mb_strtolower($route['controller']); // преобразуем в нижний регистр - windows пофигу, а Linux не пофигу
        
        /**
        * то, что дальше означает, если ссылка не на curl типа(http://testtask.ru/curl/), 
        * curl или другое позже вписанное тут - не имеетют видов, а только обрабатывают код и запросы
        * конструктор CurlConstructor используется для запуска php-файлов для вывода в видах массивов данных, 
        * например сборка меню и не имеет своих видов поэтому вида view не существует и мы должны попасть просто в CurlConstructor
        */
        switch ($view)
        {
            case 'curl':
            return 0;
            break;

            default:
            if(is_file(Request::_root().'app/view/'.$view.'.php')) { // проверяем есть ли заданный вид
                return Request::_root().'app/view/'.$view.'.php'; // путь до вида текущей страницы
            }
            else {
                die("В директории видов отсутствует шаблон вида <b>'".$view."'</b>");
            }
            break;
        }
    }
    
    /* ADMIN */
    // проверяем есть ли базовый шаблон
    public static function viewTemplateAdmin() {
        if(is_file(Request::_root().'app/view/admin/'.'template.php')) {
            return Request::_root().'app/view/admin/'.'template.php'; // путь до базового шаблона
        }
        else {
            die("В директории видов отсутствует базовый шаблон <b>'template.php'</b>");
        }
    }
	// выбор вида текущей страницы. $route сюда попадает из конструктора главного контроллера
	public static function viewViewAdmin($route) {
        // если зашли не из метода, то вид - главная админка
        if(!isset($route['action'])) {
            $view = 'index';
        }
        else { // остальные это имена методов
            $view = mb_strtolower($route['action']); // преобразуем в нижний регистр - windows пофигу, а Linux не пофигу
        }

        if(is_file(Request::_root().'app/view/admin/'.$view.'.php')) { // проверяем есть ли заданный вид
            return Request::_root().'app/view/admin/'.$view.'.php'; // путь до вида текущей страницы
        }
        else {
            return Request::_root().'app/view/admin/'.'index.php'; // путь до вида текущей страницы
        }
    }
}
<?php
/*
|--------------------------------------------------------------------------
| Router
|--------------------------------------------------------------------------
|
| dispatch($url) получив текщий урл обрабатывает его и передает в контроллер
| массив с именем этого контроллера, методом для обработки и параметрами
| контроллер передаст эти данные в родительский Controller, и там будет
| вызвн метод View, который обработает пути для подключаемых шаблонов
|
*/
namespace routes;
use app\view\src\View;

class Router 
{
	protected static $routes = []; // все маршруты
	protected static $route = []; // текущий маршрут
	
	/** основной метод маршрутизации вызывается в индексе корня 
    * Router::add('регулярка', ['controller' => 'Index', 'action' => 'index']);
    */
	public static function add($regexp, $route = []) {
		self::$routes[$regexp] = $route; // self::$routes[регулярка] = ['controller' => 'Index', 'action' => 'index']);
	}
    /** инициализируем текущую страницу self::$route
    * это вызывается в dispatch($url), здесь получаем текущий адрес - собираем свойство self::$route
    * в итоге имеем self::$route = array([controller] => link, [action] => index, [param] => param);
    */
	public static function matchRoutes($url) { // $url урл из браузера из setting.php
        /** 
        * перебираем таблицу маршрутов и сравниваем текущий адрес с адресами таблицы маршрутов
        * здесь $key = регулярка $value = ['controller' => 'Index', 'action' => 'index']
        */
        foreach(self::$routes as $key => $value) { 
			/**
            * сравниваем регулярку-$key с текущим урлом-$url и если совпадает, то заносим в $mathes
            * в $mathes грязный массив текущего маршрута из урла
            * где ключи и числовые и строчные, нам будут нужны с ключами в виде строк
            * то есть [controller] => link, [action] => index, [param] => param,
            * и может еще какие позже можешь обозначить в add индекса в корне
            */
            if(preg_match("#$key#i", $url, $mathes)) { 
				if($key == '^$') { // пусто - главная (прописанный маршрут из роута)
					self::$route = $value; // для главной данные прописаны в индексе корня
				}
				else { // все остальные, что не пусто
                    /** 
                    * в $mathes массив текущего маршрута из урла вытаскиваем от туда строчные ключи
                    * типа [controller] => link, [action] => index, [param] => param, остальное удаляем
                    */
                    foreach($mathes as $key => $value) {
                        if(!is_string($key)) {
                            unset($mathes[$key]); // удаляем если ключь не строка
                        }
                    }
                    // массив с данными из урла такой [controller] => link, [action] => index, [param] => param,
                    self::$route = $mathes; 
				}
				return true; // все ок мвойство инициализировано
			}
		}
		return false; // недопустимый по регулярке урл
	}
    
	// в $url текущая адресная строка
	public static function dispatch($url) {
		// просмотр текущего маршрута
		if(self::matchRoutes($url)) {
			$controller = self::$route['controller'].'Controller'; // вызываемый контроллер - это первая строка из урла с конкатенируемым 'Controller'
			$controller = ucwords($controller); // классы с заглавной буквы
			$controller = 'app\controllers\\'.$controller; // путь до контроллера
			// смотрим существует ли такой класс
			if(class_exists($controller)) {
                if(isset(self::$route['action'])) { // если в урле есть action - это вторая строка
                    $action = self::$route['action']; // вызываемый метод из урла
                    /** 
                    * ИМЕННО ЗДЕСЬ ПЕРЕДАЕМ В КОНТРОЛЛЕР ТЕКУЩИЕ ПУТИ !!!
                    * содаем объект этого контроллера и передаем в него данные пути self::$route
                    * смотрим существует ли в классе такой метод и вызываем этот метод
                    */
                    $contObj = new $controller(self::$route);
                    if(method_exists($contObj, $action)) {
                        $contObj->$action(); // вызываем на отработку прописанный метод 
                    }
                    else {
                        die("Метод $action не существует в контроллере $controller");
                    }
                }
                else { // если в урле нет action то смотрим, есть ли метод index (это метод по умолчанию)
                    $contObj = new $controller(self::$route);
                    if(method_exists($contObj, 'index')) {
                        $contObj->index(); // вызываем на отработку метод по умолчанию index
                    }
                    else { // если в урле не указан action и в контроллере нет даже метода по умолчанию index
                        die("В данном пути не задан метод для контроллера $controller<br>если вы хотите использовать Router без указания метода в адресной строке, то пропишите в контроллере метод по умолчанию index");
                    }
                }
			}
			else {
				die("Контроллер $controller не существует");
			}
		}
		else {
			die("$url - недопустимый путь роутера"); // недопустимый по регулярке урл, если matchRoutes() вернет false
		}
	}
	
	/* тестировочные методы для отладки маршрутизации */
	public static function getRoutes() { // просмотр всей таблицы маршрутов
		return self::$routes;
	}
	
	public static function getRoute() {// возврат свойства текущего маршрута
		return self::$route;
	}
}
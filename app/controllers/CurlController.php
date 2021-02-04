<?php
/*
|--------------------------------------------------------------------------
| CurlController
|--------------------------------------------------------------------------
|
| Используется для рендеринга страниц требующих динамических изменений.
| Сюда попадаем из класса vendor\src\Classes\Curl.php и получаем от него
| массив данных($_POST['data']) для вида и сам вид($_POST['view']) который
| надо подключить, чтобы страница отобразилась с HTML и PHP-кодом.
| Класс Curl.php получает обратно вид с уже отработанным кодом вывода.
|
*/
namespace app\controllers;
use app\controllers\src\Controller;
use vendor\src\Classes\Request;

class CurlController extends Controller
{

    public $blocks = ''; // путь до блоков для видов
	
    public function __construct(){
        $this->blocks = Request::request()['view'];
	}
	
	public function index() {
        echo 'index';
	}
    
    // сборка вида
    public function wiewRenderPost() { // если POST
        $data = unserialize(Request::request()['data']);
        include (Request::_root().$this->blocks);
	}
    
    public function wiewRenderGet() { // если GET
        $data = unserialize(Request::request()['data']);
        include (Request::_root().$this->blocks);
	}
}
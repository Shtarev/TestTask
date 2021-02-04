<?php
namespace app\controllers\src;
use app\view\src\View;
use app\models\Category;
use vendor\src\Classes\Curl;

abstract class Controller
{
	public $template;
	public $view; // путь до вида текущей страницы, если из какого-то контроллера надо перейти на другую страницу как вариант меняй его, например для перехода на главную страницу из разных методов Админ Контроллера пиши $this->view = $this->Dirweg->_root.'app/view/admin/index.php'; и дальше вызывай $this->index(); для главной страницы, это чтоб не попадать на страницу по имени метода
    public $vars = array(); // переменные для вида
    public $menu; // сюда попадает готовое меню
    public $meta = array(); // метатэги для шаблона вида
	
	public function __construct($route) {
        // токены
        if(!isset($_SESSION['token'])) {
            $_SESSION['token'] = md5(time());
            $this->meta['meta_token'] = $_SESSION['token']; // для хедера
            $this->vars['token'] = $_SESSION['token']; // для формы
        }
        else {
            $this->meta['meta_token'] = $_SESSION['token']; // для хедера
            $this->vars['token'] = $_SESSION['token']; // для формы
        }

        /**
        * переменная содержащая вывод сообщений, она почти всегда есть на страницах
        * где потенциально может быть вывод сообщений как {notice}, 
        * заполняется по мере необходимости в других контроллераx
        */
        $this->vars['notice'] = '';
        $this->viewSearch($route); // собираем пути видов
	}
    /**
    * Используя класс View строим пути для видов
    * для пользовательской части и для админа разные виды
    * на выходе получаем свойства $this->template и $this->view для рендеринга в viewRender()
    */
    public function viewSearch($route) {
        if($route['controller'] != 'admin') { // для пользовательской части
            $this->template = View::viewTemplate(); // путь до базового шаблона
            $this->view = View::viewView($route); // путь до вида текущей страницы
            $this->menu(); // дпнные из модели Category попадают в $this->menu
        }
        else { // для админки
            $this->template = View::viewTemplateAdmin(); // путь до базового шаблона
            $this->view = View::viewViewAdmin($route); // путь до вида текущей страницы
        }
    }
    
    /**
    * сборка запрашиваемой страницы 
    * на страницах места для вставки контента из передаваемых переменных выглядят так {key} где key это ключ передаваемой переменной
    * не используй для передачи в основной шаблон template переменных с ключами view, так как {view} используется для вставки текущей страницы
    */
    public function viewRender() {
        
        $template = file_get_contents($this->template); // базовый шаблон в строку
        // обходим массив с переданными переменными для базового шаблона template и вставляем их значения в вид
        // меню
        $template = str_replace('{blocks_menu}', $this->menu, $template);

        // метатеги
        foreach($this->meta as $key=>$value) {
            $template = str_replace($this->varRend($key), $value, $template);
        }
        
        $view = file_get_contents($this->view); // вид текущей страницы в строку
        // обходим массив с переданными переменными для тела текущей страницы и вставляем их значения в вид
        foreach($this->vars as $key=>$value) {
            $view = str_replace($this->varRend($key), $value, $view);
        }
        
        echo str_replace('{view}', $view, $template); // вставляем вид текущей страницы в базовый шаблон и выводим на экран
    }
    
    /* обработка полученных переменных для вставки в шаблон в шаблоне место вставки в фигурных скобках */
    public function varRend($var) {
        return '{'.$var.'}';
    }
    
    /* Меню */
    public function menu() {
        $menu = Category::all(); // вытаскиваем все меню из базы
        $this->menu = Curl::curlPost($menu, 'wiewRenderPost', 'menu'); // передаем массив с меню в вид меню и записываем результат в $this->menu
    }
}
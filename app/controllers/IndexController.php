<?php
namespace app\controllers;
use app\controllers\src\Controller;
use vendor\src\Classes\Pagination;
use vendor\src\Classes\Request;
use vendor\src\Classes\Guard;
use vendor\src\Classes\Curl;
use app\models\Task;

class IndexController extends Controller
{

    public $kolvoData = 3; // количество выведенных данных
    public $kolvoPunkt = 4; // количество выведенных пунктов меню

    public function __construct($route){
        parent::__construct($route); // вызываем родительский конструктор и передаем в него данные пути
	}
	
	public function index() {
        // сортировка по статусу имени или еиейлу
        if(isset(Request::request()['sort'])) {
            $_SESSION['sort'] = Request::request()['sort'];
            $_SESSION['tip'] = Request::request()['tip'];
            
            $res = Task::sorti($_SESSION['sort'], $_SESSION['tip']);
        }
        else {
            if(isset($_SESSION['tip'])) {
                $res = Task::sorti($_SESSION['sort'], $_SESSION['tip']);
            }
            else {
                $res = Task::all();
            }
        }
        
        // Обработка пагинации
        $Pagination = new Pagination($this->kolvoData, $this->kolvoPunkt, $res);
        $pagipunct = $Pagination->pagipunctArr(); // данные для сборки пунктов пагинации в шаблоне
        $inhalt = $Pagination->inhalt; // массив с текущей выборкой
        
        // запихиваем в массив текущую выборку
        $pagipunct['table'] = array();
        $pagipunct['table'] = $inhalt;
        
        // рендерим таблицу
        $this->vars['blocks_table'] = Curl::curlPost($pagipunct, 'wiewRenderPost', 'table');
        $this->meta['meta_title'] = 'приложение-задачник'; // массив для метаданных
        
        // если со страницы была отправлена форма с новым заданием
        if(isset(Request::request()['action'])) {
            $action = Request::request()['action']; // submit
            $this->$action();
        }
        // выводим страницу
		return $this->viewRender();
	}
    // Отпроавка формы новой задачи
    public function submit() {
        // проверка токена
        if(Request::method() == 'POST') {
            if(isset($_SESSION['token']) && $_SESSION['token'] != Request::request()['token']) {
                $data = 'Неверный токен';
                $this->vars['notice'] = Curl::curlPost($data, 'wiewRenderPost', 'noticedanger');
                return $this->viewRender();
            }
            elseif(!isset($_SESSION['token'])) {
                $data = 'Отсутствует токен';
                $this->vars['notice'] = Curl::curlPost($data, 'wiewRenderPost', 'noticedanger');
                return $this->viewRender();
            }
            // проверка заполнения форм, они уже были проверены в самом HTML, 
            // здесь проверяем еще раз так как мог попасть js и заносим в массив для базы
            // проверяем заполненны ли поля вообще
            foreach(Request::request() as $key=>$value) {
                if($value == '') {
                    $data = 'Вы не заполнили поле: '.$key;
                    $this->vars['notice'] = Curl::curlPost($data, 'wiewRenderPost', 'noticedanger');
                    return;
                }
            }
            // проверяем на вредоносный код
            $dataForDb = array();
            $dataForDb['name'] = Guard::testInput(Request::request()['staff_name']);
            $dataForDb['email'] = Guard::testE_Mail(Request::request()['staff_email']);
            $dataForDb['task'] = Guard::testInput(Request::request()['staff_task']);
            
            // заносим данные в базу
            $res = Task::inserti($dataForDb);
            // это вывод об успешной передаче данных после отправки формы
            if($res) {
                $data = 'Данные переданы';
                $this->vars['notice'] = Curl::curlPost($data, 'wiewRenderPost', 'noticesuccess');
            }
            else {
                $data = 'Что-то пошло не так. Данные не внесены';
                $this->vars['notice'] = Curl::curlPost($data, 'wiewRenderPost', 'noticedanger');
            }
            
            
        }
    }
}
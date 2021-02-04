<?php
namespace app\controllers;
use app\controllers\src\Controller;
use vendor\src\Classes\Pagination;
use vendor\src\Classes\Request;
use vendor\src\Classes\Guard;
use vendor\src\Classes\Auth;
use vendor\src\Classes\Curl;
use app\models\Task;

class AdminController extends Controller
{

    public $kolvoData = 5; // количество выведенных данных
    public $kolvoPunkt = 4; // количество выведенных пунктов меню
	
    public function __construct($route){
		Auth::admin();
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
        $this->vars['blocks_table'] = Curl::curlPost($pagipunct, 'wiewRenderPost', 'admin_table', 1);
        
        // вывод на экран
		return $this->viewRender();
	}
    
    // удаление задачи
    public function deltask() {
        if(isset(Request::request()['del'])) {
            // удаляем
            $res = Task::del(Request::request()['del']);
            // сообщение о процессе удаления
            if($res) {
                $data = 'Данные удалены';
                $this->vars['notice'] = Curl::curlPost($data, 'wiewRenderPost', 'noticesuccess');
            }
            else {
                $data = 'Что-то пошло не так. Данные не удалены';
                $this->vars['notice'] = Curl::curlPost($data, 'wiewRenderPost', 'noticedanger');
            }
            
            // вернуться в админку
		    $this->index();
        }
        else {
            die('Упс! Не получена переменная POST. Без неё здесь делать нечего. <a href="/admin">Перейти на главную</a>');
        }
    }
    
    // редактирование задачи
    public function red() {
        
        if(isset(Request::request()['red'])) { // в $_POST['red'] айди с главной админки с кнопки редактировать

            // получаем данные редактируемого задания
            $res = Task::selecttask(Request::request()['red']);
            
            if($res) {
                // собираем страницу
                $res = $res[0];
                $this->vars['id'] = $res['id'];
                $this->vars['name'] = $res['name'];
                $this->vars['email'] = $res['email'];
                $this->vars['task'] = $res['task'];
                if($res['status']) {
                    $res['status'] = 'checked';
                }
                else {
                    $res['status'] = '';
                }
                $this->vars['status'] = $res['status'];
                return $this->viewRender();
            }
            else {
                die('Не получены данные. Ошибка выборки данных из базы в методе: selecttask(), класса Task');
            }
        }
        elseif(Request::request()['name']) { // $_POST['name'] значит получили отредактированные данные из вида red
            $post_in_db = array();
            // сравниваем менялись ли админом поля и корректируем чекинг статуса, в базе это 1 или 0
            if(!isset(Request::request()['status'])) {
                $post_in_db['status'] = 0;
            }
            else {
                $post_in_db['status'] = 1;
            }
            if(Request::request()['task'] != Request::request()['task_hidden']) {
                $post_in_db['redact'] = 1;
            }
            else {
                $post_in_db['redact'] = Task::one(Request::request()['id'])['redact']; // получаем текущее поле 'redact'
            }
            // валидируем
            $dataForDb = array();
            $post_in_db['id'] = Guard::testInput(Request::request()['id']);
            $post_in_db['name'] = Guard::testInput(Request::request()['name']);
            $post_in_db['email'] = Guard::testE_Mail(Request::request()['email']);
            $post_in_db['task'] = Guard::testInput(Request::request()['task']);
            
            $res = Task::red($post_in_db);
            
            if($res) {
                if($res) {
                    $data = 'Данные изменены';
                    $this->vars['notice'] = Curl::curlPost($data, 'wiewRenderPost', 'noticesuccess');
                }
                else {
                    $data = 'Что-то пошло не так. Данные не изменены';
                    $this->vars['notice'] = Curl::curlPost($data, 'wiewRenderPost', 'noticedanger');
                }
                // переход на главную админки
                $this->view = Request::_root().'app/view/admin/index.php'; // путь до вида главной страницы иначе перейдем на red, по имени метода в котором сейчас
                $this->index(); // переходим на главную страницу
            }
            else {
                die('Ошибка изменения данных в базе в методе: red(), класса Task');
            }
        }
        else {
            die('Упс! Не получена переменная POST. Без неё здесь делать нечего. <a href="/admin">Перейти на главную</a>');
        }
    }
    
}
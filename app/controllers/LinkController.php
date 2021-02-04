<?php
namespace app\controllers;
use app\controllers\src\Controller;

class LinkController extends Controller
{
	
    public function __construct($route){
        parent::__construct($route); // вызываем родительский конструктор и передаем в него данные пути
	}
	
	public function index() {
        $this->meta['meta_title'] = 'Link';
        $this->vars['title'] = 'Cтраница '.$this->meta['meta_title'];
        $this->vars['description'] = 'Это просто страница '.$this->meta['meta_title'].' без модели - для примера';
		return $this->viewRender(); // вывод на экран - это метод родительского конструктора
	}
}
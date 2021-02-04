<?php
/** Andrey Shtarev | www.shtarev.com | 18.05.2020
* Pagination for Bootstrap v4.4.1
* При выбори из базы работаем с многомерным массивом типа $result[0]['id'], тогда в шаблоне в foreach, $Pagination->inhalt выводить $value['id']
* Так же можно работать с простым массивом типа $result[0], тогда в шаблоне в foreach, $Pagination->inhalt выводить только $value
* $Pagination = new Pagination(количество выборки, количество кнопок, 'MySql-request');
* $Pagination->inhalt; // массив с текущей выборкой
* $Pagination->pagipunct(); // уже собранные здесь кнопки пагинации
* $Pagination->pagipunctArr(); // данные для сборки пунктов пагинации в шаблоне
*/
namespace vendor\src\Classes;

class Pagination
{
	public $elem = '';
	public $pagPunkt = '';
	public $pagination = array();
	public $end = '';
	public $start = 0;
	public $startja = '';
	public $startnein = '';
	public $endja = '';
	public $endnein = '';
	public $key = 0;
	public $pagi = array();
	public $inhalt = array();

	function __construct($elem, $pagPunkt, $requestResult) {
		$this->elem = $elem;
		$this->pagPunkt = $pagPunkt;
		$this->pagination = array_chunk($requestResult, $elem);
		$this->end = count($this->pagination)-1;
        if(isset($_GET['key'])) { $this->key = $_GET['key']; } // может передаваться GET
        if(isset($_POST['key'])) { $this->key = $_POST['key']; } // может передаваться POST
		$this->inhalt = $this->pagination[$this->key];
	}
	
	public function paginati() {
		if($this->key < $this->pagPunkt-1 || $this->pagPunkt == $this->end+1){

			if($this->pagPunkt > $this->end) {
				$this->startja = 'none'; 
				$this->startnein = '';
				$this->endja = 'none'; 
				$this->endnein = '';
				$this->pagi = array_slice($this->pagination, 0, $this->pagPunkt, true);
			}
			else {
				$this->startja = 'none'; 
				$this->startnein = '';
				$this->endja = ''; 
				$this->endnein = 'none';
				$this->pagi = array_slice($this->pagination, 0, $this->pagPunkt, true);
			}
		}
		elseif($this->key > $this->end - $this->pagPunkt+1) {
			$this->startja = ''; 
			$this->startnein = 'none';
			$this->endja = 'none'; 
			$this->endnein = '';
			$this->pagi = array_slice($this->pagination, -($this->pagPunkt), $this->pagPunkt, true);
		}
		else {
			$this->startja = ''; 
			$this->startnein = 'none';
			$this->endja = ''; 
			$this->endnein = 'none';
			$this->pagi = array_slice($this->pagination, $this->key-round($this->pagPunkt/2, 0, PHP_ROUND_HALF_DOWN), $this->pagPunkt, true);
		}
	}
    
	/* пункты собранные здесь */
	public function pagipunct() {
		$this->paginati();
		echo "
			<li class=\"page-item disabled\" style=\"display:".$this->startnein."\">
				<a class=\"page-link\" href=\"\" tabindex=\"-1\" aria-disabled=\"true\">Previous</a>
			</li>
			<li class=\"page-item\" style=\"display:".$this->startja."\"><a class=\"page-link\" href=\"?key=".$this->start."\">Previous</a></li>
		";
		foreach($this->pagi as $Key => $value){
			if($Key == $this->key){
				echo "
				<li class=\"page-item active\" aria-current=\"page\">
					<a class=\"page-link\" href=\"?key=".$Key."\">".++$Key." <span class=\"sr-only\">(current)</span></a>
				</li>
			";
			}
			else{
				echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?key=".$Key."\">".++$Key."</a></li>";
			}
		}
		echo "
			<li class=\"page-item disabled\" style=\"display:".$this->endnein."\">
				<a class=\"page-link\" href=\"\" tabindex=\"-1\" aria-disabled=\"true\">Next</a>
			</li>
			<li class=\"page-item\"  style=\"display:".$this->endja."\"><a class=\"page-link\" href=\"?key=".$this->end."\">Next</a></li>
		";
	}
    
	/* данные для сборки пунктов в шаблоне */
	public function pagipunctArr() {
		$this->paginati();
		// массив с нужными данными для сборки в шаблоне
		$arr = array();
		$arr['pagi'] = array();
        $arr['key'] = $this->key;
		$arr['startnein'] = $this->startnein;
		$arr['startja'] = $this->startja;
		$arr['start'] = $this->start;
		$arr['endnein'] = $this->endnein;
		$arr['endja'] = $this->endja;
		$arr['end'] = $this->end;
		$arr['pagi'] = $this->pagi;
        return $arr;
	}
}
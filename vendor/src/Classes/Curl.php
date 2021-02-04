<?php
/*
|--------------------------------------------------------------------------
| Curl
|--------------------------------------------------------------------------
|
| Используется для рендеринга страниц требующих динамических изменений.
| Сюда попадаем из разных контроллеров от которых получаем данные для 
| передачи в динамически меняемый вид и отправляем это в CurlController.
| В CurlController поподаем соответственно ссылке 'curl/' при соединении
| $data = массив данных для вида, $view = сам вид,
| $action = метод в CurlController.
| Обратно получаем готовый вид с обработанным HTML-кодом
| Соответственно то же получает контроллер с которого мы сюда пришли.
|
*/
namespace vendor\src\Classes;
//use vendor\src\Classes\Request;

class Curl
{
    /**
    * передаем данные в вид.
    * по ссылке срабатывает CurlController с методом $action в который передаются данные
    * $data - массив данных, $action - метод в CurlController, $view - вид по которому работать
    */
	public static function curlPost($data, $action, $view, $admin = 0) { // POST
        // пути к папке с динамическими видами $admin == 1 если нужны виды используемые для админа
        if($admin) {
            $view = 'app/view/admin/blocks/'.$view.'.php';
        }
        else { 
            $view = 'app/view/blocks/'.$view.'.php';
        }
		//Инициализирует сеанс curl
        $ch = curl_init();  
        // Устанавливаем адрес для подключения, соответственно ссылке - CurlCobtroller
        curl_setopt($ch, CURLOPT_URL, Request::root().'curl/'.$action.'/');  
        curl_setopt($ch, CURLOPT_POST, 1);  
        // Все данные, передаваемые в HTTP POST-запросе. 
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'view='.$view.'&data='.serialize($data));  
        //Говорим, что нам необходим результат, без этой строки следущая команда выведет страницу shtarev.com на экран  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        // выдача результата  
        $result = curl_exec($ch); 
        //Завершает сеанс  
        curl_close($ch); 
        return $result;
	}
    
	public static function curlGet($data, $action, $view, $admin = 0) { // GET
		//Инициализирует сеанс curl
        $ch = curl_init();  
        //Устанавливаем адрес для подключения    
        curl_setopt($ch, CURLOPT_URL, Request::root().'curl?view='.$view.'&data='.serialize($data));
        //Говорим, что нам необходим результат, без этой строки следущая команда выведет страницу shtarev.com на экран  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        // выдача результата  
        $result = curl_exec($ch); 
        //Завершает сеанс  
        curl_close($ch); 
        return $result;
	}
    
}

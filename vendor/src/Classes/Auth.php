<?php
/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
|
| Аутентификация
|
*/
namespace vendor\src\Classes;
use app\models\User;

class Auth
{
	private static $login;
	private static $pass;
	private static $user;
	
	public static function admin() {
        self::$user = User::all()[0];
        
		if(Request::method() ==  'POST') {
            if(isset($_POST['sessionstop'])){
                unset($_SESSION['pass']);
                unset($_SESSION['login']);
                session_destroy();
                return header( 'Location: /' );
            }
            if(isset($_POST['pass'])){
                $_SESSION['pass'] = $_POST['pass'];
			    $_SESSION['login'] = $_POST['login'];
            }
        }
		else {
            if(!isset($_SESSION['pass'])){
                header('Content-Type: text/html; charset=utf-8');
                die("Введите пароль или логин<br><br>
                    <form method='POST' action='/admin'>
                        <input type='text' name='login' placeholder='Введите логин'><br><br>
                        <input type='text' name='pass' placeholder='Введите пароль'><br><br>
                        <input type='submit' value='Отправить'>
                    </form> ");
            }
		}
		if(self::$user['pass'] != $_SESSION['pass'] || self::$user['login'] != $_SESSION['login']){
			header('Content-Type: text/html; charset=utf-8');
			die("Не верный пароль или логин<br><br>
				<form method='POST' action='/admin'>
					<input type='text' name='login' placeholder='Введите логин'><br><br>
					<input type='text' name='pass' placeholder='Введите пароль'><br><br>
					<input type='submit' value='Отправить'>
				</form>");
		}
	}
}

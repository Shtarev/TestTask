<?php
/*
|--------------------------------------------------------------------------
| Model
|--------------------------------------------------------------------------
|
| Это наследуют модели таблиц базы
|
*/
namespace  app\models\src;
use Config;

class Model 
{

    // вычисляем таблицу с которой работат, вычисляем по названию класса потомка
    protected static function table() {
        $child = get_called_class();
        $table = strtolower(substr($child, strrpos($child, '\\')+1));
        return $table;
    }

    // подключение к базе
    protected static function connect() {
        return mysqli_connect(Config::$connect['host'],Config::$connect['root'],Config::$connect['parol'],Config::$connect['baza']);
    }
    
    /**
    * Полностью наследуемые методы, т.е. методы вызываемые из контроллеров.
    */

    // вся выборка из таблицы в ассоциативном массиве
    public static function all() {
        return self::connect()->query("SELECT * FROM `".self::table()."`")->fetch_all(MYSQLI_ASSOC);
    }
    
    // запрос в базу и получение по запросу ассоциативного массива выборки
    public static function one($id) {
        return self::connect()->query("SELECT * FROM `".self::table()."` WHERE id=".$id."")->fetch_array();
    }
    
    /**
    * Методы обрабатывающие запроы с параметрами из моделей.
    */
    
    // запрос в базу
    public static function query($query) {
        return self::connect()->query($query);
    }
    
    // запрос в базу и получение по запросу ассоциативного массива выборки
    public static function query_all($query) {
        return self::connect()->query($query)->fetch_all(MYSQLI_ASSOC);
    }
    
}
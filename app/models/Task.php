<?php
namespace app\models;
use app\models\src\Model;

class Task extends Model
{
    protected static $table = 'task';
    protected static $row = '';
    protected static $val = '';
    
    public static function sorti($handle, $tip) {
        return parent::query_all("SELECT * FROM `".self::$table."` ORDER BY `$handle` $tip");
    }
    
    public static function inserti($arr) {
        self::arrHandler($arr);
        return parent::query("INSERT INTO `".self::$table."` (".self::$row.") VALUES (".self::$val.")");
    }
    
    public static function del($id) {
        return parent::query("DELETE FROM `".self::$table."` WHERE id=".$id."");
    }
    
    public static function selecttask($id) {
        return parent::query_all("SELECT * FROM `".self::$table."` WHERE id=".$id."");
    }
    
    public static function red($arr) {
        return parent::query("UPDATE `".self::$table."` SET `name`='".$arr['name']."', `email`='".$arr['email']."', `task`='".$arr['task']."', `status`='".$arr['status']."', `redact`='".$arr['redact']."' WHERE id=".$arr['id']."");
    }
    
    public static function arrHandler($arr) { // обрабатываем массив в строки для внесения в запрос
        $row = '';
        $val = '';
        foreach($arr as $key=>$value) {
            $row = $row.$key.",";
            $val = $val."'".$value."',";
        }
        self::$row = mb_substr($row, 0, -1);
        self::$val = mb_substr($val, 0, -1);
    }
}
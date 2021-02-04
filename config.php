<?php
session_start();
 
use vendor\src\Classes\Request;

require 'vendor\src\func\autoload.php';

// данные для подключения к базе
class Config
{
    public static $connect = [
        'host' => 'localhost',
        'root' => 'root',
        'parol' => '',
        'baza' => 'testtask'
    ];
}
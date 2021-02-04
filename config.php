<?php
session_start();
 
require 'vendor/src/Classes/Request.php';
require 'vendor/src/func/autoload.php';

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

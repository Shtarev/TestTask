<?php 
if(isset($_POST['sessionstop'])){
    unset($_SESSION['pass']);
    unset($_SESSION['login']);
    session_destroy();
    header( 'Location: /' );
}
if(!isset($_POST['pass'])){
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
else {
    $_SESSION['pass'] = $_POST['pass'];
    $_SESSION['login'] = $_POST['login'];
}
if($pass != $_SESSION['pass'] || $login != $_SESSION['login']){
    header('Content-Type: text/html; charset=utf-8');
    die("Не верный пароль или логин<br><br>
        <form method='POST' action='/admin'>
            <input type='text' name='login' placeholder='Введите логин'><br><br>
            <input type='text' name='pass' placeholder='Введите пароль'><br><br>
            <input type='submit' value='Отправить'>
        </form>");
}
?>
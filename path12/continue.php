<?php

session_start();

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $forename = $_SESSION['forename'];
    $surname = $_SESSION['surname'];

   session_destroy_and_data();

    echo "С возвращением $forename <br> Ваше полное имя $forename $surname . <br> Ваше имя пользователя '$username' и ваш пароль '$password'";
}else{
    echo "Пожалуйст, для входа  <a href='autentificate.php'>Щелкните здесь</a>";
}

function session_destroy_and_data(){
    $_SESSION = array();
    if(session_id() != "" || isset($_COOKIE[session_name()])){
        setcookie(session_name(),'', time() - 2592000,'/');
    }
    session_destroy();
}
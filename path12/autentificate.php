<?php

require_once "../login.php";

$conn = new mysqli($hn, $us, $pw, $db);

if($conn->connect_error){
    die($conn->connect_error);
}

if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
    $un_temp = mysql_entities_fix_string($conn, $_SERVER['PHP_AUTH_USER']);
    $pw_temp = mysql_entities_fix_string($conn, $_SERVER['PHP_AUTH_PW']);

    $query = "SELECT * FROM users WHERE username='$un_temp'";
    $result = $conn->query($query);
    if(!$result){
        die($conn->error);
    }elseif($result->num_rows){
        $row = $result->fetch_array(MYSQLI_NUM);
        $result->close();

        $salt1 = "qm&h";
        $salt2 = "pg!@";
        $token = hash('ripemd128', "$salt1$pw_temp$salt2");

        if($token == $row[3]){
            session_start();
            $_SESSION['username'] = $un_temp;
            $_SESSION['password'] = $pw_temp;
            $_SESSION['forename'] = $row[0];
            $_SESSION['surname'] = $row[1];
            echo "$row[0] $row[1]: Привет, $row[0], теперь вы зарегестрированны под именем '$row[2]'";
            die("<p><a href='continue.php'>Шелкните для продолжения</a></p>");
        }else{
            die("Неверная комбинация имя - пароль");
        }
    }else{
        die("Неверная комбинация имя - пароль");
    }
}else{
    header('WWW-Authenticate: Basic realm="Restricted Section"');
    header('HTTP/1.0 401 Unauthorized');
    die("Пожалуйста введите имя пользователя и пароль");

}

$conn->close();

function mysql_entities_fix_string($conn,$string){
    return htmlentities(mysql_fix_string($conn,$string));
}

function mysql_fix_string($conn,$string){
    return $conn->real_escape_string($string);
}
<?php


require_once '../login.php';

$conn = new mysqli($hn,$us,$pw,$db);

if($conn->connect_error){
    die($conn->connect_error);
}

$query = "DROP TABLE cats";
$result = $conn->query($query);

if(!$result){
    die("Сбой при соединениее с БД" . $conn->error);

}else{
    echo "Таблица удалена";
}

echo "<br> <a href='index.php'>Перейти на главную</a>";
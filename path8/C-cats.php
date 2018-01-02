<?php

require_once '../login.php';

$conn = new mysqli($hn,$us,$pw,$db);

if($conn->connect_error){
    die($conn->connect_error);
}

$query = "CREATE TABLE cats(
id SMALLINT NOT NULL AUTO_INCREMENT,
family VARCHAR(32) NOT NULL,
name VARCHAR(32) NOT NULL,
age TINYINT NOT NULL,
PRIMARY KEY (id)
)";

$result = $conn->query($query);

if(!$result){
    die('Сбой при доступе к базе данных' . $conn->error);
}else{
    echo "Таблица cats создана ! <a href='S-cats.php'>Посмотреть Таблицу</a>";
}
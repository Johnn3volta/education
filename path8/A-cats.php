<?php
require_once '../login.php';

$conn = new mysqli($hn,$us,$pw,$db);

if($conn->connect_error){
    die($conn->connect_error);
}

$query = "INSERT INTO cats VALUES (NULL, 'Cheetah', 'Charly', 3)";

$result = $conn->query($query);

if(!$result){
    die("СБой при обращении к БД" . $conn->error);
}else{
    echo "Запись успешно добавлена <br> Значение вставденого Id = " . $conn->insert_id;
}

echo "<br><a href='index.php'>Перейти на главную</a>";
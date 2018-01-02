<?php

echo "<ul><li><a href='C-cats.php'>Создать таблицу</a></li><li><a href='D-cats.php'>Удалить таблицу</a></li><li><a href='S-cats.php'>Посмотреть таблицу</a></li><li><a href='A-cats.php'>обавить запись в таблицу</a></li><hr>";

require_once '../login.php';

$conn = new mysqli($hn, $us, $pw, $db);

if($conn->connect_error){
    die($conn->connect_error);
}

$query = "UPDATE cats SET name='Charlie' WHERE name='Charly'";
$result = $conn->query($query);

if(!$result){
    die("Чтото пошло не так " . $conn->error);
}


$query = "SELECT * FROM cats";
$result = $conn->query($query);

if(!$result){
    die("Сбой при подключении БД" . $conn->error);
}

$rows = $result->num_rows;

echo "<table><tr><th>Id</th><th>Family</th><th>Name</th><th>Age</th></tr>";

for($i = 0;$i < $rows; $i++){
    $result->data_seek($i);
    $row = $result->fetch_array(MYSQLI_NUM);

    echo "<tr>";
    for($k = 0; $k < 4; $k++){
        echo "<td>$row[$k]</td>>";
    }
    echo "</tr>";
}

echo "</table>";


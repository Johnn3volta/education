<?php
require_once '../login.php';

$conn = new mysqli($hn,$us,$pw,$db);

if($conn->connect_error){
    die($conn->connect_error);
}
$query = "DESCRIBE cats";
$result = $conn->query($query);

if(!$result){
    die('Сбой при доступе к базе данных ' . $conn->error);
}

$rows = $result->num_rows;

echo "<table><tr><th> column</th><th>Type</th><th>Null</th><th>KEY</th></tr>";
for($i = 0; $i < $rows; $i++){
    $result->data_seek($i);
    $row = $result->fetch_array(MYSQLI_NUM);

    echo "<tr>";
    for($k = 0; $k < 4; $k++){
        echo "<td>$row[$k]</td>";
    }
}

echo "<br> <a href='index.php'>Перейти на главную</a>";
<?php

require_once 'login.php';

$conn = new mysqli($hn, $us, $pw, $db);

if ($conn->connect_error) {
    die($conn->connect_error);
}

$query = 'SELECT * FROM classics';
$result = $conn->query($query);
if (!$result) {
    die($conn->error);
}


$rows = $result->num_rows;
for ($i = 0; $i < $rows; $i++) {
    $result->data_seek($i);
    $row = $result->fetch_array();
    echo 'ID: ' . $row['id'] . '<br>';
    echo 'Author: ' . $row['author'] . '<br>';
    echo 'Title: ' . $row['title'] . '<br>';
    echo 'Category: ' . $row['category'] . '<br>';
    echo 'Year: ' . $row['year'] . '<br><br>';
}

$result->close();
$conn->close();

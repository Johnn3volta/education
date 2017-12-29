<?php
require_once 'login.php';

$conn = new mysqli($hn, $us, $pw, $db);

if ($conn->connect_error) {
    die ($conn->connect_error);
}

if (isset($_POST['delete']) && isset($_POST['year'])) {
    $year = get_post($conn, 'year');
    $query = "DELETE FROM classics WHERE year='$year'";
    $result = $conn->query($query);
    if (!$result) {
        echo "Сбой при удалении данных: $query<br>" . $conn->error . "<br><br>";
    }else{
        echo "Успешно удалено";
    }
}

if (isset($_POST['author']) && isset($_POST['title']) && isset($_POST['category']) && isset($_POST['year'])) {
    $author = get_post($conn, 'author');
    $title = get_post($conn, 'title');
    $category = get_post($conn, 'category');
    $year = get_post($conn, 'year');

    $query = "INSERT INTO classics(author,title,category,year) VALUES" . "('$author','$title','$category','$year')";
    $result = $conn->query($query);
    if (!$result) {
        echo "Сбой при вставке данных: $query<br>" . $conn->error . "<br><br>";
    }

}

echo <<<_END
<form action="" method="post"><pre>
Author <input type="text" name="author">
Title <input type="text" name="title">
Category <input type="text" name="category">
Year <input type="text" name="year">
<input type="submit" value="ADD RECORD">
</pre></form>
_END;

$query = "SELECT * FROM classics";
$result = $conn->query($query);
if (!$result) {
    die("Сбой при доступе к базе данных" . $conn->error);
}

$rows = $result->num_rows;

for ($i = 0; $i < $rows; $i++) {
    $result->data_seek($i);
    $row = $result->fetch_array(MYSQLI_NUM);
    echo <<<_END
<pre>
Author : $row[0]
Title : $row[1]
Category : $row[2]
Year : $row[3]
</pre>
<form method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="year" value="$row[3]">
<input type="submit" value="DELETE RECORD">
</form>
_END;
}

$result->close();
$conn->close();

function get_post($conn, $var){
    return $conn->real_escape_string($_POST[$var]);
}
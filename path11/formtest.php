<?php

if (isset($_POST['name'])){
    $name = $_POST['name'];
}else{
    $name = 'Имя не введено';
}

echo <<<_END
<html>
<head>
<title>Form Test</title>
<body>
Вас зовут: $name<br>
<form method="post">
Как вас зовут ?
<input type="text" name="name">
<input type="submit">
</form>
</body>
</head>
</html>
_END;

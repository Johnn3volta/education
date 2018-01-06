<?php

$f = $c = '';

if(isset($_POST['f'])){
    $f = sanitizeString($_POST['f']);
}
if(isset($_POST['c'])){
    $c = sanitizeString($_POST['c']);
}

if($f != ''){
    $c = intval((5 / 9) * ($f - 32));
    $out = "$f °f равно $c °c ";
}elseif($c != ''){
    $f = intval((9 / 5) * $c + 32);
    $out = "$c °c равно $f °f ";
}else{
    $out = '';
}

echo <<<_END
<html>
<head>
<title>
Программа перевода температуры
</title>
</head>
<body>
<pre>
Введите температутру по фаренгейту или по цельсию
и нажмите кнопку перевести
<strong>$out</strong>
<form method="post">
По Фаренгейту <input type="text" name="f" size="7">
По Цельсию <input type="text" name="c" size="7">
Цвет <input type="color" name="color">
<input type="submit" value="Перевести">
</form>
</pre>
</body>
</html>
_END;

function sanitizeString($var){
    $var = stripcslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
}

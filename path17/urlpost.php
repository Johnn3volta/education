<?php

if(isset($_POST['url'])){
    echo file_get_contents('http://' . SanitizeString($_POST['url']));
}

function SanitizeString($str){
    $str = strip_tags($str);
    $str = htmlentities($str);

    return stripslashes($str);
}
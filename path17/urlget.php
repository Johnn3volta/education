<?php

if(isset($_GET['url'])){
    echo file_get_contents("http://" . SanitizeString($_GET['url']));
}

function SanitizeString($str){
    $str = strip_tags($str);
    $str = htmlentities($str);

    return stripslashes($str);
}


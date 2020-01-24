<?php

    $db = new mysqli('localhost', 'test', '123');
    if ($db->connect_errno){ 
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error); 
        }
    if (!mysqli_select_db($db, 'test')){
        die('Не удалось выбрать базу данных test');
    }
    mysqli_query($db, "SET NAMES utf8");
    
?>
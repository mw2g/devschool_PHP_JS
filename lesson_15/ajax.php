<?php
    require_once ("oop.php");
    
    switch ($_GET['action']){

        case 'delete':
            ads::delete((int)$_GET['del_ad']);
            break;
        
        default:
            break;
    }
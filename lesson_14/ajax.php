<?php
require_once ("oop.php");
require_once ("settings.php");

switch ($_GET['action']) {
    case "delete":
        $db->query("DELETE FROM ads where id=?d",$_GET['id']);
        echo "Объявление № ".$_GET['id']." удалено.";
        
        break;
    
    default:
        break;
}

?>
<?php
include 'config.php';
switch ($_GET['action']) {
    case "delete":
        if($db->query("DELETE FROM ads where id=?d",$_POST['id'])){
            $result['status']='success';
            $result['message'] = "Tovar ".$_POST['id']." udalen uspeshno";
        }else{
            $result['status']='error';
            $result['message'] = "Error text";
        }
        $result['server'] = $_SERVER;    
        echo json_encode($result);

        break;

    default:
        break;
}


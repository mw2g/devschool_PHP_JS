<?php
include 'config.php';
switch ($_GET['action']) {
    case "insert":{
        $id=$db->query('INSERT INTO ads(?#) VALUES(?a)',  array_keys($_POST), array_values($_POST));
        if($id){
            $result['status']='success';
            
            $ad = $db->selectRow("select * from ads where id=?d",$id);
            $ad = new Ads($ad);
            $smarty->assign('ad',$ad);
            $result['tovar'] = $smarty->fetch('table_row.tpl.html');
            $result['message'] = "Tovar ".$id." uspeshno dobavlen";
        }else{
            $result['status']='error';
            $result['message'] = "Error insert or update database";
        }
        break;
    }
    case "delete":
        if($db->query("DELETE FROM ads where id=?d",$_GET['id'])){
            $result['status']='success';
            $result['message'] = "Tovar ".$_GET['id']." udalen uspeshno";
        }else{
            $result['status']='error';
            $result['message'] = "Error text";
        }
        break;

    default:
        break;
}

echo json_encode($result);



<?php
    require_once ("oop.php");
    
    switch ($_GET['action']){

        case 'submit':                  // сохранить/добавить
            $ad = ads::save($_POST);
            $res = array('id'=>$ad->getId(),'title'=>$ad->getTitle(),'description'=>$ad->getDescription(),'color'=>$ad->getColor());
            if($_GET['addEdit']=='edit'){
                $res['action'] = 'edit';
            }  elseif($_GET['addEdit']=='add') {
                $res['action'] = 'add';
            }
            echo (json_encode($res));
            break;

        case 'open':                    // открыть
            $ad1 = AdsStore::instance()->getAdFromDb($_POST['id']);
            echo json_encode($ad1);
            break;

        case 'delete':                  // удалить
            if(ads::delete($_GET['id'])){
                $result['status']='success';
                $result['message'] = "Объявление ".$_GET['id']." успешно удалено.";
            }else{
                $result['status']='error';
                $result['message'] = "Ошибка при удалении.";
            }
            echo json_encode($result);
            break;

        case 'clear_base':              // очистить базу данных
            if(AdsStore::instance()->clearDB()){
                $result['status']='success';
                $result['message'] = "База данных успешно очищена";
            }else{
                $result['status']='error';
                $result['message'] = "Ошибка при очистке базы данных.";
            }
            echo json_encode($result);
            break;

        default:
            break;
    }
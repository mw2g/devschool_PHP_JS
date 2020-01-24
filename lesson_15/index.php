<?php
    require_once ("oop.php");
    
    $adsStore = AdsStore::instance()->getAllAdsFromDb();
    
    if (isset($_POST['submit'])){                                // если нажата кнопка добавить/сохранить
        $adsStore->save($_POST);                              
    }
    
    elseif (isset($_POST['clear_form'])){
    }

    elseif (isset ($_POST['clear_base'])) {                     // по кнопке очистить базу, удаляем все строки из таблицы ads
        $adsStore->clearDB();
    }

    elseif (isset($_GET['click_id'])){                          // действие по клику на объявление
        $adsStore->prepareForOut()->display((int)$_GET['click_id']);
    }

    $adsStore->prepareForOut()->display();
    
?>
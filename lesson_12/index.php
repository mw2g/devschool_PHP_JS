<?php
    require_once ("oop.php");
    require_once ("settings.php");
    $adsStore = AdsStore::instance()->getAllAdsFromDb();

    if (isset($_POST['submit'])){                                // если нажата кнопка добавить/сохранить
        $adsStore->save($_POST);                              
    }
    
    elseif (isset($_POST['clear_form'])){
    }

    elseif (isset ($_POST['clear_base'])) {                     // по кнопке очистить базу, удаляем все строки из таблицы ads
        $adsStore->clearDB();
    }

    elseif (isset($_GET['del_ad'])){                            // если нажата ссылка Удалить
        $adsStore->del((int)$_GET['del_ad']);
    }

    elseif (isset($_GET['click_id'])){                          // действие по клику на объявление
        $adsStore->prepareForOut()->display((int)$_GET['click_id']);
        exit();
    }

    $adsStore->prepareForOut()->display();
    
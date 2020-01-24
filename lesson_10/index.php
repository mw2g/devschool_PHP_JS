<?php
    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    header("Content-Type: text/html; charset=utf-8");
    require_once ("functions.php");                             // подключаем функциями
    require_once ("settings.php");                              // подключаем настройки smarty
    require_once ("connect_mysql.php");                         // подключаем соединение с mysql
    
    if (isset($_POST['confirm_add'])){                          // если нажата кнопка добавить/сохранить
        if (is_numeric($_POST['id_r'])){                        // если присутствует метка id_r то сохраняем редактируемое объявление
            edit_ad($db, $_POST);
        }
        else { 
           add_ad($db, $_POST);                                 // иначе добавляем новое объявление
        }
    restart();
    }
    
    elseif (isset($_POST['clear_form'])||isset($_GET['back'])){  // кнопки очистить форму и назад вызывают restart();
        restart();
    }
    
    elseif (isset ($_POST['clear_base'])) {                     // по кнопке очистить базу, удаляем все строки из таблицы ads
        $db->query("delete from `ads` where 1");
        restart();
    }
    
    elseif (isset($_GET['del_ad'])){                        // ловим ключ del_ad в массиве $_GET - нажата ссылка Удалить
        $del_id = (int)($_GET['del_ad']);
        if ($db->selectRow('SELECT * FROM `ads` WHERE id=?d', $del_id)){      // если существует объявление с таким ключом удаляем его
            $db->query("delete from `ads` where id='$del_id'");
            restart();
        }
        else{                                               // иначе выводим ошибку
            error();   
        }
    }
    
    elseif (isset($_GET['click_id'])){                      // действие по клику на объявление
        $click_id = (int)$_GET['click_id'];                 // присваиваем переменной $click_id номер кликнутого объявления
        if ($db->selectRow('SELECT * FROM `ads` WHERE id=?d', $click_id)){; // если объявление с запрашиваемым номером существует
            display_form($db, $smarty, $click_id);          // выводим объявление в форму
        }
        else {                                              // иначе выводим сообщение о его отсутствии
            error();
        }
    }
    
    else{
        display_form($db, $smarty);                         // выводим форму
    }
?>
<?php
    error_reporting(E_ALL);
    header("Content-Type: text/html; charset=utf-8");
    require_once ("dz9_functions.php");             // подключаем файл с функциями
    
    $db = mysql_connect('localhost', 'test', '123') or die('MySQL сервер недоступен');
    mysql_selectdb('test', $db) or die('Не удалось выбрать базу данных');
    mysql_query("SET NAMES utf8");
    
    $cities_query = mysql_query('SELECT * FROM `cities`');              //выбираем из базы данных города и записываем их в массив
    while ($row = mysql_fetch_assoc($cities_query)) {
        $cities[$row['id']] = $row['city'];
    }
    
    $categories_query = mysql_query('SELECT * FROM `categories`');      //выбираем из базы данных категории и записываем их в массив
    while ($row = mysql_fetch_assoc($categories_query)) {
        if (!$row['subcategory']){ $categories[$row['subcategory']] = $row['category']; }
        $categories[$row['subcategory']][$row['id']] = $row['category'];
    }
    
    $project_root = $_SERVER['DOCUMENT_ROOT'].'/dz9';
    $smarty_dir = $project_root.'/smarty/';
    
    // put full path to Smarty.class.php
    require($smarty_dir.'libs/Smarty.class.php');
    $smarty = new Smarty();
    $smarty->compile_check = true;
    $smarty->debugging = true;

    $smarty->template_dir = $smarty_dir.'templates/';
    $smarty->compile_dir = $smarty_dir.'templates_c/';
    $smarty->cache_dir = $smarty_dir.'cache/';
    $smarty->config_dir = $smarty_dir.'configs/';

    $smarty->assign('title', 'Купи слона');
    $smarty->assign('cities', $cities);
    $smarty->assign('categories', $categories);

    if (isset($_POST['confirm_add'])){                          // если нажата кнопка добавить/сохранить
        if (is_numeric($_POST['id_r'])){                        // если присутствует метка id_r то сохраняем редактируемое объявление
            edit_ad($_POST);
        }
        else { 
           add_ad($_POST);                                      // иначе добавляем новое объявление
        }
    restart();
    }
    
    elseif (isset($_POST['clear_form'])||isset($_POST['back'])||isset($_GET['clear_form'])){  // кнопки очистить форму и назад вызывают restart();
        restart();
    }
    
    elseif (isset ($_POST['clear_base'])) {                     // по кнопке очистить базу, удаляем все строки из таблицы ads
        mysql_query("delete from `ads` where id>0");
        restart();
    }
    
    elseif (isset($_GET['del_ad'])){                        // ловим ключ del_ad в массиве $_GET - нажата ссылка Удалить
        $del_id = (int)($_GET['del_ad']);
        if (mysql_fetch_array(mysql_query("SELECT id FROM `ads` where id='$del_id'"))){   // если существует объявление с таким ключом удаляем его
            mysql_query("delete from `ads` where id='$del_id'");
            restart();
        }
        else{                                       // иначе выводим ошибку
            error();   
        }
    }
    
    elseif (isset($_GET['click_id'])){              // действие по клику на объявление
        $click_id = (int)$_GET['click_id'];         // присваиваем переменной $click_id номер кликнутого объявления
        if (mysql_fetch_array(mysql_query("SELECT id FROM `ads` where id='$click_id'"))){         // если объявление с запрашиваемым номером существует
            display_form($smarty, $click_id);            // выводим объявление в форму
        }
        else {                                      // иначе выводим сообщение о его отсутствии
            error();
        }
    }
    
    else{
        display_form($smarty);            // выводим форму
    }
?>
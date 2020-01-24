<?php
    error_reporting(E_ALL);
    header("Content-Type: text/html; charset=utf-8");
    require_once ("dz8_functions.php");             // подключаем файл с функциями
    require ("dz8_data.php");                       // подключаем файл с данными
    
    $project_root = $_SERVER['DOCUMENT_ROOT'].'/dz8';
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
    $smarty->assign('citys', $citys);
    $smarty->assign('categorys', $categorys);
    
    $ads = array();
    if (file_exists('dz8_bd.txt')){                             // если есть такой файл
        $ads = unserialize(file_get_contents('dz8_bd.txt'));    // расшифровываем данные и записываем их в $ads
    }

    if (isset($_POST['confirm_add'])){                          // если нажата кнопка добавить/сохранить
        if (is_numeric($_POST['id_r'])){                        // если присутствует метка id_r то сохраняем редактируемое объявление -
            $ads[$_POST['id_r']] = $_POST;                      //  - изменяем запись в массиве $ads[] по ключу id_r
        }
        else { 
            $ads[] = $_POST;                                    // иначе добавляем новое объявлениев массив $ads[]
        }
    save_ads($ads);                                             // вызываем save_ads() - сохраняем массив с объявами
    restart();
    }
    
    elseif (isset($_POST['clear_form'])||isset($_POST['back'])||isset($_GET['clear_form'])){  // кнопки очистить форму и назад вызывают restart();
        restart();
    }
    
    elseif (isset ($_POST['clear_base'])) {         // по кнопке очистить базу сохраняем в файл NULL
        save_ads(NULL);
        restart();
    }
    
    elseif (isset($_GET['del_ad'])){                // ловим ключ del_ad в массиве $_GET - нажата ссылка Удалить
        $del_id = (int)($_GET['del_ad']);
        if (isset($ads[$del_id])){                  // если существует объявление с таким ключом удаляем его
            unset($ads[$del_id]);
            save_ads($ads);                             // вызываем save_ads() - сохраняем массив с объявами
            restart();
        }
        else{                                       // иначе выводим ошибку
            error();   
        }
    }
    
    elseif (isset($_GET['click_id'])){              // действие по клику на объявление
        $click_id = (int)$_GET['click_id'];         // присваиваем переменной $click_id номер кликнутого объявления
        if (isset($ads[$click_id])){                // если объявление с запрашиваемым номером существует
            display_form($smarty, $ads, $ads[$click_id]);            // выводим объявление в форму
        }
        else {                                      // иначе выводим сообщение о его отсутствии
            error();
        }
    }
    
    else{
        display_form($smarty, $ads);            // выводим объявление в форму
    }
?>
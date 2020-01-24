<?php
    error_reporting(E_ALL);
    header("Content-Type: text/html; charset=utf-8");
    require_once ("dz7_1_functions.php");           // подключаем файл с функциями
    $ads = array();
    if (isset($_COOKIE['ads']) && $_COOKIE['ads']!='i:0;'){                    // если есть такая кука
        $ads = unserialize($_COOKIE['ads']);        // расшифровываем данные из $_COOKIE['ads'] и записываем их в $ads
    }
//    if (!is_array($ads)){                           // если $ads до сих пор не массив, объявляем его таким.
//        $ads = array(); 
//    } 
    
    if (isset($_POST['confirm_add'])){              // если нажата кнопка добавить/сохранить
        if (is_numeric($_POST['id_r'])){                // если присутствует метка id_r то сохраняем редактируемое объявление -
            $ads[$_POST['id_r']] = $_POST;                  //  - изменяем запись в массиве $ads[] по ключу id_r
        }
        else { 
            $ads[] = $_POST;                            // иначе добавляем новое объявлениев массив $ads[]
        }
    save_ads($ads);                                 // вызываем save_ads() - сохраняем массив с объявами в куку
    restart();
    }
    
    elseif (isset($_POST['clear_form'])||isset($_POST['back'])||isset($_GET['clear_form'])){      // кнопки очистить форму и назад вызывают restart();
        restart();
    }
    
    elseif (isset ($_POST['clear_base'])) {         // по кнопке очистить базу очищаем куки
        save_ads(0);
        restart();
    }
    
    elseif (isset($_GET['del_ad'])){                // ловим ключ del_ad в массиве $_GET
        $del_id = (int)($_GET['del_ad']);
        if (isset($ads[$del_id])){                  // если существует объявление с таким ключом удаляем его
            del_ad($del_id);
            save_ads($ads);                             // вызываем save_ads() - сохраняем массив с объявами в куки
            restart();
        }
        else{                                       // иначе выводим ошибку
            error();   
        }
    }
    
    elseif (isset($_GET['click_id'])){              // действие по клику на объявление
        $click_id = (int)$_GET['click_id'];         // присваиваем переменной $click_id номер кликнутого объявления
        if (isset($ads[$click_id])){                // если объявление с запрашиваемым номером существует
            print_form($ads[$click_id]);            // выводим объявление в форму
        }
        else {                                      // иначе выводим сообщение о его отсутствии
            error();
        }
    }
    
    else{
        print_form();                               // иначе выводим пустую форму
        show_all($ads);
    }
?>
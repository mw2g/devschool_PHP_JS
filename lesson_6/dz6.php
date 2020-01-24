<?php
    
    header("Content-Type: text/html; charset=utf-8");
    session_start();
    require_once ("dz6_functions.php");                              // подключаем файл с функциями
    
    if (isset($_POST['confirm_add'])){                          // кнопка добавить
        if (is_numeric($_POST['id_r'])){                        // если присутствует метка id_r то сохраняем редактируемое объявление -
            $_SESSION['ad'][$_POST['id_r']] = $_POST;           //  - изменяем запись в массиве $_SESSION['ad'][] по ключу id_r
        }
        else { 
            $_SESSION['ad'][] = $_POST;                         // добавляем новое объявлениев массив $_SESSION['ad'][]
        }
        restart();                                              // вызываем restart(); для очистки формы
    }
    
    elseif (isset($_POST['clear_form'])||isset($_POST['back'])){      // кнопка очистить форму  вызывает restart();
        restart();
    }
    
    elseif (isset ($_POST['clear_base'])) {                     // по кнопке очистить базу очищаем массив $_SESSION['ad']
        unset($_SESSION['ad']);
        restart();
    }
    
    elseif (isset($_GET['del_ad'])){                            // ловим ключ del_ad в массиве $_GET
        del_ad((int)($_GET['del_ad']));                         // и удаляем запись по этому ключу в массиве $_SESSION['ad']
        $_SESSION['ad'] = array_values($_SESSION['ad']);        // переназначаем ключи массива с объявлениями после удаления по порядку
        restart();
    }
    
    elseif (isset($_GET['click_id'])){                          // действие по клику на объявление
        $click_id = (int)$_GET['click_id'];                     // присваиваем переменной $click_id номер кликнутого объявления
        $_SESSION['ad'][$click_id]['id'] = $click_id;           // присваиваем элементу массива с текущимобъявлением его номер в ключ id для возможности его сохранения
        print_form($_SESSION['ad'][$click_id]);                 // выводим объявление в форму
    }
    
    else{
        print_form();                                           // иначе выводим пустую форму
        show_all();
    }
?>
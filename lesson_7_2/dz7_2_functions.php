<?php

    function print_form($print_ad=NULL){                // функция вывода формы
        require_once ("dz7_2_form.php");                // подключаем файл с HTML формой
    }
    
    function selected($data, $id = null){               // прекрасная функция вывода селектора, я до такого ещё не дорос
        foreach($data as $k => $v){
            if(is_array($v)){
                echo "<optgroup label='$k'>";
                selected($v,$id);
                echo '</optgroup>';
            }else{
                $selected = ( $id == $k )? 'selected=\'\'' : '';
                echo '<option '.$selected.' value='.(int)$k.'>'.$v.'</option>';
            }
        }
    }
    
    function del_ad($id){                                       // Функция удаления объявления
        global $ads;
        unset($ads[$id]);        
    }
    
    function show_all($ads){                                    // Функция вывода всех объявлений из $ads
    if (!empty($ads)){
        foreach ($ads as $num => $ad) {
            echo "<div align='left'><a href='$_SERVER[SCRIPT_NAME]?click_id=$num'> # {$ad['title']}  </a> |   Цена: {$ad['price']} | Продавец: {$ad['seller_name']} | <a href='$_SERVER[SCRIPT_NAME]?del_ad=$num'>Удалить</a><br>";
        }
    }
    }
    
    function save_ads($ads){                                    // функция сохранения БД
        file_put_contents('dz7_bd.txt', serialize($ads));
    }
  
    function restart(){                                         // функция перезапуска скрипта
        header("Location: $_SERVER[SCRIPT_NAME]");
        exit;
    }
    
    function error(){                                           // вывод ошибки
        echo "<h1 style='color:red' align='center'> НЕТ ТАКОГО ОБЪЯВЛЕНИЯ!<br> <a href='$_SERVER[SCRIPT_NAME]?clear_form=''>НАЗАД</a>";
        exit();
    }
?>
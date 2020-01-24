<?php               // файл с функциями dz8
    
    function display_form($smarty, $ads, $display = NULL){                // функция вывода формы
        $smarty->assign('display', $display);
        $smarty->assign('ads', $ads);
        $smarty->display('form_ad.tpl');
    }
    
    function save_ads($ads){                                    // функция сохранения БД
        file_put_contents('dz8_bd.txt', serialize($ads));
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
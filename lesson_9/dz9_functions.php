<?php               // файл с функциями dz9
    
    function display_form($smarty, $display_id = 0){                // функция вывода формы
        $ads_query = mysql_query("SELECT * FROM `ads`  where id = $display_id");
        $row = mysql_fetch_assoc($ads_query);
        $smarty->assign('display', $row);
        $ads = array();
        $ads_query = mysql_query('SELECT * FROM `ads`');
        while ($row = mysql_fetch_assoc($ads_query)) {
            $ads[$row['id']] = $row;
        }
        $smarty->assign('ads', $ads);
        $smarty->display('form_ad.tpl');
    }
    
    function add_ad($ad){                                    // функция добавления объявления в БД
        if (!isset($ad['allow_mail'])){     $ad['allow_mail']=0;    }
        mysql_query("insert into `ads` (`private`, `seller_name`, `email`, `allow_mail`, `phone`, `city_id`, `category_id`, `title`, `description`, `price`)
                    values ('{$ad['private']}', '{$ad['seller_name']}', '{$ad['email']}', '{$ad['allow_mail']}', '{$ad['phone']}', '{$ad['city_id']}', '{$ad['category_id']}', '{$ad['title']}', '{$ad['description']}', '{$ad['price']}')");
    }
    
    function edit_ad($ad){                                    // функция редактирования объявления
        if (!isset($ad['allow_mail'])){     $ad['allow_mail']=0;    }
        mysql_query("update `ads` set `private`='{$ad['private']}', `seller_name`='{$ad['seller_name']}', `email`='{$ad['email']}', "
        . "`allow_mail`='{$ad['allow_mail']}', `phone`='{$ad['phone']}', `city_id`='{$ad['city_id']}', `category_id`='{$ad['category_id']}', "
        . "`title`='{$ad['title']}', `description`='{$ad['description']}', `price`='{$ad['price']}' where id='{$ad['id_r']}'");
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
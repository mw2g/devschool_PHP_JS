<?php               // файл с функциями dz9
    
    function display_form($db, $smarty, $display_id = 0){                // функция вывода формы
        $ad_query = get_ad($db, $display_id);
        $row = mysqli_fetch_assoc($ad_query);
        $smarty->assign('display', $row);
        
        $ads = array();
        $ads_query = get_ads($db);
        while ($row = mysqli_fetch_assoc($ads_query)) {
            $ads[$row['id']] = $row;
        }
        $smarty->assign('ads', $ads);
        $smarty->assign('cities', get_cities($db));
        $smarty->assign('categories', get_categories($db));
        $smarty->display('form_ad.tpl');
    }
    
    function get_ad($db, $id){
         return mysqli_query($db, "SELECT * FROM `ads` where id = ".intval($id));
    }
    
    function get_ads($db){
         return mysqli_query($db, "SELECT * FROM `ads`");
    }
     
    function get_cities($db){
        $cities_query = mysqli_query($db, 'SELECT * FROM `cities`');              //выбираем из базы данных города и записываем их в массив
        while ($row = mysqli_fetch_assoc($cities_query)) {
            $cities[$row['id']] = $row['city'];
        }
        return $cities;
    } 
    
    function get_categories($db){
        $categories_query = mysqli_query($db, 'SELECT * FROM `categories`');      //выбираем из базы данных категории и записываем их в массив
        while ($row = mysqli_fetch_assoc($categories_query)) {
            if (!$row['subcategory']){ $categories[$row['subcategory']] = $row['category']; }
            $categories[$row['subcategory']][$row['id']] = $row['category'];
        }
        return $categories;
    } 
    
    function add_ad($db, $ad){                                    // функция добавления объявления в БД
        if (!isset($ad['allow_mail'])){     $ad['allow_mail']=0;    }
        mysqli_query($db, "insert into `ads` (`private`, `seller_name`, `email`, `allow_mail`, `phone`, `city_id`, `category_id`, `title`, `description`, `price`)
                    values ('{$ad['private']}', '{$ad['seller_name']}', '{$ad['email']}', '{$ad['allow_mail']}', '{$ad['phone']}', '{$ad['city_id']}', '{$ad['category_id']}', '{$ad['title']}', '{$ad['description']}', '{$ad['price']}')");
    }
    
    function edit_ad($db, $ad){                                    // функция редактирования объявления
        if (!isset($ad['allow_mail'])){     $ad['allow_mail']=0;    }
        mysqli_query($db, "update `ads` set `private`='{$ad['private']}', `seller_name`='{$ad['seller_name']}', `email`='{$ad['email']}', "
        . "`allow_mail`='{$ad['allow_mail']}', `phone`='{$ad['phone']}', `city_id`='{$ad['city_id']}', `category_id`='{$ad['category_id']}', "
        . "`title`='{$ad['title']}', `description`='{$ad['description']}', `price`='{$ad['price']}' where id='{$ad['id_r']}'");
    }
    
    function restart(){                                         // функция перезапуска скрипта
        header("Location: $_SERVER[SCRIPT_NAME]");
        exit;
    }
    
    function error(){                                           // вывод ошибки
        echo "<h1 style='color:red' align='center'> НЕТ ТАКОГО ОБЪЯВЛЕНИЯ!<br> <a href='$_SERVER[SCRIPT_NAME]?back=''>НАЗАД</a>";
        exit();
    }
?>
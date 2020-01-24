<?php               // файл с функциями dz9
    
    function display_form($db, $smarty, $display_id = NULL){                // функция вывода формы
        if ($display_id) {
            $ad = get_ad($db, $display_id);
        }
        else{
            $ad = NULL;
        }
        $smarty->assign('display', $ad);
        $smarty->assign('ads', get_ads($db));
        $smarty->assign('cities', get_cities($db));
        $smarty->assign('categories', get_categories($db));
        $smarty->display('form_ad.tpl');
    }
    
    function get_ad($db, $id){                                              // возвращает объявление из базы по id
         return $db->selectRow('SELECT * FROM `ads` WHERE id=?d', $id);
    }
    
    function get_ads($db){                                                  // возвращает все объявления из базы
         return $db->select('SELECT * FROM `ads`');
    }
     
    function get_cities($db){
        $cities_query = $db->select('SELECT * FROM `cities`');              //выбираем из базы данных города и записываем их в массив
        foreach ($cities_query as $value) {
            $cities[$value['id']] = $value['city'];
        }
        return $cities;
    } 
    
    function get_categories($db){
        $categories_query = $db->select('SELECT * FROM `categories`');      //выбираем из базы данных категории и записываем их в массив
        foreach ($categories_query as $value) {
            if (!$value['subcategory']){ $categories[$value['subcategory']] = $value['category']; }
            $categories[$value['subcategory']][$value['id']] = $value['category'];
        }
        return $categories;
    } 
    
    function add_ad($db, $ad){                                      // функция добавления объявления в БД
        if (!isset($ad['allow_mail'])){     $ad['allow_mail']=0;    }
        $db->query("INSERT INTO ads(`private`, `seller_name`, `email`, `allow_mail`, `phone`, `city_id`, `category_id`, 
            `title`, `description`, `price`) VALUES('{$ad['private']}', '{$ad['seller_name']}', '{$ad['email']}', "
            . "'{$ad['allow_mail']}', '{$ad['phone']}', '{$ad['city_id']}', '{$ad['category_id']}', '{$ad['title']}', "
            . "'{$ad['description']}', '{$ad['price']}')");
    }
    
    function edit_ad($db, $ad){                                     // функция редактирования объявления
        if (!isset($ad['allow_mail'])){     $ad['allow_mail']=0;    }
        $db->query("update `ads` set `private`='{$ad['private']}', `seller_name`='{$ad['seller_name']}', `email`='{$ad['email']}', "
        . "`allow_mail`='{$ad['allow_mail']}', `phone`='{$ad['phone']}', `city_id`='{$ad['city_id']}', `category_id`='{$ad['category_id']}', "
        . "`title`='{$ad['title']}', `description`='{$ad['description']}', `price`='{$ad['price']}' where id='{$ad['id_r']}'");
    }
    
    function restart(){                                             // функция перезапуска скрипта
        header("Location: $_SERVER[SCRIPT_NAME]");
        exit;
    }
    
    function error(){                                               // вывод ошибки
        echo "<h1 style='color:red' align='center'> НЕТ ТАКОГО ОБЪЯВЛЕНИЯ!<br> <a href='$_SERVER[SCRIPT_NAME]?back=''>НАЗАД</a>";
        exit();
    }
?>
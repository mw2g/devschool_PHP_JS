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
        $cities_query = $db->select('SELECT id AS ARRAY_KEY,city FROM cities');
        foreach ($cities_query as $key=>$value) {                                   // приводим массив к соответствующему виду
            $cities[$key] = $value['city'];                                         // для селектора smarty
        }    
        return $cities;
    } 
    
    function get_categories($db){
        $categories_query = $db->select('SELECT id AS ARRAY_KEY, category, parent_id AS PARENT_KEY FROM categories');
        foreach ($categories_query as $key=>$value) {                                                   // приводим массив к соответствующему виду
            if (!$key){ $categories[$key] = $value['category']; }                                       // для селектора smarty
            foreach ($value['childNodes'] as $k=>$v) {
                $categories[$value['category']][$k] = $v['category'];
            }
        }
        return $categories;
    } 
    
    function add_ad($db, $ad, $colNames){                                       // функция добавления объявления в БД
        if (!isset($ad['allow_mail'])){     $ad['allow_mail']=0;    }           // если отсутствует $ad['allow_mail'] - добавляем нулевой
        foreach ($colNames as $value) {                                         // удаляем лишние элементы массива с добавляемым объявлением
            $add[$value] = $ad[$value];
        }
        $db->query('INSERT INTO ads(?#) VALUES(?a)', array_values($colNames), array_values($add));
    }
    
    function edit_ad($db, $ad, $colNames){                                      // функция редактирования объявления
        if (!isset($ad['allow_mail'])){     $ad['allow_mail']=0;    }
        foreach ($colNames as $value) {                                         // удаляем лишние элементы массива с добавляемым объявлением
            $add[$value] = $ad[$value];
        }
        $db->query("UPDATE ads SET?a where id='{$ad['id_r']}'",$add);
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
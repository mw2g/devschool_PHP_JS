<?php
    
    $project_root = __DIR__;
    $smarty_dir = $project_root.'/smarty/';
    
    // put full path to Smarty.class.php
    require_once ($smarty_dir.'libs/Smarty.class.php');
    $smarty = new Smarty();
    $smarty->compile_check = true;
    $smarty->debugging = FALSE;

    $smarty->template_dir = $smarty_dir.'templates/';
    $smarty->compile_dir = $smarty_dir.'templates_c/';
    $smarty->cache_dir = $smarty_dir.'cache/';
    $smarty->config_dir = $smarty_dir.'configs/';
  
    $colNames = array('private', 'seller_name', 'email', 'allow_mail', 'phone', 'city_id', 'category_id', 
            'title', 'description', 'price');
?>
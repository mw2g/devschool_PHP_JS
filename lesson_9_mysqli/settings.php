<?php

    $project_root = $_SERVER['DOCUMENT_ROOT'].'/dz9_mysqli';
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
    
?>
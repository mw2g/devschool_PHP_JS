<?php
    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors', 1);
    header("Content-Type: text/html; charset=utf-8");

    $smarty_root = __DIR__."/smarty/";
    $project_root=__DIR__;
    require $smarty_root.'libs/Smarty.class.php';
    require $project_root.'/functions.php';

    $smarty = new Smarty;
    $smarty->compile_check=true;
    $smarty->debugging=false;

    $smarty->template_dir=$smarty_root.'/templates/';
    $smarty->compile_dir=$smarty_root.'/templates_c/';

    $db = db::instance();
    // Устанавливаем обработчик ошибок.
    $db->setErrorHandler('databaseErrorHandler');
    $db->query("SET NAMES UTF8");
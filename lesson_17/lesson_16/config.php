<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");
$smarty_root=$_SERVER['DOCUMENT_ROOT']."/smarty/";
require $smarty_root.'libs/Smarty.class.php';
require './functions.php';

$smarty = new Smarty;
$smarty->compile_check = true;
$smarty->debugging = false; //отладочная консоль

$smarty->template_dir = './';
$smarty->compile_dir = $smarty_root.'templates_c/';

require_once $_SERVER['DOCUMENT_ROOT']."/dbsimple/config.php";
require_once "DbSimple/Generic.php";
require_once($_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php');
$db = DbSimple_Generic::connect('mysql://test:123@localhost/test');
// Устанавливаем обработчик ошибок.
$db->setErrorHandler('databaseErrorHandler');
$db->query("SET NAMES UTF8");


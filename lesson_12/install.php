<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Установка базы данных</title>
</head>

<body>
<form id="form1" name="form1" method="post" style="margin-left: 30%; margin-top: 1%;"> <font size="5">
  <p>
    <label for="textfield">Server name:<br>
    </label>
    <input name="server_name" type="text" id="server_name" value="localhost">
  </p>
  <p>
    <label for="textfield2">User name:<br>
    </label>
    <input name="user_name" type="text" id="user_name" value="test">
  </p>
  <p>
    <label for="textfield3">Password:<br>
    </label>
    <input name="password" type="text" id="password" value="123">
  </p>
  <p>
    <label for="textfield4">Database:<br>
    </label>
    <input name="database" type="text" id="database" value="test">
  </p>
  <p>
    <input type="submit" name="submit" id="submit" value="Install">
  </p>
</form>
</body>
</html>

<?php
    error_reporting(E_ALL);
//    header("Content-Type: text/html; charset=utf-8");
    
    if (isset($_POST['submit']) && $_POST['submit'] == 'Install'){
        
        $dump = "-- Adminer 4.2.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `test`;

DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('0','1') NOT NULL,
  `seller_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `allow_mail` enum('0','1') NOT NULL,
  `phone` int(11) unsigned NOT NULL,
  `city_id` int(4) unsigned NOT NULL,
  `category_id` int(4) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `color` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ads` (`id`, `type`, `seller_name`, `email`, `allow_mail`, `phone`, `city_id`, `category_id`, `title`, `description`, `price`, `color`) VALUES
(51,	'1',	'Арсений',	'aron@ya.ru',	'1',	4294967295,	4,	1002,	'Куплю ваше внимание',	'В любом состоянии.',	444,	'1'),
(52,	'0',	'Иван',	'гав',	'1',	4294967295,	4,	104,	'Просто объявление',	'Ничего не продаю.',	100,	NULL),
(53,	'1',	'Фёкла',	'fekla@mail.ru',	'0',	123123,	4,	605,	'Кладу кирпич',	'Красный, жёлтый, быстро.',	12500,	'0');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subcategory` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`id`, `subcategory`, `category`) VALUES
(1,	'0',	'-- Выберите категорию --'),
(2,	'Транспорт',	'Автомобили с пробегом'),
(3,	'Транспорт',	'Новые автомобили'),
(4,	'Транспорт',	'Мотоциклы и мототехника'),
(5,	'Транспорт',	'Грузовики и спецтехника'),
(6,	'Транспорт',	'Водный транспорт'),
(7,	'Транспорт',	'Запчасти и аксессуары'),
(8,	'Недвижимость',	'Квартиры'),
(9,	'Недвижимость',	'Комнаты'),
(10,	'Недвижимость',	'Дома, дачи, коттеджи'),
(11,	'Недвижимость',	'Земельные участки'),
(12,	'Недвижимость',	'Гаражи и машиноместа'),
(13,	'Недвижимость',	'Коммерческая недвижимость'),
(14,	'Недвижимость',	'Недвижимость за рубежом'),
(15,	'Работа',	'Вакансии'),
(16,	'Работа',	'Резюме'),
(17,	'Услуги',	'Предложения услуг'),
(18,	'Услуги',	'Запросы на услуги'),
(19,	'Личные вещи',	'Одежда, обувь, аксессуары'),
(20,	'Личные вещи',	'Детская одежда и обувь'),
(21,	'Личные вещи',	'Товары для детей и игрушки'),
(22,	'Личные вещи',	'Часы и украшения'),
(23,	'Личные вещи',	'Красота и здоровье'),
(24,	'Для дома и дачи',	'Бытовая техника'),
(25,	'Для дома и дачи',	'Мебель и интерьер'),
(26,	'Для дома и дачи',	'Посуда и товары для кухни'),
(27,	'Для дома и дачи',	'Продукты питания'),
(28,	'Для дома и дачи',	'Ремонт и строительство'),
(29,	'Для дома и дачи',	'Растения'),
(30,	'Бытовая электроника',	'Аудио и видео'),
(31,	'Бытовая электроника',	'Игры, приставки и программы'),
(32,	'Бытовая электроника',	'Настольные компьютеры'),
(33,	'Бытовая электроника',	'Ноутбуки'),
(34,	'Бытовая электроника',	'Оргтехника и расходники'),
(35,	'Бытовая электроника',	'Планшеты и электронные книги'),
(36,	'Бытовая электроника',	'Телефоны'),
(37,	'Бытовая электроника',	'Товары для компьютера'),
(38,	'Бытовая электроника',	'Фототехника'),
(39,	'Хобби и отдых',	'Билеты и путешествия'),
(40,	'Хобби и отдых',	'Велосипеды'),
(41,	'Хобби и отдых',	'Книги и журналы'),
(42,	'Хобби и отдых',	'Коллекционирование'),
(43,	'Хобби и отдых',	'Музыкальные инструменты'),
(44,	'Хобби и отдых',	'Охота и рыбалка'),
(45,	'Хобби и отдых',	'Спорт и отдых'),
(46,	'Хобби и отдых',	'Знакомства'),
(47,	'Животные',	'Собаки'),
(48,	'Животные',	'Кошки'),
(49,	'Животные',	'Птицы'),
(50,	'Животные',	'Аквариум'),
(51,	'Животные',	'Другие животные'),
(52,	'Животные',	'Товары для животных'),
(53,	'Для бизнеса',	'Готовый бизнес'),
(54,	'Для бизнеса',	'Оборудование для бизнеса');

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `cities` (`id`, `city`) VALUES
(1,	'Новосибирск'),
(2,	'Барабинск'),
(3,	'Бердск'),
(4,	'Искитим'),
(5,	'Колывань'),
(6,	'Краснообск'),
(7,	'Куйбышев'),
(8,	'Мошково'),
(9,	'Обь'),
(10,	'Ордынское'),
(11,	'Черепаново');

-- 2016-02-04 04:32:07
";
        $mysqli = new mysqli("{$_POST['server_name']}", "{$_POST['user_name']}", "{$_POST['password']}");
        if ($mysqli->connect_errno){ 
            die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error); 
        }
        
        if (mysqli_select_db($mysqli, $_POST['database'])){
            if($mysqli->multi_query("DROP DATABASE `{$_POST['database']}`")){
                echo 'База данных '.$_POST['database'].' удалена<br>';
            }
        }
        else{
            echo 'База данных '.$_POST['database'].' недоступна.<br>';
        }
        
        if($mysqli->multi_query($dump)){
            file_put_contents('connect.cfg', 'mysqli://'.$_POST['user_name'].':'.$_POST['password'].'@'.$_POST['server_name'].'/'.$_POST['database']);
            echo 'База данных '.$_POST['database'].' успешно добавлена <br> <a href="index.php">Перейти на сайт</a><br>';
        }
        else{
            echo 'Ошибка при добавлении базы данных '.$_POST['database'];
        }
        
    }
?>
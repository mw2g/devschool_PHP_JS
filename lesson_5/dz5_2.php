<?php
    header("Content-Type: text/html; charset=utf-8");
    
    //PUT

    if (isset($_POST['id'])){
    $id = (int) $_POST['id'];
    }

$news='Четыре новосибирские компании вошли в сотню лучших работодателей
Выставка университетов США: открой новые горизонты
Оценку «неудовлетворительно» по качеству получает каждая 5-я квартира в новостройке
Студент-изобретатель раскрыл запутанное преступление
Хоккей: «Сибирь» выстояла против «Ак Барса» в пятом матче плей-офф
Здоровое питание: вегетарианская кулинария
День святого Патрика: угощения, пивной теннис и уличные гуляния с огнем
«Красный факел» пустит публику на ночные экскурсии за кулисы и по закоулкам столетнего здания
Звезды телешоу «Голос» Наргиз Закирова и Гела Гуралиа споют в «Маяковском»';
$news =  explode("\n", $news);
print_r($news);

    echo '<h1 align="center">Новости</h1>';
    
    if (!isset($news[$id])) { 
        allnews($news);
    }
    else{
        choosenew($id);
    }
    
    function allnews($news){
        foreach ($news as $key => $value){
            echo '<h2 align="center"># '.$key.' '.$value.'</h2>';
        }
    }
    
    function choosenew($id){
        global $news;
        echo '<h2 align="center"># '.$id.' '.$news[$id].'</h2>';
    }
    
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>POST</title>
    </head>
    
    <body align="center">
        <form action="dz5_2.php" method="POST">
            <br><p><b><font color="red" size="5">Введите идентификатор новости:</b></p>
            <p><input type="text" name="id" value=""></p>
            <p><input type="submit"></p>
        </form>
    </body>
</html>
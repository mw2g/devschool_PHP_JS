<?php 

    header("Content-Type: text/html; charset=utf-8");

    $ini_string = '
[игрушка мягкая мишка белый]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';
    
[одежда детская куртка синяя синтепон]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';
    
[игрушка детская велосипед]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';';
   
    $bd =  parse_ini_string($ini_string, true);                                 //Записываем $ini_string в массив $bd
    print_r($bd);
    
    echo '<br><br><br><br>';
    echo '<h2 align="center"><ins><font color="red">Внимание! Акция! На товар - игрушка детская велосипед, при заказе от трёх штук, предоставляется уникальная скидка в 30%</font></ins></h2>';
    echo '<br><br>';
    echo '<table bgcolor="lightblue" rules="rows" frame="void" border = "1" align = "center" cellpadding="7" width="90%">';
    echo '<caption><h1>Моя корзина</h1></caption>';
    echo "<tr><th><h2 align=left>Наименование</th><th><h2 align=right>Цена</th><th><h2 align=right>Цена со скидкой</th><th><h2 align=right>Количество</th><th><h2 align=right>В наличии</th><th><h2 align=right>Недоступно</th><th><h2 align=right>Скидка</th><th><h2 align=right>Стоимость</th></tr>";
    
    foreach ($bd as $key => $val) {
    
        if (($val['количество заказано'] - $val['осталось на складе']) > 0) {   //Вычисляем количество недостающего товара и записываем
            $nehv = $val['количество заказано'] - $val['осталось на складе'];
        }
        else{
            $nehv = NULL;
        }
        
        if ($nehv > 0) {                                                                     //Если наблюдается нехватка товара, заполняем массив $info['нехватка'][] уведомлениями
            $info['нехватка'][] = '<p align="center"><font color="red" size=5>Товара <strong>'.$key.'</strong> не оказалось на складе в нужном количестве - '.$val['количество заказано'].'шт. Для заказа доступно '.$val['осталось на складе'].'шт.</p>';
        }
        
        $diskont = $val['diskont']();                                             //Присваеваем переменной $diskont размер скидки через переменную-функцию $val[diskont]
        akciya($key, $val['количество заказано']-$nehv);                       //Проверяем учавствует ли текущий товар в акции обращаясь к функции akciya(), если да то присваеваем внутри функции глобальной переменной $diskont предусмотренную скидку
        
        if ($diskont > 20) {                                                                     //Если наблюдается акция, заполняем массив $info['акция'][] уведомлениями
            $info['акция'][] = '<p align="center"><font color="green" size=5>Поздравляем! Вы получили скидку в '.$diskont.' процентов на товар <strong>'.$key.'</strong> и в сумме сэкономили '.(($val['количество заказано'] - $nehv)*$val['цена']*$diskont/100) .' руб.</p>';
        }
        
        echo '<tr><td><h3 align=left>'.$key.'</td><td><h3 align=right>'.$val['цена'].'</td><td><h3 align=right>'.$val['цена']*(100-$diskont)/100 .'</td><td><h3 align=right>'.$val['количество заказано'].'</td><td><h3 align=right>'.$val['осталось на складе'].'</td><td><h3 align=right>'.$nehv.'</td><td><h3 align=right>'.$diskont.'</td><td><h3 align=right>'.$val['цена']*(100-$diskont)/100 * ($val['количество заказано']-$nehv) .'</td></tr>';
        
        $vsego_cena += $val['цена'] * ($val['количество заказано'] - $nehv) * (100 - $diskont) / 100;   //Вычисляем общую сумму с учётом количества доступного товара и скидок по каждому виду
        $vsego_kol += $val['количество заказано'] - $nehv;                                              //Вычисляем количество заказанного товара с учётом доступного
    
    }
    
    echo '<tr><th><th><th><h2 align=right>ИТОГО</h2><th><th><th><th><th></tr>';
    echo "<tr><td><h3 align=left>Всего наименований: ".count($bd)."</td><td><h3 align=right>Общая сумма: ".$vsego_cena."</td><td><h3 align=right>Общее количество: ".$vsego_kol."</td><td></tr>";
    echo "</table>";

    function diskont0() { return NULL; }        
        
    function diskont1() { return 10;    }
    
    function diskont2() { return 20;    }
    
    function akciya($name, $shtuk){
        
        global $diskont;
        
        if (($shtuk) >= 3){
        
            switch ($name) {
                case "игрушка детская велосипед":

                    $diskont = 30;
            }
        }
    return;        
    }
    
    if ($info['нехватка']) { echo join('',$info['нехватка']); }
    if ($info['акция']) { echo join('',$info['акция']); }

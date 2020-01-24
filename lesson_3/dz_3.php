<?php
    header("Content-Type: text/html; charset=utf-8");
    //Создайте массив $date с пятью элементами
    $date = array();

    //C помощью генератора случайных чисел забейте массив $date юниксовыми метками

    $date[] = rand(1, time());
    $date[] = rand(1, time());
    $date[] = rand(1, time());
    $date[] = rand(1, time());
    $date[] = rand(1, time());

    
    //Сделайте вывод сообщения на экран о том, какой день в сгенерированном 
    //    массиве получился наименьшим, а какой месяц наибольшим
    
    echo 'В сгенерированном массиве: ';
    echo '<br>'.date('d.m.Y H:i:s',$date[0]);
    echo '<br>'.date('d.m.Y H:i:s',$date[1]);
    echo '<br>'.date('d.m.Y H:i:s',$date[2]);
    echo '<br>'.date('d.m.Y H:i:s',$date[3]);
    echo '<br>'.date('d.m.Y H:i:s',$date[4]);
    
    echo '<br>';
    echo 'день '.min(
                    date('d', $date[0]),
                    date('d', $date[1]),
                    date('d', $date[2]),
                    date('d', $date[3]),
                    date('d', $date[4])
                    ).' наименьший, а месяц '
                .max(
                    date('m', $date[0]),
                    date('m', $date[1]),
                    date('m', $date[2]),
                    date('m', $date[3]),
                    date('m', $date[4])
                    ).' наибольший.';
    
    //    Отсортируйте массив по возрастанию дат    
    sort($date);
    echo '<br>';
    print_r($date);
    
    //    С помощью функция для работы с массивами извлеките последний элемент массива в новую переменную $selected
    
    $selected = array_pop($date);
    echo '<br>'.$selected;
    
    //    C помощью функции date() выведите $selected на экран в формате "дд.мм.ГГ ЧЧ:ММ:СС"
    
    echo '<br>Часовой пояс по умолчанию: '.date_default_timezone_get();
    echo '<br>'.date('d.m.Y H:i:s', $selected);
    
    //    Выставьте часовой пояс для Нью-Йорка, и сделайте вывод снова, чтобы проверить, что часовой пояс был изменен успешно
    
    date_default_timezone_set('America/New_York');
    echo '<br>Установлен часовой пояс '.date_default_timezone_get();
    echo '<br>'.date('d.m.Y H:i:s', $selected);
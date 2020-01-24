{*вывод списка объявлений*}
<ul>
    {foreach from=$ads key=myId item=i name='ads'}      {* foreach($items as $myId => $i)*}
        <li><div align='left'>
            <a href='{$smarty.server.SCRIPT_NAME}?click_id={$myId}'> # {$i.title}  
            </a>
            | Цена: {$i.price} | Продавец: {$i.seller_name} | 
            <a href='{$smarty.server.SCRIPT_NAME}?del_ad={$myId}'>Удалить</a><br></li>
    {foreachelse} База объявлений пуста
    {/foreach}
</ul>

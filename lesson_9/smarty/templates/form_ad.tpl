
{include file="header.tpl"}

<h1 align="center"><strong>Доска объявлений</strong></h1>
<form style="margin-left: 30%;" method="post"> <font size="4">
    <div> 
        <label class="form-label-radio">
            <input type="radio" value=0 checked="" {if $display.private eq 0}checked{/if} name="private">Частное лицо
            <input type="radio" value=1 {if $display.private eq 1}checked{/if} name="private">Компания
        </label>
    </div>
    
    <div> 
        <label for="fld_seller_name">
            <b id="your-name">Ваше имя </b>
        </label>
        <input type="text" maxlength="40" value="{$display.seller_name}" name="seller_name" id="fld_seller_name">
    </div>
    <div>
        <label for="fld_email">Электронная почта</label>
        <input type="text" value="{$display.email}" name="email" id="fld_email">
    </div>
    <div>
        <label for="allow_mail"> <input type="checkbox" value=1 {if ($display.allow_mail eq 1)}checked{/if} name="allow_mail" id="allow_mail">
            <span>Я не хочу получать вопросы по объявлению по e-mail</span>
        </label>
    </div>
    <div>
        <label id="fld_phone_label" for="fld_phone">Номер телефона</label>
        <input type="text" value="{$display.phone}" name="phone" id="fld_phone">
    </div>
    <div class="form-group">
        <label for="region" class="col-sm-2 control-label">Город</label>
        {html_options name=city_id options=$cities selected=$display.city_id}
    </div>
    <div class="form-group">
        <label for="fld_category_id" class="form-label">Категория</label> 
        {html_options name=category_id options=$categories selected=$display.category_id}
    </div> 
    <div id="f_title">
        <label for="fld_title">Название объявления</label>
        <input type="text" maxlength="50" value="{$display.title}" name="title" id="fld_title">
    </div>
    <div>
        <label for="fld_description" id="js-description-label">Описание объявления</label>
        <br>
        <textarea name="description" cols="80" rows="5" maxlength="3000" id="fld_description">{$display.description}</textarea>
    </div>
    <div id="price_rw"> 
        <label id="price_lbl" for="fld_price">Цена</label> 
        <input type="text" maxlength="9" value="{$display.price}" name="price" id="fld_price">&nbsp;
        <span id="fld_price_title">руб.</span> 
    </div>
    
    <input type="submit" value="{if isset($smarty.get.click_id)}Сохранить{else}Добавить{/if}объявление" id="form_submit" name="confirm_add">
    <input type="submit" value="Очистить форму" id="form_submit" name="clear_form">
    <div>
        <input {if !isset($smarty.get.click_id)}hidden=""{/if} type="submit" value="Назад" id="enter_id" name="back">
        <input type="submit" value="Очистить базу объявлений" id="clear_base" name="clear_base">
    </div>
    <input type=hidden name=id_r value={if isset($smarty.get.click_id)}{$smarty.get.click_id}{/if}>
</form>
<hr>
    
    {if !isset($smarty.get.click_id)}                   {*если кликнули по объяве прячем список объяв*}
        {include file='list_ads.tpl'}
    {/if}


{include file='footer.tpl'}
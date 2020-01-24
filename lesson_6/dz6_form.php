<title>Купи слона</title>
<h1 align="center"><strong>Доска объявлений</strong></h1>
<form style="margin-left: 30%;" method="post"> <font size="4">
    <div> <label class="form-label-radio"><input type="radio" value="1" checked="" <?=$print_ad['privat'] == 1 ? 'checked' : '' ?> name="privat">Частное лицо</label> <label class="form-label-radio"><input type="radio" value="2" <?=$print_ad['privat'] == 2 ? 'checked' : '' ?> name="privat">Компания</label> </div>
    <div> <label for="fld_seller_name"><b id="your-name">Ваше имя </b></label><input type="text" maxlength="40" value="<?php echo $print_ad[seller_name] ?>" name="seller_name" id="fld_seller_name"></div>
    <div> <label for="fld_email">Электронная почта</label><input type="text" value="<?php echo $print_ad[email] ?>" name="email" id="fld_email"></div>
    <div> <label for="allow_mails"> <input type="checkbox" value="checked" <?php echo $print_ad[allow_mails] ?> name="allow_mails" id="allow_mails"><span>Я не хочу получать вопросы по объявлению по e-mail</span> </label> </div>
    <div> <label id="fld_phone_label" for="fld_phone">Номер телефона</label> <input type="text" value="<?php echo $print_ad[phone] ?>" name="phone" id="fld_phone"></div>
    <div class="form-group">
        <label for="region" class="col-sm-2 control-label">Город</label>
                <select title="Выберите Ваш город" name="location_id" id="region" class="form-control"> 
                    <option value="">-- Выберите город --</option>
                    <option disabled="disabled">-- Города --</option> 
    
                    <?php echo show_city_block($print_ad[location_id]); ?>
            
                </select> 
    </div>
    <div class="form-group">
        <label for="fld_category_id" class="form-label">Категория</label> 
            <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select">
                <option value="">-- Выберите категорию --</option>
        
                <?php echo show_category_block($print_ad[category_id]); ?>
        
            </select>
    </div> 
    <div id="f_title"> <label for="fld_title">Название объявления</label> <input type="text" maxlength="50" value="<?php echo $print_ad[title] ?>" name="title" id="fld_title"> </div>
    <div> <label for="fld_description" id="js-description-label">Описание объявления</label><br>
        <textarea name="description" cols="80" rows="5" maxlength="3000" id="fld_description"><?php echo $print_ad[description] ?></textarea></div>
    <div id="price_rw"> <label id="price_lbl" for="fld_price">Цена</label> <input type="text" maxlength="9" value="<?php echo $print_ad[price] ?>" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.</span> </div>
    
    <input type="submit" value="<?php echo $ad_edit ?> объявление" id="form_submit" name="confirm_add"> <input type="submit" value="Очистить форму" id="form_submit" name="clear_form">
    <div><input <?php echo $hide_back ?> type="submit" value="Назад" id="enter_id" name="back"> <input type="submit" value="Очистить базу объявлений" id="clear_SESSION" name="clear_base"></div>
    <input type=hidden name=id_r value=<?php echo $print_ad[id] ?>>
</form>
<hr>
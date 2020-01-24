<?php /* Smarty version 2.6.25-dev, created on 2016-01-27 06:59:01
         compiled from form_ad.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'form_ad.tpl', 34, false),)), $this); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1 align="center"><strong>Доска объявлений</strong></h1>
<form style="margin-left: 30%;" method="post"> <font size="4">
    <div> 
        <label class="form-label-radio">
            <input type="radio" value=0 checked="" <?php if ($this->_tpl_vars['display']['private'] == 0): ?>checked<?php endif; ?> name="private">Частное лицо
            <input type="radio" value=1 <?php if ($this->_tpl_vars['display']['private'] == 1): ?>checked<?php endif; ?> name="private">Компания
        </label>
    </div>
    
    <div> 
        <label for="fld_seller_name">
            <b id="your-name">Ваше имя </b>
        </label>
        <input type="text" maxlength="40" value="<?php echo $this->_tpl_vars['display']['seller_name']; ?>
" name="seller_name" id="fld_seller_name">
    </div>
    <div>
        <label for="fld_email">Электронная почта</label>
        <input type="text" value="<?php echo $this->_tpl_vars['display']['email']; ?>
" name="email" id="fld_email">
    </div>
    <div>
        <label for="allow_mail"> <input type="checkbox" value=1 <?php if (( $this->_tpl_vars['display']['allow_mail'] == 1 )): ?>checked<?php endif; ?> name="allow_mail" id="allow_mail">
            <span>Я не хочу получать вопросы по объявлению по e-mail</span>
        </label>
    </div>
    <div>
        <label id="fld_phone_label" for="fld_phone">Номер телефона</label>
        <input type="text" value="<?php echo $this->_tpl_vars['display']['phone']; ?>
" name="phone" id="fld_phone">
    </div>
    <div class="form-group">
        <label for="region" class="col-sm-2 control-label">Город</label>
        <?php echo smarty_function_html_options(array('name' => 'city_id','options' => $this->_tpl_vars['cities'],'selected' => $this->_tpl_vars['display']['city_id']), $this);?>

    </div>
    <div class="form-group">
        <label for="fld_category_id" class="form-label">Категория</label> 
        <?php echo smarty_function_html_options(array('name' => 'category_id','options' => $this->_tpl_vars['categories'],'selected' => $this->_tpl_vars['display']['category_id']), $this);?>

    </div> 
    <div id="f_title">
        <label for="fld_title">Название объявления</label>
        <input type="text" maxlength="50" value="<?php echo $this->_tpl_vars['display']['title']; ?>
" name="title" id="fld_title">
    </div>
    <div>
        <label for="fld_description" id="js-description-label">Описание объявления</label>
        <br>
        <textarea name="description" cols="80" rows="5" maxlength="3000" id="fld_description"><?php echo $this->_tpl_vars['display']['description']; ?>
</textarea>
    </div>
    <div id="price_rw"> 
        <label id="price_lbl" for="fld_price">Цена</label> 
        <input type="text" maxlength="9" value="<?php echo $this->_tpl_vars['display']['price']; ?>
" name="price" id="fld_price">&nbsp;
        <span id="fld_price_title">руб.</span> 
    </div>
    
    <input type="submit" value="<?php if (isset ( $_GET['click_id'] )): ?>Сохранить<?php else: ?>Добавить<?php endif; ?>объявление" id="form_submit" name="confirm_add">
    <input type="submit" value="Очистить форму" id="form_submit" name="clear_form">
    <div>
        <input <?php if (! isset ( $_GET['click_id'] )): ?>hidden=""<?php endif; ?> type="submit" value="Назад" id="enter_id" name="back">
        <input type="submit" value="Очистить базу объявлений" id="clear_base" name="clear_base">
    </div>
    <input type=hidden name=id_r value=<?php if (isset ( $_GET['click_id'] )): ?><?php echo $_GET['click_id']; ?>
<?php endif; ?>>
</form>
<hr>
    
    <?php if (! isset ( $_GET['click_id'] )): ?>                           <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'list_ads.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endif; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
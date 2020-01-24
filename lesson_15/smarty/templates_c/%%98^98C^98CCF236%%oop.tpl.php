<?php /* Smarty version 2.6.25-dev, created on 2016-02-12 04:17:54
         compiled from oop.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'oop.tpl', 61, false),)), $this); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Купи слона</title>

        <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    
    <!-- Bootstrap -->
   <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

  </head>
  <body style="width:600px;padding: 10px;margin-left: 30%;">
      
    <?php if (( ! empty ( $this->_tpl_vars['ad'] ) )): ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'table.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php endif; ?>

    <div id="container"> </div>
    
    <form class="form-horizontal" method="POST" role="form">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['display']->getId(); ?>
">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Имя</label>
    <div class="col-sm-10">
      <input type="text" name="seller_name" class="form-control" id="inputEmail" placeholder="Иван?" value="<?php echo $this->_tpl_vars['display']->getSeller_name(); ?>
">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Почта</label>
    <div class="col-sm-10">
      <input type="text" name="email" class="form-control" id="inputEmail3" placeholder="Которая через собаку"  value="<?php echo $this->_tpl_vars['display']->getEmail(); ?>
">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="allow_mail" <?php if (( $this->_tpl_vars['display']->getAllow_mail() == 1 )): ?>checked<?php endif; ?>> Скрыть электронную почту
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Телефон</label>
    <div class="col-sm-10">
      <input type="text" name="phone" class="form-control" id="inputEmail3" placeholder="Номерок черкни"  value="<?php echo $this->_tpl_vars['display']->getPhone(); ?>
">
    </div>
  </div>
  <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Город</label>
        <div class="col-sm-10">
            <?php echo smarty_function_html_options(array('class' => "form-control",'name' => 'city_id','options' => $this->_tpl_vars['cities'],'selected' => $this->_tpl_vars['display']->getCity_id()), $this);?>

        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Категория</label>
        <div class="col-sm-10">
        <?php echo smarty_function_html_options(array('class' => "form-control",'name' => 'category_id','options' => $this->_tpl_vars['categories'],'selected' => $this->_tpl_vars['display']->getCategory_id()), $this);?>

        </div> 
  </div> 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Название</label>
    <div class="col-sm-10">
      <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="Как назовём?" value="<?php echo $this->_tpl_vars['display']->getTitle(); ?>
">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Описание</label>
    <div class="col-sm-10">
     <textarea name="description" class="form-control" rows="3" placeholder="Не крашена не бита, синтетика залита!"><?php echo $this->_tpl_vars['display']->getDescription(); ?>
</textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Цена</label>
    <div class="col-sm-10">
      <input type="text" name="price" class="form-control" id="inputEmail3" placeholder="Чё так дорого?" value="<?php echo $this->_tpl_vars['display']->getPrice(); ?>
">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="radio">
  <label>
    <input type="radio" name="type" id="optionsRadios1" value="0" checked>
    Частное объявление
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="type" id="optionsRadios2" value="1" <?php if ($this->_tpl_vars['display']->getType() == 1): ?>checked<?php endif; ?>>
    Объявление Компании
  </label>
</div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="color" <?php if (( $this->_tpl_vars['display']->getType() == 1 )): ?>
                   <?php if (( $this->_tpl_vars['display']->getColor() == 1 )): ?>checked<?php endif; ?><?php endif; ?>>Выделить объявление цветом (только для компании)
                   
        </label>
      </div>
    </div>
  </div>
        
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-default"><?php if ($this->_tpl_vars['display']->getId()): ?>Сохранить<?php else: ?>Добавить<?php endif; ?> объявление</button>
      <button type="submit" name="clear_form" class="btn btn-default">Очистить форму</button>
      <button type="submit" name="clear_base" class="btn btn-default">Очистить базу</button>
    </div>
  </div>
</form>
    
    <script src="main.js"></script>
   
  </body>
</html>
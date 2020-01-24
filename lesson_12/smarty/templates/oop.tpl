<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Купи слона</title>

    <!-- Bootstrap -->
   <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

  </head>
  <body style="width:600px;padding: 30px;margin-left: 30%;">

    {if (!empty($ad))} {include file='table.tpl'} {/if}
    <br>
    
    <form class="form-horizontal" method="POST" role="form">
    <input type="hidden" name="id" value="{$display->getId()}">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Имя</label>
    <div class="col-sm-10">
      <input type="text" name="seller_name" class="form-control" id="inputEmail3" placeholder="Иван?" value="{$display->getSeller_name()}">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Почта</label>
    <div class="col-sm-10">
      <input type="text" name="email" class="form-control" id="inputEmail3" placeholder="Которая через собаку"  value="{$display->getEmail()}">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="allow_mail" {if ($display->getAllow_mail() eq 1)}checked{/if}> Скрыть электронную почту
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Телефон</label>
    <div class="col-sm-10">
      <input type="text" name="phone" class="form-control" id="inputEmail3" placeholder="Номерок черкни"  value="{$display->getPhone()}">
    </div>
  </div>
  <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Город</label>
        <div class="col-sm-10">
            {html_options class="form-control" name=city_id options=$cities selected=$display->getCity_id()}
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Категория</label>
        <div class="col-sm-10">
        {html_options class="form-control" name=category_id options=$categories selected=$display->getCategory_id()}
        </div> 
  </div> 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Название</label>
    <div class="col-sm-10">
      <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="Как назовём?" value="{$display->getTitle()}">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Описание</label>
    <div class="col-sm-10">
     <textarea name="description" class="form-control" rows="3" placeholder="Не крашена не бита, синтетика залита!">{$display->getDescription()}</textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Цена</label>
    <div class="col-sm-10">
      <input type="text" name="price" class="form-control" id="inputEmail3" placeholder="Чё так дорого?" value="{$display->getPrice()}">
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
    <input type="radio" name="type" id="optionsRadios2" value="1" {if $display->getType() eq 1}checked{/if}>
    Объявление Компании
  </label>
</div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="color" {if ($display->getType() eq 1)}
                   {if ($display->getColor() eq 1)}checked{/if}{/if}>Выделить объявление цветом (только для компании)
                   
        </label>
      </div>
    </div>
  </div>
        
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-default">{if $display->getId()}Сохранить{else}Добавить{/if} объявление</button>
      <button type="submit" name="clear_form" class="btn btn-default">Очистить форму</button>
      <button type="submit" name="clear_base" class="btn btn-default">Очистить базу</button>
    </div>
  </div>
</form>
    
   
  </body>
</html>
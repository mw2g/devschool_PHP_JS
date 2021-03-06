<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv='cache-control' content='no-cache'>
    <title>Купи слона</title>

        <!-- jQuery -->
    <script type="text/javascript" src="jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="jquery.form.min.js"></script>
    
    <!-- Bootstrap -->
   <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

  </head>
  <body style="width:600px;padding: 10px;margin-left: 30%;">
    
            
    <tableAds>  
    {include file='table.tpl'}
    </tableAds>  
      
      {*<div id="container" class="alert alert-warning alert-dismissible" style="display: none" role="alert">
          <button type="button" style="float: right;" onclick="$('#container').hide();return false;" class="btn btn-warning btn-sm">
              <span aria-hidden="true">&times;</span></button>
          <div align="center" id="container_info"></div>
      </div>*}
      
    <div id="messageRow" class="alert alert-success" style="display: none" role="alert">
          <div align="center" id="messageText"></div>
      </div>

    
    <form id="adForm" class="form-horizontal" method="POST" role="form">
    <input type="hidden" name="id" id="id">
  <div class="form-group">
    <label for="seller_name" class="col-sm-2 control-label">Имя</label>
    <div class="col-sm-10">
      <input type="text" name="seller_name" class="form-control" id="seller_name" placeholder="Иван?">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Почта</label>
    <div class="col-sm-10">
      <input type="text" name="email" class="form-control" id="email" placeholder="Которая через собаку">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="allow_mail" id="allow_mail"> Скрыть электронную почту
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="phone" class="col-sm-2 control-label">Телефон</label>
    <div class="col-sm-10">
      <input type="text" name="phone" class="form-control" id="phone" placeholder="Номерок черкни">
    </div>
  </div>
  <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Город</label>
        <div class="col-sm-10">
            {html_options class="form-control" name="city_id" id="city_id" options=$cities}
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Категория</label>
        <div class="col-sm-10">
        {html_options class="form-control" name="category_id" id="category_id" options=$categories}
        </div> 
  </div> 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Название</label>
    <div class="col-sm-10">
      <input type="text" name="title" class="form-control" id="title" placeholder="Как назовём?">
    </div>
  </div>
  <div class="form-group">
    <label for="description" class="col-sm-2 control-label">Описание</label>
    <div class="col-sm-10">
     <textarea name="description" id="description" class="form-control" rows="3" placeholder="Не крашена не бита, синтетика залита!"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="price" class="col-sm-2 control-label">Цена</label>
    <div class="col-sm-10">
      <input type="text" name="price" id="price" class="form-control" id="inputEmail3" placeholder="Чё так дорого?">
    </div>
  </div>
  <div id="typeForm" class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="radio">
  <label>
    <input type="radio" name="type" id="radioPrivate" value="0" checked>
    Частное объявление
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="type" id="radioCompany" value="1">
    Объявление Компании
  </label>
</div>
    </div>
  </div>
  <div id="colorForm" style="display: none" class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="color" id="color">Выделить объявление цветом
                   
        </label>
      </div>
    </div>
  </div>
        
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
{*        <input type="submit" value="Добавить объявление" name="submit" id="submit" class="btn btn-success">*}
    <input type="hidden" id="addEdit" value="add">
        <a class="submit btn btn-success">Добавить объявление</a>
      <a class="clear_form btn btn-warning">Очистить форму</a>
      <a class="clear_base btn btn-danger">Очистить базу</a>
    </div>
  </div>
</form>
    
    <script src="main.js"></script>
   
  </body>
</html>
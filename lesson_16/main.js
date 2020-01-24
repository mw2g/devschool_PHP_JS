$(document).ready(function(){
    
    if($('tbody tr').is('tr'))                      // если есть строки с объявлениями показываем таблицу
        {
            $("#tableAds").fadeIn('fast');
        };
    
    restart = function(){
        $('#adForm').trigger( 'reset' );                // очищаем форму
        $('a.submit').html('Добавить объявление');      // меням название кнопки submit
        $('#id').val(null);                             // сбрасываем id
        $('#addEdit').val('add');                             // сбрасываем addEdit - переключатель добавить/редактировать
        $('#colorForm').hide();                         // прячем опцию выделения цветом
    }
    
    $('a.submit').on('click',function(){                                                // сохранить/добавить объявление
                                var form = $('#adForm').serialize();
                                $.ajax({
                                    type: "POST",
                                    data: form,
                                    url: "ajax.php?action=submit&addEdit="+$('#addEdit').val(),
                                    dataType: "json",
                                    success: function(data)
                                    {
                                        if(data.action=='add'){                         // если объявление новое добавляем строку в список
                                            $("#tableAds").fadeIn('fast');
                                            $('table#ads').append("<tr hidden id='"+data.id+"'><td>"+data.id+"</td><td>"+data.title+"</td><td>"+data.description+"</td><td><a class='open btn btn-success'>Открыть</a></td><td><a class='delete btn btn-danger'>Удалить</a></td></tr>");
                                            if(data.color) $('table#ads tr:last').addClass('warning');
                                            $('table#ads tr:last').fadeIn('slow');
                                        } else if(data.action=='edit') {                // если объявление уже было в базе изменяем его в списке
                                            $('#'+data.id+' td:eq(0)').html(data.id);
                                            $('#'+data.id+' td:eq(1)').html(data.title);
                                            $('#'+data.id+' td:eq(2)').html(data.description);
                                            if(data.color){
                                                $('#'+data.id).addClass('warning');
                                            }else if(!data.color){
                                                $('#'+data.id).removeClass('warning');
                                            }
                                        };
                                        restart();
                                    }
                                });
                            });
    $('tbody').on('click','.open',function(){                                               // открыть объявление
                                var id = $(this).closest('tr').children('td:first').html();
                                var data = {"id":id};
                                $.ajax({
                                    type: "POST",
                                    data: data,
                                    url: "ajax.php?action=open",
                                    dataType: "json",
                                    success: function(data)
                                    {
                                        $("#id").val(data.id);
                                        $("#seller_name").val(data.seller_name);
                                        $("#email").val(data.email);
                                        if(data.allow_mail==1){
                                            $("#allow_mail").prop('checked', 'checked');
                                        }else {
                                            $("#allow_mail").prop('checked', false);
                                        }
                                        $("#phone").val(data.phone);
                                        $("#city_id [value='"+data.city_id+"']").prop("selected", "selected");
                                        $("#category_id [value='"+data.category_id+"']").prop("selected", "selected");
                                        $("#title").val(data.title);
                                        $("#description").val(data.description);
                                        $("#price").val(data.price);
                                        if(data.type==1){
                                            $('input[name=type][value=1]').prop('checked', 'checked');
                                            $('#colorForm').show();
                                        }else if(data.type==0) {
                                            $('input[name=type][value=0]').prop('checked', 'checked');
                                            $('#colorForm').hide();
                                        }
                                        if(data.color==1){
                                            $("#color").prop('checked', 'checked');
                                        }else {
                                            $("#color").prop('checked', false);
                                        }
                                        $('a.submit').html('Сохранить объявление');
                                        $('#addEdit').val('edit');
                                    }
                                })
                            });
                            
    $('a.clear_form').on('click',function(){
                                        restart();
                                });
                            
    $('#typeForm').on('click',function(){
                                        if($('#radioCompany').prop("checked")){
                                            $('#colorForm').show();
                                        }else if($('#radioPrivate').prop("checked")){
                                            $('#colorForm').hide();
                                        }
                                });
                            
    $('tbody').on('click','.delete',function(){                                             // удалить объявление
                                var id = $(this).closest('tr').children('td:first').html();
                                var tr = $('tr[id='+id+']');
                                var data = {"id":id};
                                $.getJSON('ajax.php?action=delete', data,
                                function(response)
                                {
                                    if($('tbody tr:first').is('tbody tr:last'))             // если строка единственная в списке
                                    {
                                        $("#tableAds").fadeOut();                  // скрываем всю таблицу с шапкой
                                    };
                                    tr.fadeOut('slow', function(){                          // скрываем строку удалённого объявления
                                        if(response.status=='success'){                     // выводим сообщение об успешности удаления
                                            $('#messageRow').removeClass('alert-danger').addClass('alert-success');
                                            $('#messageText').html(response.message);
                                            $('#messageRow').fadeIn('slow');
                                            setTimeout(function () {
                                            $('#messageRow').fadeOut('slow');
                                            }, 1500);
                                        }else if(response.status=='error'){
                                            $('#messageRow').removeClass('alert-success').addClass('alert-danger');
                                            $('#messageText').html(response.message);
                                            $('#messageRow').fadeIn('slow');
                                        };
                                        $(this).remove();                                   // удаляем строку объявления из HTML
                                        if(!$('tbody tr').is('tr')){
                                            setTimeout(function () {
                                                $('#messageText').html('Объявления в базе данных отсутствуют.');
                                                $('#messageRow').fadeIn('slow');                     // выводим сообщение об отсутствии объявлений
                                            }, 2000);
                                            setTimeout(function () {
                                                $('#messageRow').fadeOut('slow');
                                            }, 4500);
                                        }
                                    });
                                    restart();
                                });
                            }); 
                            
    $('a.clear_base').on('click',function(){                                                // очистить базу
                                    $.getJSON('ajax.php?action=clear_base',
                                    function(response)
                                    {
                                        $("#tableAds").fadeOut('slow', function(){          // скрываем всю таблицу с шапкой
                                            if(response.status=='success'){                     // выводим сообщение об успешности удаления
                                                $('#messageRow').removeClass('alert-danger').addClass('alert-success');
                                                $('#messageText').html(response.message);
                                                $('#messageRow').fadeIn('slow');
                                                setTimeout(function () {
                                                $('#messageRow').fadeOut('slow');
                                                }, 1500);
                                                $('tbody tr').remove();                             // удаляем все строки объявлений из HTML
                                            }else if(response.status=='error'){
                                                $('#messageRow').removeClass('alert-success').addClass('alert-danger');
                                                $('#messageText').html(response.message);
                                                $('#messageRow').fadeIn('slow');
                                                setTimeout(function () {
                                                $('#messageRow').fadeOut('slow');
                                                }, 3000);
                                            }
                                        });
                                        restart();
                                    });
                                });
});
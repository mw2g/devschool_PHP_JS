$(document).ready(function(){
    
    if($('tbody tr').is('tr'))                      // если есть строки с объявлениями показываем таблицу
        {
            $("#tableAds").fadeIn('fast');
        };
    
    function restart(){
        $('#adForm').trigger( 'reset' );                // очищаем форму
        $('#submit').html('Добавить объявление');      // меням название кнопки submit
        $('#id').val(null);                             // сбрасываем id
        $('#addEdit').val('add');                             // сбрасываем addEdit - переключатель добавить/редактировать
        $('#colorForm').hide();                         // прячем опцию выделения цветом
    }
   
    function showResponse(data)
        {
            if(data.action=='add'){                         // если объявление новое добавляем строку в список
                $("#tableAds").fadeIn('slow');
                $('table#ads').append(data.tovar);
                if(data.color) $('table#ads tr:last').addClass('warning');
                $('table#ads tr:last').fadeIn('slow');
                $().toastmessage('showSuccessToast', data.message);
            } else if(data.action=='edit') {                // если объявление уже было в базе изменяем его в списке
                $('#'+data.id+' td:eq(0)').html(data.id);
                $('#'+data.id+' td:eq(1)').html(data.title);
                $('#'+data.id+' td:eq(2)').html(data.description);
                if(data.color){
                    $('#'+data.id).addClass('warning');
                }else if(!data.color){
                    $('#'+data.id).removeClass('warning');
                }
                $().toastmessage('showSuccessToast', data.message);
            };
            
            restart();
        }
    
     var options = { 
        success:       showResponse,  // post-submit callback 
        url:       "ajax.php?action=submit",         // override for form's 'action' attribute 
        dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type) 
    }; 
 
    $('#adForm').ajaxForm(options); 
    
    $('tbody').on('click','.open',function(){                                               // открыть объявление
                                var id = $(this).closest('tr').prop('id');
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
                                        $('#submit').html('Сохранить объявление');
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
                                var id = $(this).closest('tr').prop('id');
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
                                            $().toastmessage('showNoticeToast', response.message);
                                        }else if(response.status=='error'){
                                            $().toastmessage('showErrorToast', response.message);
                                        };
                                        $(this).remove();                                   // удаляем строку объявления из HTML
                                        if(!$('tbody tr').is('tr')){
                                            $().toastmessage('showNoticeToast', 'Объявления в базе данных отсутствуют.');
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
                                                $().toastmessage('showNoticeToast', response.message);
                                                $('tbody tr').remove();                             // удаляем все строки объявлений из HTML
                                            }else if(response.status=='error'){
                                                $().toastmessage('showErrorToast', response.message);
                                            }
                                        });
                                        restart();
                                    });
                                });
});
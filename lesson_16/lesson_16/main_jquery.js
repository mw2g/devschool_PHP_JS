//$('#container').load('example_ajax.php?id=12&name=petya');

// load(url,parameters,callback)


$(document).ready(function(){
    
    $('a.delete').on('click',function(){
        var id=$(this).closest('tr').children('td:first').html();
        var tr=$(this).closest('tr');
//        $('#container').load('example_ajax.php?action=delete&id='+id, 
//        function() {
//            tr.fadeOut('slow',function(){
//                $(this).remove();
//            });
//        }
//        );
    
        var test = {"id":id}; //JSON
    
//        $.get('example_ajax.php?action=delete', 
//        test,
//        function(response) {
//            console.log(response);
//            tr.fadeOut('slow',function(){
//                $(this).remove();
//            });
//        });
        
        $.getJSON('example_ajax.php?action=delete', 
        test,
        function(response) {
            tr.fadeOut('slow',function(){
                if(response.status=='success'){
                    $('#container').removeClass('alert-danger').addClass('alert-warning');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn('slow');
                }else if(response.status=='error'){
                    $('#container').removeClass('alert-warning').addClass('alert-danger');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn('slow');
                }
                $(this).remove();
            });
        });
        
//        $.post('example_ajax.php?action=delete', 
//        test,
//        function(response) {
//            tr.fadeOut('slow',function(){
//                if(response.status=='success'){
//                    $('#container').removeClass('alert-danger').addClass('alert-warning');
//                    $('#container_info').html(response.message);
//                    $('#container').fadeIn('slow');
//                }else if(response.status=='error'){
//                    $('#container').removeClass('alert-warning').addClass('alert-danger');
//                    $('#container_info').html(response.message);
//                    $('#container').fadeIn('slow');
//                }
//                $(this).remove();
//            });
//        },
//        'json');

            $.ajaxSetup({
                type: 'POST',
                timeout: 5000,
                dataType: 'json'
            });
//$.bind();
//ajaxStart, ajaxSend, ajaxSuccess, ajaxStop
           
        $(document).bind('ajaxStart ajaxStop ajaxSend ajaxSuccess ajaxError ajaxComplete',
        function(event){
            console.log(event);
        });
           
        $.ajax({
            url: 'example_ajax.php?action=delete',
            global: true,
            data: test,
            success: function(response){
                console.log('success',response);
            },
            error: function(response){
                console.log('error',response);
            },
            complete: function(response){
                console.log('complete',response);
            },
        });
        
    
    });

});


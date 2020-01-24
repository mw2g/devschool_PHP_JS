$(document).ready(function(){
    
    function showResponse(response){
        $('#ads>tbody').append(response.tovar);
        
         if(response.status=='success'){
                    $('#container').removeClass('alert-danger').addClass('alert-warning');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn('slow');
                }else if(response.status=='error'){
                    $('#container').removeClass('alert-warning').addClass('alert-danger');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn('slow');
                }
    }
    
     var options = { 
        target:        '#container_info',   // target element(s) to be updated with server response 
        //beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse,  // post-submit callback 
 
        // other available options: 
        url:       'example_ajax.php?action=insert',         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
        dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type) 
        clearForm: true,     // clear all form fields after successful submit 
        resetForm: true      // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 
 
    // bind form using 'ajaxForm' 
    $('#ajax-form').ajaxForm(options); 
    
    $(document).on('click','a.delete',function(){
        var id=$(this).closest('tr').children('td:first').html();
        var tr=$(this).closest('tr');
        var test = {"id":id}; //JSON
        
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
    
    });

});


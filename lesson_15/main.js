$(document).ready(function(){
    
    $('a.delete').on('click',function(){
                                var id = $(this).closest('tr').children('td:first').html();
                                $('#container').load('ajax.php?action=delete&del_ad='+id);
      
                            });
    
});
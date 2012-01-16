$(function(){
    $('.details').on('click',function(e){
        e.preventDefault();
        var target = $(this);
        var project_id = target.find('input[name="project_id"]').val();
        var title = target.parents('tr').find('td:eq(2)').text();
        $.ajax({
            url: base_url+"project/details",
            data:{
                id:project_id,
                xsrf:xsrf
            },
            type:'POST',
            success: function(data){
                $('#dialog').html(data).dialog({
                    minWidth:860,
                    maxWidth:860,
                    draggable:false,
                    modal:true,
                    title:title,
                    resizable:false,
                    show: "blind",
                    hide: "blind",
                    closeText:closeText,
                    close:function(){
                        $(this).html("");
                    }
                });
                
            }
        });
       
    });
    $('.more').live('click',function(){
        var target = $(this);
         target.prev('span.full').slideToggle('slow',function(){
             $(this).prev('span.short').toggle();
         }); 
        
       
        target.toggleText(more,less);
    });
});
$(function(){
    $('.details span').on('click',function(e){
        e.preventDefault();
        var target = $(this);
        var project_id = target.find('input[name="project_id"]').val();
        var title = target.parents('tr').find('td:eq(1)').text();
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
                    minHeight:500,
                    draggable:false,
                    modal:true,
                    title:title,
                    resizable:false,
                    show: "blind",
                    hide: "blind",
                    closeText:closeText
            
                });
            }
        });
       
    });
});
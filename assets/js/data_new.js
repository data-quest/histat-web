$(function(){
    $('.details').live('click',function(e){
        e.preventDefault();
        var target = $(this);
        var tt = target.find('.tooltip');
        $('.tooltip').fadeOut('slow');
        tt.fadeIn('slow');
        tt.find('.project_details').on('click',function(){
            showProject(target);
        });
        tt.find('.timeline').on('click',function(){
            showTimeline(target);
        });
    });
  
    var showTimeline = function(target){
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
                $('#dialog').html("timline!!").dialog({
                    minWidth:914,
                    maxWidth:914,
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
    }
    var showProject = function(target){
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
                    minWidth:914,
                    maxWidth:914,
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
    }
    $('.more').live('click',function(){
        var target = $(this);
        var full =target.prev('span.full');
        var short_text = full.prev('span.short');
   
        short_text.toggle(); 
        full.slideToggle('slow',function(){
            target.text(less).attr('class','less');
        });  
    });
    $('.less').live('click',function(){
        var target = $(this);
        var full =target.prev('span.full');
        var short_text = full.prev('span.short');
        full.slideToggle('slow',function(){
            short_text.toggle(); 
            target.text(more).attr('class','more');
        }); 
      
    });
});
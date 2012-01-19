$(function(){
    var target = null;
    $('td.details').live('click',function(){
        target = $(this);
      
        $('.tooltip').hide();
        target.find('.tooltip').fadeIn('slow');

    });
    $('a.timeline').live('click',function(){
        var project_id = target.find('input[name="project_id"]').val();
        var title = target.parents('tr').find('td:eq(2)').text();
        $('.tooltip').hide();
        $.ajax({
            url: base_url+"project/timeline",
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
                    buttons: [{
                        text:resetText,
                        click: function() {
                            $( this ).dialog( "close" );
                        }
                    },{
                        text:showText,
                        click: function() {
                            $( this ).dialog( "close" );
                        }
                    }],
                    close:function(){
                        $(this).html("");
                    }
                });
                
            }
        });
    });
    $('a.project_details').live('click',function(){
        var project_id = target.find('input[name="project_id"]').val();
        var title = target.parents('tr').find('td:eq(2)').text();
        $('.tooltip').hide();
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
                    buttons:[],
                    closeText:closeText,
                    close:function(){
                        $(this).html("");
                    }
                });
                
            }
        });
    });
  
    $('.more').live('click',function(e){
        var target = $(this);
        var full =target.prev('span.full');
        var short_text = full.prev('span.short');
        short_text.toggle(); 
        full.slideToggle('slow',function(){
            target.text(less).attr('class','less');
        });  
    });
    $('.less').live('click',function(e){
        var target = $(this);
        var full =target.prev('span.full');
        var short_text = full.prev('span.short');
        full.slideToggle('slow',function(){
            short_text.toggle(); 
            target.text(more).attr('class','more');
        }); 
      
    });
});
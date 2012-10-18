$(function(){
   

    $('#layout').width("98%");
    $('#gotop').remove();
    var name = $('.name');
    var scrollX = $('.scrollX');
    var scrollY = $('.scrollY');
    var thead = $('#thead');
    var tdata = $('#tdata');
    var scrollBar = scrollbar();

    
  
    if( tdata.width() < scrollY.width()){
        scrollBar.w = 0;
    }

    scrollY.height($(window).height()-name.height()-thead.height()-50).width(thead.width()+1+scrollBar.w);
    tdata.find('tr').eq(0).find('td').each(function(i){
        $(this).width(thead.find('td').eq(i).width()); 
    });
   
  $('#table_details .tooltip').live('click',function(e){
      
      $(this).hide();
      e.preventDefault();
      return false;
  
    });
    $('#thead td').live('click',function(e){
        $('#thead td .tooltip').hide();
     $(this).find('.tooltip').show();
 
    });
  
    $('#tdata td').live('click',function(e){
        $('#tdata td .tooltip').hide();
         $(this).find('.tooltip').show();
      
    });
    
    $('#chart').live('click',function(e){
        var id = $(this).find('input[name="chart"]').val();
        var title = $(this).find('input[name="title"]').val();
        var tt = $('.dialog');
     
        tt.html('<img src="'+base_url+'chart/draw/'+id+'" /></div>').dialog({
            minWidth:800,
            maxWidth:800,
            draggable:false,  
            modal:true,
            title:title,
            resizable:false,
            show: "blind",
            hide: "blind",
            buttons:[],
            position:["center",100],
            closeText:closeText,
            open:function(){
                 $('.ui-dialog-titlebar').addClass('titlebar').show();
                var span = $('.ui-dialog-titlebar-close > span');
              
                
                  
                     var h = $('span.ui-dialog-title').height();
                span.attr('style','height:'+h+'px;line-height:'+h+'px');
            },
            close:function(){
                $(this).html('');
                $('.ui-dialog-title').html('');
                $('.ui-dialog-titlebar-close > span').height(30);
            }
        }).dialog("Open");
      
       
    });
    $('#table_details select').change(function(){
      
        $('.details form').submit();
    });
    $('#cart').live('click',function(){
        var filter_text = [];
        $('input[name="filter_text[]"]').each(function(){
            filter_text.push($(this).val())
        });
        
        var filter = $('input[name="filter_string"]').val();
        var id = $('input[name="id"]').val();
        var timelines = $('#tabelle > div > b').text();
        $.ajax({
            url: base_url+'cart/add',
            data:{
                filter:filter,
                timelines:timelines,
                id:id,
                filter_text:filter_text,
                xsfr:xsrf
            },
            type:'POST',
            success: function(data) {
                data = Boolean(data);
                if(data){
                    var items = parseInt($('#cart_items').text());
                    $('#cart_items').text(items+1);
                }
             
            }
        });
    });
    $('#download select').change(function(){
        if($(this).val() === '-1'){
            $('#download input[name="custom"]').slideDown(500);
        }else{
            $('#download input[name="custom"]').slideUp(500).val("");
        }
     
    });

    $('#tdata td').hover(function(){
        if($(this).find('input[name="new_data"]').is(':hidden')){
            $(this).find('.edit').show();
        }
        
    },function(){
        $(this).find('.edit').hide();
    })
    $('#tdata td .edit').live('click',function(){
        var parent = $(this).parent('td');
        $(this).hide();
        parent.find('.text').hide();
        parent.find('input[name="new_data"]').show().focus();
    });
    $('#tdata input[name="new_data"]').focusout(function(){
        var t = $(this),year,id_hs,key,value,id_projekt;
        var parent = t.parent('td');
        key = parent.find('input[name="hidden_key"]').val();
        id_hs = parent.find('input[name="hidden_id_hs"]').val();
        year = parent.find('input[name="hidden_year"]').val();
        value = t.val();
        id_projekt = parent.find('input[name="hidden_id_projekt"]').val();
        $.ajax({
            url: base_url+'table/edit',
            data:{
                xsfr:xsrf,
                year:year,
                id_hs:id_hs,
                key:key,
                id_projekt:id_projekt,
                value:value
            },
            type:'POST',
            dataType:'json',
            success: function(data) {
            
              
                if(data.result){
                    t.hide();
                    var val = ' ';
                    if(t.val().length > 0)
                        val = t.val();
                    
                    t.parent('td').find('.text').text(val).show();
                }else{
                      t.hide();
                    t.parent('td').find('.text').show(); 
                    
                }
             
            }
        });
       
    })
    $('#thead td.grey').hover(function(){
        if($(this).find('textarea[name="new_data"]').is(':hidden')){
            $(this).find('.edit').show();
        }
        
    },function(){
        $(this).find('.edit').hide();
    })
    $('#thead td.grey .edit').live('click',function(){
        var parent = $(this).parent('td');
        $(this).hide();
        parent.find('.text').hide();
        parent.find('textarea[name="new_data"]').show().focus();
    });
    $('#thead textarea[name="new_data"]').focusout(function(){
       
        var t = $(this),type,id_hs,key,value,id_projekt;
        var parent = t.parent('td');
        key = parent.find('input[name="hidden_key"]').val();
        id_hs = parent.find('input[name="hidden_id_hs"]').val();
        type = parent.find('input[name="hidden_type"]').val();
        value = t.val();
        id_projekt = parent.find('input[name="hidden_id_projekt"]').val();
        $.ajax({
            url: base_url+'table/edit_header',
            data:{
                xsfr:xsrf,
                type:type,
                id_hs:id_hs,
                key:key,
                id_projekt:id_projekt,
                value:value
            },
            type:'POST',
            dataType:'json',
            success: function(data) {
            
              
                if(data.result){
                    t.hide();
                    var val = ' ';
                    if(t.val().length > 0)
                        val = t.val();
                    
                    t.parent('td').find('.text').text(val).show();
                }else{
                      t.hide();
                    t.parent('td').find('.text').show(); 
                    
                }
             
            }
        });
       
    })
});
function scrollbar() {
    var div = $('<div style="width:50px;height:50px;overflow:hidden;position:absolute;top:0xp;left:0xp;"><div style="height:100px"></div></div>');
    // Append our div, do our calculation and then remove it
    $('body').append(div);
    var w1 = $('div', div).innerWidth();
    div.css('overflow-y', 'scroll');
    var w2 = $('div', div).innerWidth();
    
    $(div).remove();
    
    return {
        w:(w1 - w2)
    } 
}

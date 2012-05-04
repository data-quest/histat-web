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
                var span = $('.ui-dialog-titlebar-close > span');
                var h = $('span.ui-dialog-title').innerHeight();
         
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
    $('#download form').submit(function(){
        $('#download').fadeOut(500, function(){
            
        });
    });
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

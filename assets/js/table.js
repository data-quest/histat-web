$(function(){
    var y =  $('#scrollX');
    var w = $('#scrollX table#headline').innerWidth();
    var h =  $('#scrollY').position();
    h = $(document).innerHeight()-h.top-$('#footer').innerHeight()-$('#header').innerHeight();
    
    $('#scrollY').width(w +scrollbarWidth()+1).height(h);

    var x = $('td.blue').eq(1).width();
    $('#headline td').live('click',function(e){
        $('.tooltip').hide();
        $(this).find('.tooltip').show();
    });
    $('#gotop').remove();
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
            top:100+'px',
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
    $('select').change(function(){
        $('form').submit();
       
    });
});
function scrollbarWidth() {
    var div = $('<div style="width:50px;height:50px;overflow:hidden;position:absolute;top:-200px;left:-200px;"><div style="height:100px;"></div>');
    // Append our div, do our calculation and then remove it
    $('body').append(div);
    var w1 = $('div', div).innerWidth();
    div.css('overflow-y', 'scroll');
    var w2 = $('div', div).innerWidth();
    $(div).remove();
    return (w1 - w2);
}

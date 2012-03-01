$(function(){
    var y =  $('#scrollX');
    var w = $('#scrollX > table').innerWidth();
    var h =  $('#scrollY').position();
    h = $(document).innerHeight()-h.top-$('#footer').innerHeight()-$('#header').innerHeight();
    
    $('#scrollY').width(w +scrollbarWidth()+1).height(h);

    var x = $('td.blue').eq(1).width();
    $('#headline td').live('click',function(e){
        $('.tooltip').hide();
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
            closeText:closeText,
            close:function(){
                $(this).html('');
            }
        }).dialog("Open");
      
       
    });
    $('select').change(function(){
        $('#scrollX td').show();
        var index = new Array();
        var filter = $(this).val();
        $(this).parents('tr').find('.text').each(function(i){
            if(i > 0 && filter !=$.trim($(this).text()))
                index.push(i);
        });
        $('#scrollX table tr').each(function(){
            for(var i in index){
                $(this).find('td').eq(index[i]).hide();
            }
        });
        if($(':selected',this).index()== 0) $('#scrollX td').show();
       
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

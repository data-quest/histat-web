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
        $('#chart .tooltip').html('<span></span>').hide();
        var id = $(this).find('input[name="chart"]').val();
        var tt = $(this).find('.tooltip');
        tt.html('<span></span><div class="loading"></div>');
        tt.show();
        $.ajax({
           url:base_url+'chart',
           data:{xsrf:xsrf,id:id},
           type:"POST",
           success:function(data){
               tt.html('<span></span><img src="'+base_url+data+'" />');
           },
           error:function(data){
               
               alert("Grafik konnte nicht erzeugt werden, versuchen Sie es später noch ein Mal.");
               tt.html('<span></span>').hide();
           }
        });
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

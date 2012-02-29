$(function(){
    var y =  $('#scrollX');
    var w = $('#scrollX > table').innerWidth();
    var h =  $('#scrollY').position();
    h = $(document).innerHeight()-h.top-$('#footer').innerHeight()-$('#header').innerHeight();
    
    $('#scrollY').width(w +scrollbarWidth()+1).height(h);

    var x = $('td.blue').eq(1).width();
    
   
  
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

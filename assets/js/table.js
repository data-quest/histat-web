$(function(){
    var y =  $('#scrollX');
    var w = $('#scrollX > table').innerWidth();
    var h =  $('#scrollY').position();
    h = $(document).innerHeight()-h.top-$('#footer').innerHeight()-$('#header').innerHeight();
    console.log(h);
    $('#scrollY').width(w).height(h);

    $('div.details table td').hover(function(){
        var c = $(this).attr('class');
        if(c != undefined){
            $('.'+c).addClass('hover');
        }
    }, function(){
       $('div.details table td').removeClass('hover');
    });
});

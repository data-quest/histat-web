$(function(){
    $('.key div.author').on('click',function(){
        var target = $(this);
        var name = target.find('input[name="author"]').val();
        $('.key div.project:visible').slideUp('slow',function(){$(this).html("");});
        $.ajax({
            url: base_url+"project/list",
            data:{
                id:name,
                xsrf:xsrf
            },
            type:'POST',
            success: function(data){
                target.next('div.project').html(data).slideDown('slow');
            }
        });
     
    });
})
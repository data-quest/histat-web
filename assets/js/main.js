$(function(){

 
    $('.more').live('click',function(e){
        var target = $(this);
        var text =target.prev('div.text');
        text.css('height', 'auto').css('overflow', 'visible');
        target.text(less).attr('class','less');
    });
    $('.less').live('click',function(e){
        var target = $(this);
        var text =target.prev('div.text');
      
        text.css('height', '70px').css('overflow', 'hidden');
        target.text(more).attr('class','more');
    });
    
    
});
$(function(){
    var target = null;
    $('td.details').live('click',function(){
        target = $(this);
      
        $('.tooltip').hide();
        target.find('.tooltip').fadeIn('slow');

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
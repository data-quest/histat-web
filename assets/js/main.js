$(function(){

    /*
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
    */
  // _etc(); //etracker
    $('#cart .more').live('click',function(e){
        $(this).removeClass('more').addClass('less').parent('li').next('li').slideToggle('slow');
    });
    $('#cart .less').live('click',function(e){
        $(this).removeClass('less').addClass('more').parent('li').next('li').slideToggle('slow');
    });
    var id = 0;
    function search(elem,id){
        var data = $('#search_form').serialize(),tables,details;
        data += '&id='+id;
     
        $.ajax({
           url:base_url+'search/detailed',
           type:'POST',
           data:data,
           dataType:'json',
           success:function(data){
               elem.removeClass('empty');
               tables = elem.find('td.tables');
               details = elem.find('td.details');
               if(data.tables){
                  var t,filter = '';
                  for(var i in data.tables){
                    t =  data.tables[i];
                    if(t.filter) filter = '/'+t.filter;
                    tables.append('<div>'+t.name+'<div class="link"><a href="'+base_url+'table/details/'+i+filter+'">'+t.keys.length+' Zeitreihen</a></div><div style="clear:both;padding:0"></div></div>');
                  }  
               }
   
              
           }
        });
    }
    $('#search_result .even.found.show').live('click',function(){
          $(this).hide().next('td.found.hide').show();
           id = $(this).find('input[name="id"]').val();
           $('tr#'+id).fadeIn('slow',function(){
              if($(this).hasClass('empty')){
                  search($(this),id);
              }
           });
    });
    $('#search_result .even.found.hide').live('click',function(){
          $(this).hide().prev('td.found.show').show();
          id = $(this).find('input[name="id"]').val();
          $('tr#'+id).fadeOut('slow');
    });
});
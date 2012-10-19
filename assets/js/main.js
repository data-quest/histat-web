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

    $('#cart .result input[name="selected[]"]').change(function(){
        var val = $(this).val();
        var form = $('form.selected');
        var id =$(this).prop('position');
        var elem = form.find('.class_'+id);
        if( $(this).attr('checked') == 'checked'){
           
            if(elem.length == 0){
                form.prepend('<input type="hidden" name="selected[]" class="class_'+id+'" value="'+val+'" />');
            }
        }else{
      
            if(elem.length > 0){
                elem.remove();
              
            }
        }
        
    });
    
    $('#cart form#download .download .button').on('click',function(){
        if($('input:checked').length > 0){
            
       
        $(this).parents('form').find('input[name="format"]').val($(this).attr('id'));
        $('.overlay').fadeIn('slow');
        $('.dialog').fadeIn('slow');
         }else{
             alert("Keine Tabellen wurden zum Download ausgewählt")
         }
    });
    $('#download').submit(function(){
        $('.overlay').fadeOut('slow');
        $('.dialog').fadeOut('slow');
    });
    $('#download select').change(function(){
        if($(this).val() === '-1'){
            $('#download input[name="custom"]').slideDown(500);
        }else{
            $('#download input[name="custom"]').slideUp(500).val("");
        }
     
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
                if(data != null){
                    var e= $('tr.'+id)
                    e.removeClass('empty');
                
                    tables = e.find('td.tables');
                    details = e.find('td.values');
                    var p;
                    if(data.tables){
                        var t,filter = '';
                        for(var i in data.tables){
                            t =  data.tables[i];
                            filter = '';
                       
                            if(t.filter) filter = '/'+t.filter;
                            tables.append('<div><div class="name">'+t.name+'</div><div class="link"><a href="'+base_url+'table/details/'+i+filter+'">'+t.keys.length+' Zeitreihe'+((t.keys.length > 1)?'n':'')+'</a></div><div style="clear:both;padding:0"></div></div>');
                            
                        }  
                    }
                    if(data.Zitierpflicht){
                        p = details.find('.data').show().find('p');
                        for(var i in data.Zitierpflicht){
                            p.append(data.Zitierpflicht[i]);
                        }
                  
                    }
                    if(data.Quellen){
                        p = details.find('.sources').show().find('p');
                        for(var i in data.Quellen){
                            p.append(data.Quellen[i]);
                        }
                  
                    }
                    if(data.Untergliederung){
                        p = details.find('.reintegration').show().find('p');
                        for(var i in data.Untergliederung){
                            p.append(data.Untergliederung[i]);
                        }
                  
                    }
                    if(data.Veroeffentlichung){
                        p = details.find('.publication').show().find('p');
                        for(var i in data.Veroeffentlichung){
                            p.append(data.Veroeffentlichung[i]);
                        }
                  
                    }
                    if(data.Projektname){
                        p = details.find('.data').show().find('p');
                        for(var i in data.Projektname){
                            p.append(data.Projektname[i]);
                        }
                
                    }
                    if(data.Projektbeschreibung){
                        p = details.find('.description').show().find('p');
                        for(var i in data.Projektbeschreibung){
                            p.append(data.Projektbeschreibung[i]);
                        }
              
                    }
                }
            }
        });
    }
    $('#search_result .even.found.show').live('click',function(){
        $(this).hide().next('td.found.hide').show();
        id = $(this).find('.id').text();
        $('#search_result .details.found.show').show();
        $('#search_result .details.found.hide').hide();
        $('tr.data.'+id).fadeOut('slow');
        $('tr.tables.'+id).fadeIn('slow',function(){
            if($(this).hasClass('empty')){
                search($(this),id);
            }
        });
    });
    $('#search_result .even.found.hide').live('click',function(){
        $(this).hide().prev('td.found.show').show();
        id = $(this).find('.id').text();
        
        $('tr.tables.'+id).fadeOut('slow');
    });
    
    $('#search_result .details.found.show').live('click',function(){
        $(this).hide().next('td.found.hide').show();
        id = $(this).find('.id').text();
        $('tr.tables.'+id).fadeOut('slow');
        $('#search_result .even.found.hide').hide();
        $('#search_result .even.found.show').show();
        $('tr.data.'+id).fadeIn('slow',function(){
            if($(this).hasClass('empty')){
                search($(this),id);
            }
        });
    });
    $('#search_result .details.found.hide').live('click',function(){
        $(this).hide().prev('td.found.show').show();
        id = $(this).find('.id').text();
         
        $('tr.data.'+id).fadeOut('slow');
    });
    
    $('#cart .even.found.show').live('click',function(){
        $(this).hide().next('td.found.hide').show();
        id = $(this).find('.id').text();
 
        $('tr.tables.'+id).fadeIn('slow');
    });
    $('#cart .even.found.hide').live('click',function(){
        $(this).hide().prev('td.found.show').show();
        id = $(this).find('.id').text();
        
        $('tr.tables.'+id).fadeOut('slow');
    });
    $('#admin_info').bind('click',function(){
        $(this).fadeOut('slow');
    });
     $('#admin_users').parents('#layout').width("98%");
});
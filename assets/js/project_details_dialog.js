$(function(){
    
    $('#project_details').dialog({
        minWidth:914,
        maxWidth:914,
        draggable:false,  
        modal:true,
        resizable:false,
        show: "blind",
        hide: "blind",
        buttons:[],
       
        close:function(){
          //  history.go(-1);
           // console.log( );
           if(document.referrer.match('/search/') != null){
               uri = document.referrer;
           }
            window.location.href = uri;
        }
    });
    $('#project_details').dialog("open");   
    $('#project_details .details.hide').on("click",function(){
        $('#project_details').dialog("close");   
    });
    $('#project_details .timelines.hide').on("click",function(){
        $('#project_details').dialog("close");   
    })
    
    $('#project_details .more').live('click',function(){
        $(this).removeClass('more').addClass('less').text(less);
        $(this).parents('.content').find('.short').removeClass('short');
    });
    
    $('#project_details .less').live('click',function(){
        $(this).removeClass('less').addClass('more').text(more);
        $(this).parents('.content').find('.left').addClass('short');
    });
});

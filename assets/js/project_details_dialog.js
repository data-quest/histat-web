$(function(){
    
    $('#project_details').dialog({
        minWidth:914,
        maxWidth:914,
        draggable:false,  
        modal:true,
        title:title,
        resizable:false,
        show: "blind",
        hide: "blind",
        buttons:[],
        closeText:closeText,
        close:function(){
            window.location.href = uri;
        }
    });
    $('#project_details').dialog("open");   
});

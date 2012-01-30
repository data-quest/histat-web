$(function(){
    $('#timeline').dialog({
        minWidth:914,
        maxWidth:914,
        draggable:false,
        modal:true,
        title:title,
        resizable:false,
        show: "blind",
        hide: "blind",
        closeText:closeText,
        buttons: [{
            text:resetText,
            click: function() {
                $( this ).dialog( "close" );
            }
        },{
            text:showText,
            click: function() {
                $( this ).dialog( "close" );
            }
        }],
        close:function(){
            window.location.href = uri;
        }
    });
    $('#timeline').dialog("open");  
});
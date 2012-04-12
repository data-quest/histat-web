$(function(){
    var range = {
        start: $("#search .start"),
        end:$("#search .end")
    };
    var value = {
        min:$('input[name="min"]'),
        max:$('input[name="max"]')
    }
    $( "#search #slider" ).slider({
        range: true,
        min: 1200,
        max: 2200,
        step:10,
        animate:true,
        values:[value.min.val(),value.max.val()],
        slide: function( event, ui ) {
           
            value.min.val(ui.values[ 0 ]);
            value.max.val(ui.values[ 1 ]);
            range.start.text(value.min.val());
            range.end.text(value.max.val());
        },
        create:function(event,ui){
            
           
            range.start.text(value.min.val());
            range.end.text(value.max.val());
        }
    });
    $('input[name="all"]:checked').click(function(){console.log("test")});
    $('input[name="text"]').focus(function(){
       var t = $(this);
       if(t.val() === "Suchbegriff") t.val("");
    });
})
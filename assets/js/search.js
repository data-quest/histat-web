$(function(){
    $( "#search #slider" ).slider({
        range: true,
        min: 1200,
        max: 2200,
        values:[1200,2200],
        slide: function( event, ui ) {
          //  $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });
})
var renderButtons = function(){
    $('input[type="submit"]').button();
    $('button').button();
}

$(function(){
    renderButtons();  
    $('.debug').dialog();
});
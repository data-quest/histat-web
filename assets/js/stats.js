$(function() {
    var fromDiv = $('#from');
    var toDiv = $('#to');
    var fromInput = $('input[name="from"]');
    var toInput =  $('input[name="to"]');
    fromDiv.datepicker({
        defaultDate:from,
        changeMonth: true,
        changeYear:true,
        showOtherMonths: true,
        nextText:"&nbsp;",
        prevText:"&nbsp;",
        dateFormat: "dd.mm.yy",
        monthNamesShort:["Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember"],
        dayNamesMin:["So","Mo","Di","Mi","Do","Fr","Sa"],
        onSelect: function( selectedDate ) {
            toDiv.datepicker( "option", "minDate", selectedDate );
       
            fromInput.val(selectedDate);
        },onChangeMonthYear:function(year,month,e){
            fromInput.val(e.selectedDay+'.'+e.selectedMonth+'.'+e.selectedYear);
   
        }
                       
    });
    toDiv.datepicker({
        defaultDate:to,
        changeMonth: true,
        changeYear:true,
        showOtherMonths: true,
        nextText:"&nbsp;",
        prevText:"&nbsp;",
        dateFormat: "dd.mm.yy",
        monthNamesShort:["Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember"],
        dayNamesMin:["So","Mo","Di","Mi","Do","Fr","Sa"],
        onSelect: function( selectedDate ) {
           fromDiv.datepicker( "option", "maxDate", selectedDate );
    
            toInput.val(selectedDate);
        },
        onChangeMonthYear:function(year,month,e){
              toInput.val(e.selectedDay+'.'+e.selectedMonth+'.'+e.selectedYear);
        
        }
    });
});
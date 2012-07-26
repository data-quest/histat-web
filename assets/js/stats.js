$(function() {
  
		$( "#from" ).datepicker({
			defaultDate:"-3w",
			changeMonth: true,
                        changeYear:true,
                        showOtherMonths: true,
			 nextText:"&nbsp;",
                        prevText:"&nbsp;",
                        dateFormat: "dd.mm.yy",
                        monthNamesShort:["Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember"],
                        dayNamesMin:["So","Mo","Di","Mi","Do","Fr","Sa"],
			onSelect: function( selectedDate ) {
				$( "#to" ).datepicker( "option", "minDate", selectedDate );
                                $('input[name="from"]').val(selectedDate);
			}
                       
		});
		$( "#to" ).datepicker({
			
			changeMonth: true,
                        changeYear:true,
                        showOtherMonths: true,
                    nextText:"&nbsp;",
                        prevText:"&nbsp;",
                        dateFormat: "dd.mm.yy",
                      monthNamesShort:["Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember"],
                        dayNamesMin:["So","Mo","Di","Mi","Do","Fr","Sa"],
			onSelect: function( selectedDate ) {
				$( "#from" ).datepicker( "option", "maxDate", selectedDate );
                                $('input[name="to"]').val(selectedDate);
			}
		});
	});
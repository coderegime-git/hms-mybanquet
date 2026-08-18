
  $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
	
	$('#booking_no' ).autocomplete({
		source: item_codes
	});

	$('#booking_no').on('keyup', function() {
	  	   $('#guest_name').val(getFPName(arr,$(this).val()));
		   $('#venue').val( getFPVen(arr,$(this).val()));
		   $('#session').val( getFPSes(arr,$(this).val()));
		   $('#tot_pax').val( getFPGuar(arr,$(this).val()));
		  /*  $('#tot_pax').focus(); */
		  /*  $('#menu'+rowid).val('');  */
	});
	 
	
	
	 
	
		
		
			
  } );

  

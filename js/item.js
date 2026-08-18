
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
	
	$( 'input[name^=kot_itemcode]' ).autocomplete({
	 source: item_codes
	});
	
	$( 'input[name^=kot_itemdesc]' ).autocomplete({
	 source: itemdes
	});
	
	
  $('input[name^=kot_itemcode]').on('blur', function() {
	   rowid=($(this).attr("id")).substr(9);
	   itDs=$('#item_desc'+rowid).val();
		   $('#item_desc'+rowid).val( getName(arr,$(this).val()));
		   $('#item_rate'+rowid).val( getDes(arr,$(this).val()));
		   $('#item_qty'+rowid).val();
		   $('#item_val'+rowid).val( getVal(arr,$(this).val()));
		  /*  $('#kot_lnedsvl'+rowid).val( getDis(arr,$(this).val())); */
		   $('#sCode'+rowid).val( getTxStr(arr,$(this).val()));
		   $('#menu_type'+rowid).val( getMnuType(arr,$(this).val()));
		   $('#item_qty'+rowid).focus();
		   $('#item_qty'+rowid).val(''); 
	  });
	 
	 $('input[name^= kot_itemdesc]').on('blur', function() {
	 rowid=($(this).attr("id")).substr(9);
	 itQ= $('#item_qty'+rowid).val();
			$('#item_code'+rowid).val(selName(arr,$(this).val()));
			$('#item_rate'+rowid).val(selDes(arr,$(this).val()));
			$('#item_qty'+rowid).val();
			$('#item_val'+rowid).val(selVal(arr,$(this).val()));
			/* $('#kot_lnedsvl'+rowid).val(selDis(arr,$(this).val())); */
			$('#sCode'+rowid).val( selTxStr(arr,$(this).val()));
			$('#menu_type'+rowid).val( selMnuType(arr,$(this).val()));
			$('#item_qty'+rowid).focus();
	 });
	 
	$('input[name^=kot_itemqty]').on('blur', function(a) {
		 $('#item_rate'+rowid).focus();  
		rowid=($(this).attr("id")).substr(8);
		rd=parseFloat(rowid)+parseFloat(1);
		vl=$(this).val();
		 itM= $('#item_qty'+rd).val();  
		
		 /* if(itM==''){
			if(vl<=0 || vl=="") {
				$('#item_qty'+rowid).val('');  
			}else{
			} 
		 } 	 */		   
	});
	
		
		$('input[name^=item_rate]').on('blur', function() {
			 rowid=($(this).attr("id")).substr(9);
			 rd=parseFloat(rowid)+parseFloat(1);
			 $('#item_desc'+rd).focus();
			 
		}); 	
		
			
  } );

  

function checkUserMaster(){
	var ck_name = /^[A-Za-z0-9 ]{3,20}$/;
	/* var ck_mobile = /^[0-9\-\(\)\s]+.{10}$/; */
	var ck_mobile = /^\d{10}$/; 
	var status = true;	
	username = $('#username').val();		
	password = $('#password').val();		
	repass = $('#repass').val();		
	email = $('#email').val();		
	mobile = $('#mobile').val();		
		if(username == '')
		{
			$('#user_err').html("Please enter User name.");
			status = false;
		} 
			else if(username.length < 4)
			{
				$('#user_err').html("User name should be between 4 to 32 characters.!");
				status = false;
			}
			else if(!ck_name.test(username))
			{
				$('#user_err').html("Special characters not allowed.!");
				status = false;
			}
			else {
			$('#user_err').html("");
			}
			
			
		if(password == ''){
			$('#pass_err').html("Please enter password");
			status = false;
		}
		else if(password.length < 4 || password.length > 12)
		{
			$('#pass_err').html("Password must be between 4 to 12 characters");
			status = false;
		}
		else {
			$('#pass_err').html("");
			}
			
		if(repass == ''){
			$('#repass_err').html("Please enter password");
			status = false;
		}
		else if(password != repass){
			$('#repass_err').html("password and confirm password not matching.");
			status = false;
		} 	
		else {
			$('#repass_err').html("");
			}		
		
		
		if(email == ''){
			$('#email_err').html("Please enter valid email-id");
			status = false;
		}
		else if(!validateEmail(email)) { 
		$('#email_err').html("Email-address is not valid.");
			status = false;
		}
		else {
			$('#email_err').html("");
			}
		
		if(mobile == ''){
		$('#mobile_err').html("Please enter mobile number.");
		status = false;
		}
			else if(!ck_mobile.test(mobile)){
			$('#mobile_err').html("Contact number must be 10 digits.");
			status = false;	
			}
			else {
				$('#mobile_err').html("");
				}
					
		if(!status){
		return false;
		}
		else
		{
			/* $("#reg-submit").val("Processing.."); */
		}
}


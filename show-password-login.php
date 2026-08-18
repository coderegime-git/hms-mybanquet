<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>MYERP</title>


	<link rel="stylesheet" href="login-form/css/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="login-form/css/style.css">

	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
</head>

<body>
	<div class="container">
		<div class="top">
			<h1 id="title" class="hidden"><span id="logo">MY <span>ERP</span></span></h1>
		</div>
		
<?php 	
if(isset($_GET['msg'])){
?>
<label id="msgFo" class="" style="color:red;margin:0 0 0 0px;padding:4px 15px 4px 15px;font-weight:bold;"><?php echo $_GET['msg']; ?></label>
<?php } ?>	

		<div class="login-box animated fadeInUp">
			<div class="box-header">
				<h2>Log In</h2>
			</div>
			<label for="username">Username</label>
			<br/>
			<input type="text" name="username" id="username">
			<br/>
			<label for="password">Password</label>
			<br/>
			<input type="password" name="password" id="password" class="showpassword">
			<input type='checkbox' class='showpasswordcheckbox' id='showPassword' />
			<label for='showPassword'>showPassword</label>
			<br/>
			<button type="submit">Sign In</button>
			<br/>
			<a href="#"><p class="small">Forgot your password?</p></a>
		</div>
	</div>
	
</body>

<script>
	$(document).ready(function () {
		$("#msgFo").fadeOut(5000);
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
	});
	$('#username').focus(function() {
		$('label[for="username"]').addClass('selected');
	});
	$('#username').blur(function() {
		$('label[for="username"]').removeClass('selected');
	});
	$('#password').focus(function() {
		$('label[for="password"]').addClass('selected');
	});
	$('#password').blur(function() {
		$('label[for="password"]').removeClass('selected');
	});
	
	
	
	
	$(function(){
			    $(".showpassword").each(function(index,input) {
			        var $input = $(input);
			        $("<p class='opt' />").append(
			            $("<input type='checkbox' class='showpasswordcheckbox' id='showPassword' style='margin:0 0 0 100px;'/>").click(function() {
			                var change = $(this).is(":checked") ? "text" : "password";
			                var rep = $("<input placeholder='Password' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;
			             })
			        ).append($("<label for='showPassword'/>").text("Show password")).insertAfter($input.parent());
			    });

			    $('#showPassword').click(function(){
					if($("#showPassword").is(":checked")) {
						$('.icon-lock').addClass('icon-unlock');
						$('.icon-unlock').removeClass('icon-lock');    
					} else {
						$('.icon-unlock').addClass('icon-lock');
						$('.icon-lock').removeClass('icon-unlock');
					}
			    });
			});
			
			
</script>

</html>
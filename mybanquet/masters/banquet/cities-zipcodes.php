<?php
include("../../config.php");
include("../../header.php");
?>
<style>
 label {width: 120px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000; } 

   
   
.button_example{
border:4px solid #26759E;-webkit-box-shadow: #878787 0px 2px 2px ;-moz-box-shadow: #878787 0px 2px 2px ; box-shadow: #878787 0px 2px 2px ; -webkit-border-radius: 10px; -moz-border-radius: 23px;border-radius: 23px;font-size:13px;font-family:arial, helvetica, sans-serif; padding: 4px 20px 4px 20px; text-decoration:none; display:inline-block;text-shadow: 2px 2px 0 rgba(0,0,0,0.3);font-weight:bold; color: #FFFFFF;
 background-color: #3093C7; background-image: -webkit-gradient(linear, left top, left bottom, from(#3093C7), to(#1C5A85));
 background-image: -webkit-linear-gradient(top, #3093C7, #1C5A85);
 background-image: -moz-linear-gradient(top, #3093C7, #1C5A85);
 background-image: -ms-linear-gradient(top, #3093C7, #1C5A85);
 background-image: -o-linear-gradient(top, #3093C7, #1C5A85);
 background-image: linear-gradient(to bottom, #3093C7, #1C5A85);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#3093C7, endColorstr=#1C5A85);
}

.button_example:hover{
 border:4px solid #26759E;
 background-color: #26759E; background-image: -webkit-gradient(linear, left top, left bottom, from(#26759E), to(#133D5B));
 background-image: -webkit-linear-gradient(top, #26759E, #133D5B);
 background-image: -moz-linear-gradient(top, #26759E, #133D5B);
 background-image: -ms-linear-gradient(top, #26759E, #133D5B);
 background-image: -o-linear-gradient(top, #26759E, #133D5B);
 background-image: linear-gradient(to bottom, #26759E, #133D5B);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#26759E, endColorstr=#133D5B);
}


</style>
	 
<body style="background: #eaebfc url(../../images/bg.jpg) repeat scroll center top;
    font: 69%/160% Lucida Grande,Verdana,Helvetica,Arial,sans-serif;">
	

	

	 <div class="box " style="width:78%;box-shadow: -4px 6px 10px -3px rgba(0,0,0,0.76);float:left;padding:14px 0 0 10px;margin:0px 0 0 5px;border-right:1px solid #C6C9CE;border-left:1px solid #BBBED4;background-color:#FFF;" >&nbsp;
	 
	<div>
		<ul class="breadcrumbb">
			<li><a href="#">Masters</a></li>
			<li><a href="#">Front Desk</a></li>
			<li><a href="#">Cities & Zip Codes</a></li>
			<li><a href="#"></a></li>
		</ul>
	</div>

	<div class="box-header well">	
		<!--<h2><i class="icon-info-sign"></i>Room Details</h2>-->
		<h3>Cities & Zip Codes</h3>
	</div>
	 <br/>
	 
	
	<form id="">
		<p>
		<label for="IDofInput">Pin Code <em></em></label><input type="text" id="IDofInput" />
		
		</p>
		<p>
		<label for="IDofInput">City<em></em></label><input type="text" id="IDofInput" />
		</p>
		<p>
		<label for="IDofInput">Status <em></em></label><input type="Checkbox" id="IDofInput" /><label>Active</label>
		</p>
		
		<div style="margin:40px 0 0 210px;">
			<input type="submit" name="" id="" value="Submit" class="button_example"/>
		</div>
		
	</form>
	
	</div>

</body>
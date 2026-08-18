<?php
ob_start();
include("../config.php");
include("../header.php");
/* include("../menu.php"); */
?>
 <!--form validation-->	
<link rel="stylesheet" href="../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>


<!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
jQuery("#taxTypes").validationEngine();
$("#msgFo").fadeOut(5000);	
	 $(".datepicker" ).datepicker({
	    changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"dd-mm-yy"
  });
  
   $(".datepicker1" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"dd-mm-yy"
  }); 

	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(5000);

});

 
</script> 
<?php 	
if(isset($_GET['msg'])){
?>
<p style="text-align:center;margin:auto;">
		<label id="msgFo" class="msgNotify"><?php echo $_GET['msg']; ?></label>
</p>
<?php } ?>
<body class="bgBODY">
	<div><img src="<?php echo $home_path; ?>/images/chef.jpg" class="sbtBtnImg" style="width:200px;height:200px;margin: 40px 0px 0 161px;" /></div>
<div id="invoice" style="" class="">


<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:700px;height:239px;">
	<h3 id="Userhd"><b>Import BqItem master</b></h3>
		<form class="form-horizontal well" action="upload_itmmast.php" method="post" name="upload_excel" enctype="multipart/form-data">
				
				
					<fieldset style="text-align:center;">
						<legend>Import CSV/Excel file</legend>
						<div class="control-group">
							<div class="control-label" style="margin: 0 273px 0 0;">
								<label>CSV/Excel File:</label>
							</div>
							<div class="controls">
								<input type="file" name="file" id="file" class="input-large" style="margin: 13px 0px 13px 200px; border: none;">
							</div>
						</div>
						
						<div class="control-group">
							<div class="controls">
							<button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
							</div>
						</div>
					</fieldset>
				</form>
	
	

	</div>
	</div>
<?php include("../footer.php"); ?>	
</body>
</html>
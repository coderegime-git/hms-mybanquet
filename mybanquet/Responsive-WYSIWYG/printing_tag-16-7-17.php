<?php
ob_start();
include("../config.php");
include("../header.php");


$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curTime=date('H:i:s');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<!--<script type="text/javascript" src="<?php echo $home_path; ?>/js/jquery-1.11.1.min.js"></script>-->
		<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
		<script src="<?php echo $home_path; ?>/js/bootstrap.min.js"></script>
		<script src="editor.js"></script>
		<script>
			$(document).ready(function() {
				$("#txtEditor").Editor();
			});
		</script>
		<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/font-awesome.min.css">
		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
		<link href="editor.css" type="text/css" rel="stylesheet"/>
	</head>
	<body style="background-color:#fff;">
		<div class="container-fluid">
			<div class="row">
			
				<div class="container">
					<div class="row">
						<div class="col-lg-12 nopadding">
							<textarea id="txtEditor"></textarea> 
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</body>
</html>

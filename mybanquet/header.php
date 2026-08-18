<?php 
ob_start();
//session_start(); 
/* include("config.php"); */
$ippaths = 'http://'.$_SERVER['HTTP_HOST'];
$sql=mysql_query("select * from property_definition where propdef_id='1'");
$row=mysql_fetch_array($sql);
?>

<!DOCTYPE> 
<html>

<!--<!DOCTYPE HTML>
<html>-->
<head>
<title>MY BANQUET</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Home Jobs, Data Entry, Data Outsourcing, Online Jobs" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="<?php echo $home_path; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $home_path; ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!--<link href='//fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>-->
<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/ie.css">
<link rel="stylesheet" href="<?php echo $home_path; ?>/css/flexslider.css" type="text/css" media="screen" />
<!---strat-slider---->
<script type="text/javascript" src="<?php echo $home_path; ?>/js/jquery-1.11.1.min.js"></script>
<!---//-slider---->

<script src="<?php echo $home_path; ?>/js/shortcut.js" type="text/javascript"></script>
<link rel="shortcut icon" href="images/rms.png">	
    <link rel="stylesheet" href="<?php echo $home_path; ?>/megamenu-js-master/css/style.css">
    <link rel="stylesheet" href="<?php echo $home_path; ?>/megamenu-js-master/css/ionicons.min.css">
 
</head>
<script>
$(document).ready(function() {
	
	
	$('form input').keydown(function(e){
             if(e.keyCode==13){       

                if($(':input:eq(' + ($(':input').index(this) + 1) + ')').attr('type')=='submit'){// check for submit button and submit form on enter press
                 return true;
                }

                $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();

               return false;
             }
			 
			if (e.keyCode == 39) {      
				$(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();

			}
			if (e.keyCode == 37) {      
				$(':input:eq(' + ($(':input').index(this) - 1) + ')').focus();

			}
			/* if (e.keyCode == 40) {      
				$(':input:eq(' + ($(':input').index(this) - 1) + ')').focus();

			} */

            });
			
			
			

});
	  
		function selectcompany() {
			get_company=$('#get_company').val();
			page = "<?php echo $_SERVER['PHP_SELF'];?>";
			/* alert(page); */
				$.ajax({
					type:'GET',
					url:'../action/companySession.php',
					data:{
					get_company:get_company
					},
					success:function(data){
						location.href=page;
						/* location.reload(); 
						 alert(data); 
						 if(data==1){
							msg='user name already exists';
							$('#msg').html(msg); 
							$('#username').focus();
						} 
						else{
						$('#msg').html('');  
						}  */
					}
				});
			
			}
			
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

</script>
<body onload="startTime()">
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

date_default_timezone_set('Asia/Kolkata');
$currTme = date('H:i:s');
?>
<!-- header -->
	<div class="header_bg" style="  background: #0073B5; ">
		<!--<div class="container" >-->
			<!-----start-header----->
		<div class="" >
			<div class="header" >
			
			
				<!--<div class="logo">-->
<div style="padding:10px;">
					<a href="<?php echo $ippath; ?>/dashboard-my.php"><img src="<?php echo $home_path; ?>/images/hmsmysoftname.png" alt="" style="width:109px;height:30px;" /></a>
					
	<div class="btn-group pull-right" style="/* margin:7px -26px 0 0; */">
			<!--<a class="btn dropdown-toggle" href="<?php echo $home_path; ?>/index.php" style="margin:0 0 0 -742px;">-->
				<i class="icon-home"></i>
				<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;margin:0 0 0 -742px;">Welcome To <?php echo $row['prop_name']; ?></span>
				<span class=""></span>
			<!--</a>-->
			<a class="btn dropdown-toggle" href="#" >
				<i class="icon-user"></i>
				<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;"><?php  echo $rowAC['cur_date']; ?></span>
				<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;" id="txt"></span>
				<span class=""></span>
			</a>
			
			
			<a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
				<i class="icon-user"></i>
				<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;"><?php echo $_SESSION['user']; ?></span>
				<span class=""></span>
			</a>
			<!--<a class="btn dropdown-toggle" href="<?php /*  echo $home_path;  */?>/logout.php" style="height:28px;">-->
			<a class="btn dropdown-toggle" href="<?php echo $home_path; ?>/logout.php">
				<!--<i class="icon-logout"></i>-->
				<i class="icon-logout"></i>
				<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;">Logout</span>
				<span class=""></span>
			</a>
		</div>
			</div>
				<?php include("menu.php");?>
			</div>
		</div>
	</div>

 
 
    <script src="<?php echo $home_path; ?>/megamenu-js-master/js/megamenu.js"></script>  
	<script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap.min.js"></script>
       
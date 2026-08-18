<?php 
session_start(); 
include("../config.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>MYERP</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Home Jobs, Data Entry, Data Outsourcing, Online Jobs" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="<?php echo $home_path; ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!--<link href='//fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>-->
<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/style.css">
<link rel="stylesheet" href="<?php echo $home_path; ?>/css/flexslider.css" type="text/css" media="screen" />
<!---strat-slider---->
<script type="text/javascript" src="<?php echo $home_path; ?>/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $home_path; ?>/js/all-validate.js"></script>
<!--<script type="text/javascript" src="jquery.js"></script>-->

<!---//-slider---->
<!---form valid---->
</head>


<script type="text/javascript">

//alert('<?php echo $_SESSION[companyId];?>');
$(document).ready(function() {
alert('dfdfd');
});
           	  
			  
		function selectcompany() {
			alert('dfdfd');
		}
		

					  
 </script>
 
 
 
 
<?php
$result_c=mysql_query("select * from user where user_name='".$_SESSION['user']."'");
				$companyname="";
				/* echo "select * from user where user_name='".$_SESSION['user']."'";
				die(); */
				while($row_c=mysql_fetch_object($result_c)) {
				$companyId=explode(',',$row_c->company_id);
				//$companyId=array_unique($companyId);
				$size=count($companyId);
					$companyname="<option value=''>--Select--</option>";
					for($i=0;$i<$size;$i++){
					$result_co=mysql_query("select * from company_details where company_id='$companyId[$i]'");
					
						while($row_co=mysql_fetch_object($result_co)) {
							/* if($_SESSION['companyId']==$row_co->company_id){
							$companyname.='<option value='.$row_co->company_id.' selected>'.$row_co->company_name.'</option>';?>
							<?php
							}
							else { */
							$companyname.='<option value='.$row_co->company_id.'>'.$row_co->company_name.'</option>';
							
							/* } */
						}
					}
				}
?>

 
 
<body>
<!-- header -->
<div class="header_bg" style="  background: linear-gradient(#3496C3, #3496C3); ">
  <div class="" >
	<div class="header" >
		<div style="padding:10px;">
			<a href="index.html"><img src="<?php echo $home_path; ?>/images/hmsmysoftname.png" alt="" style="width:109px;height:30px;" /></a>
<div class="btn-group pull-right" style="/* margin:7px -26px 0 0; */">
				
<span style="margin-left:0px;margin-top:0px;">
	<select id="get_company" title="" name="get_company" onchange="selectcompany();" style="height:25px;font-size:15px;width:120px;margin: 5px 0 0;">
	<?php echo $companyname;?>
	</select>
</span>

					<a class="btn dropdown-toggle" href="<?php echo $home_path; ?>/index.php">
						<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;">Welcome</span>
					</a>
					<a class="btn dropdown-toggle" href="<?php echo $home_path; ?>/admin/user-master.php" >
						<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;"><?php echo $_SESSION['user']; ?></span>
					</a>
					<a class="btn dropdown-toggle" href="<?php echo $home_path; ?>/logout.php">
						<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;">Logout</span>
					</a>
				</div>
		</div>
	<?php include("../menu.php");?>
	</div>
 </div>
</div>
	 





<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/elastic-slider/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/elastic-slider/css/style.css" />
       	<noscript>
		<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/elastic-slider/css/noscript.css" />
		</noscript>


        <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>-->
        <script type="text/javascript" src="elastic-slider/js/jquery.eislideshow.js"></script>
        <script type="text/javascript" src="elastic-slider/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript">
            $(function() {
                $('#ei-slider').eislideshow({
					animation			: 'center',
					autoplay			: true,
					slideshow_interval	: 3000,
					titlesFactor		: 0
                });
            });
        </script>		
      
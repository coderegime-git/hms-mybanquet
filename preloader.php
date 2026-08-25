<?php
session_start();
$fromdate = isset($_GET['fromdate']) ? $_GET['fromdate'] : '';
$todate = isset($_GET['todate']) ? $_GET['todate'] : '';
$redirect_url = 'dashboard.php';
if (!empty($fromdate) && !empty($todate)) {
    $redirect_url .= '?fromdate=' . urlencode($fromdate) . '&todate=' . urlencode($todate);
}
?>
<html>
<head>
<title>MY BANQUET</title>
<style>
h2{color:#FFF; font-family: Arial, sans-serif;}
</style>
<script>
function preloader(){
    setTimeout(function(){ document.location.href='<?php echo $redirect_url; ?>'; }, 2000);
}
</script>
</head>
<body onload="preloader()" style="background: #f4f6f9; margin: 0; padding: 0;">
  <div align="center" style="border:1px solid #3971a3; background: #3973A4; margin:150px auto; max-width: 600px; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
    <h2>Please wait while we load your</h2>
    <h2>preferences and settings</h2>
    <img src="images/page-loader.gif" alt="loading" title="loading"/>
  </div>
</body>
</html>

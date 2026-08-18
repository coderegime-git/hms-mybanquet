<?php
session_start();
include("../config.php");
 $getCompanyID=$_GET['get_company'];
$_SESSION['companyId']=$getCompanyID;
/* echo $_SESSION['companyId']; */
/* die(); */
?>
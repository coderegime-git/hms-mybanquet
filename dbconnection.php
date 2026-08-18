<?php
$servername = "localhost";  
$username = "root";   
$password = "";
$dbname = "hmsclient";    
$adminconn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($adminconn,"utf8"); 

define("host","localhost");
define("user","root");
define('password',"");
define('dbname',"hmsclient");
$adconn = mysql_connect(host,user,password);
mysql_query("SET NAMES UTF8");
mysql_select_db(dbname,$adconn);
?>
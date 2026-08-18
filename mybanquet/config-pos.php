<?php
date_default_timezone_set('Asia/Kolkata');
$home_path='http://www.mysoftindia.com/mypos';

define("host","localhost");
define("user","sunbeam1_pos");
define('password',"pos*123");
define('dbname','sunbeam1_pos');
$conn = mysql_connect(host,user,password);
mysql_query("SET NAMES UTF8");
mysql_select_db(dbname,$conn);

?>

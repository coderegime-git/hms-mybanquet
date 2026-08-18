<?php
session_start();
include("../../config.php");
/* include("../dashboard-computation.php"); */
include('../backup/DBBackup.class.php');

$db = new DBBackup(array(
	'driver' => 'mysql',
	'host' =>'localhost',
	'user' => 'root',
	'password' => '',
	'database' => 'mybills'
));
$curDate =date('Y-m-d-H-i-s');
$backup = $db->backup();
/* $dir = $home_path."/transaction/"; */
if(!$backup['error']){
	// If there isn't errors, show the content
	// The backup will be at $var['msg']
	// You can do everything you want to. Like save in a file.
	$fileName=dbname.'-'.$curDate.'.sql';
	$x=dbname.'-'.$curDate.'.sql';
	
	 $fp = fopen($fileName, 'w');
	 fwrite($fp, $backup['msg']);
	 fclose($fp);

/* echo $fileName;
die(); */ 

header("Content-type:application/x-sql");
header("Content-Disposition:attachment;filename=$fileName");

header('location:'.$home_path.'/transaction/backup/download-link.php?msg=Database created!');
 /* echo "Database Created"; */
	
} else {
	header('location:'.$home_path.'/transaction/backup/download-link.php?msg=An error has occurred.');
}
?>
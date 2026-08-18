<?php  
session_start();
include("../config.php");

$nsnNo=$_REQUEST['term'];

/* $sqlCl=mysql_query("select * from unsuccessful_quotes where nsn_no='$nsnNo'");
$rowCl=mysql_fetch_array($sqlCl);
$award_whom=$rowCl['award_whom'];
echo $award_whom; */

/* $sqlCl=mysql_query("select * from quotation where nsn_no='$nsnNo'"); */



$query =query("select * from quotation where nsn_no LIKE '%".$nsnNo."%' ORDER BY quote_id ASC");
while($row = mysql_fetch_array($query)) {
  $json[]=array(
   'value'=> $row['nsn_no'],
   'label'=> $row['nsn_no']
  );
 }		
  echo json_encode($json);
/* $query =mysql_query("select * from quotation where nsn_no LIKE '%" .$nsnNo."%' ORDER BY quote_id ASC");
	    while ($row = $query->fetch_assoc()) {
		$data[] = $row['nsn_no'];
	}
	echo json_encode($data); */




?>









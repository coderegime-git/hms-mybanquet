<?php  
session_start();
include("../config.php");

/* $rfq=$_GET['rfq']; */

    //fetch department names from the department table
    $sql = "select rfq_no from quotation";
    $result = mysql_query($sql) or die("Error " . mysql_error($connection));

    $dname_list = array();
    while($row = mysql_fetch_array($result))
    {
        $dname_list[] = $row['rfq_no'];
    }
    echo json_encode($dname_list);

?>









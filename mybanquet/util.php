<?php
ob_start();

function getHallBookNumber(){
    $sql="select max(bookno) as maxnumber  from room_advance" ;
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    return  str_pad($row['maxnumber']+1,1,"0",STR_PAD_LEFT );
}

function getHallRcptNumber(){
    $sql="select max(bkrcptno) as maxnumber  from refund" ;
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    return  str_pad($row['maxnumber']+1,1,"0",STR_PAD_LEFT );
}





 ?>
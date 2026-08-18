<?php
include('../../mpdf571/mpdf.php');
include "../../config.php";
error_reporting(0);
/* if (isset($_GET["rowid"])) {
    $row_id = $_GET["rowid"];
    $selectquery = "SELECT * FROM purchase_order where id=$row_id";
    $run = mysqli_query($con, $selectquery);
    $row = mysqli_fetch_array($run);
    $id = $row['id'];
    $jsonData_cost = $row['item_json'];
    $po_date=date('d-m-Y',  strtotime($row['po_date']));
    $delivery_date=date('d-m-Y',  strtotime($row['delivery_date']));
    $delivery_at=$row['delivery_at'];
    $po_no=$row['id'];
} */
header1('Content-Type: application/pdf');
$header1="<table style='width:900px'>
<tr>
    <td style='width: 300px;'></td>
    <td style='width: 300px;'>The Sunway Manor<br>
        Purchase Order</td>
    <td style='width: 300px;'></td>
</tr>
<tr><td>To</td><td></td><td></td></tr>
<tr><td style='padding-left: 25px;'>Kovai Pazhamudir Nilayam Kovai</td><td></td><td></td></tr>

<tr>
    <td style='padding-left: 25px;'>vilupparam main Road</td>
    <td></td>

</tr>
<tr>
    <td style='padding-left: 25px;'>Pududcherry</td>
    <td></td>
   
</tr>

</table>";

$reportheadername='Purchase Order';
$mpdf=new mPDF('utf-8','A4');
$mpdf->debug=true;
$mpdf->SetHTMLHeader('<h3><div style="text-align: center; font-weight: bold;margin-bottom: 2cm;"></div></h3>', 'O', true);
$mpdf->WriteHTML($header1);
//$reportpdf = $mpdf->Output($finaltable);
$mpdf->SetHTMLFooter('<div style="text-align: center;">'.$footer.'</div>');
 $reportpdf = $mpdf->Output('Purchase Order'. '.pdf', 'I'); 
/* $reportpdf = $mpdf->Output($finaltable); */


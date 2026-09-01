<?php
ob_start();
error_reporting(0);
include("../../config.php");
include("../../header.php");
?>

<style type="text/css">
body, body.bgBODY {
    background-color: #ffffff !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    margin: 0 !important;
    padding: 0 !important;
}

.mypay-container {
    width: 98% !important;
    max-width: 100% !important;
    margin: 15px auto 40px auto !important;
    padding: 0 !important;
}

/* Action Buttons Bar on Top */
.mypay-actions-bar {
    display: flex !important;
    justify-content: flex-end !important;
    align-items: center !important;
    gap: 8px !important;
    margin-bottom: 10px !important;
    flex-wrap: wrap !important;
}

.btn-mypay-exit {
    background-color: #005580 !important;
    color: #ffffff !important;
    border: 1px solid #004466 !important;
    border-radius: 3px !important;
    padding: 4px 14px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    font-weight: bold !important;
    height: 28px !important;
    box-sizing: border-box !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    text-decoration: none !important;
    cursor: pointer !important;
    line-height: 1 !important;
}

.btn-mypay-exit:hover {
    background-color: #004466 !important;
    color: #ffffff !important;
}

.mypay-icon-exit {
    color: #f39c12 !important;
    font-size: 13px !important;
}

/* Table Wrapper for Horizontal Scroll */
.mypay-table-wrapper {
    width: 100% !important;
    max-height: 560px !important;
    overflow-x: auto !important;
    overflow-y: auto !important;
    border: 1px solid #0073B5 !important;
    background: #ffffff !important;
}

/* View Data Table */
.mypay-table {
    width: 100% !important;
    min-width: 1200px !important;
    border-collapse: collapse !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    background-color: #ffffff !important;
    margin: 0 !important;
}

.mypay-table thead tr.banner-row th {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    text-align: center !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-weight: bold !important;
    font-size: 13px !important;
    height: 34px !important;
    padding: 8px 12px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    border: 1px solid #0073B5 !important;
    vertical-align: middle !important;
    position: sticky !important;
    top: 0 !important;
    z-index: 10 !important;
}

.mypay-table thead tr.header-row th {
    background-color: #f5f5f5 !important;
    color: #222222 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-weight: bold !important;
    font-size: 11px !important;
    text-align: center !important;
    height: 32px !important;
    padding: 6px 6px !important;
    border: 1px solid #e0e0e0 !important;
    vertical-align: middle !important;
    white-space: nowrap !important;
    position: sticky !important;
    top: 34px !important;
    z-index: 9 !important;
}

.mypay-table tbody td {
    padding: 6px 6px !important;
    border: 1px solid #e0e0e0 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 11px !important;
    color: #333333 !important;
    text-align: center !important;
    background-color: #ffffff !important;
    height: 30px !important;
    vertical-align: middle !important;
}

.mypay-table tbody tr:hover td {
    background-color: #f8fbfe !important;
}

.btn-mypay-refund {
    background-color: #d9534f !important;
    color: #ffffff !important;
    border: 1px solid #d43f3a !important;
    border-radius: 3px !important;
    padding: 3px 10px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 11px !important;
    font-weight: bold !important;
    display: inline-block !important;
    text-decoration: none !important;
    cursor: pointer !important;
    line-height: 1.3 !important;
}

.btn-mypay-refund:hover {
    background-color: #c9302c !important;
}
</style>

<script>
jQuery(document).ready(function(){
    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+E", function() { 
            window.location.href = "<?php echo $home_path; ?>/dashboard.php";
        }); 
    }
});
</script>

<body class="bgBODY">

<div class="mypay-container">

    <!-- Top Action Bar -->
    <div class="mypay-actions-bar">
        <a href="<?php echo $home_path; ?>/dashboard.php" class="btn-mypay-exit" id="exit" title="Exit (Ctrl+E)">
            <span class="mypay-icon-exit"><i class="fa fa-sign-out"></i></span>
            <span>Exit</span>
        </a>
    </div>

    <!-- Data Table Container -->
    <div class="mypay-table-wrapper" id="dvContainer">
        <table class="mypay-table" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="banner-row">
                    <th colspan="9">VIEW RESERVATION ADVANCE</th>
                </tr>
                <tr class="header-row">
                    <th style="width: 5%;">Sl.No</th>
                    <th style="width: 10%;">Receipt Date</th>
                    <th style="width: 12%;">Receipt No</th>
                    <th style="width: 12%;">Function Date</th>
                    <th style="width: 20%;">Guest Name</th>
                    <th style="width: 12%;">Amount</th>
                    <th style="width: 10%;">Pay Mode</th>
                    <th style="width: 10%;">Status</th>
                    <th style="width: 9%;">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $sqlAC = mysql_query("select * from audt_control where audtcontrol_id='1'");
            $rowAC = mysql_fetch_array($sqlAC);
            $adtCurDt = $rowAC['cur_date'];
            $ad = array_map('trim', explode('/', $adtCurDt));
            $adD = $ad[2] . '-' . $ad[1] . '-' . $ad[0];

            $sql = mysql_query("select * from bq_hallresvadv where str_to_date(cur_date,'%d/%m/%Y') <= '$adD' AND status='1' order by str_to_date(cur_date,'%d/%m/%Y') DESC");
            $x = 0;
            if($sql && is_resource($sql) && mysql_num_rows($sql) > 0) {
                while($row = mysql_fetch_array($sql)) {
                    $x++;
                    $status = ($row['status'] == 1) ? "Advance" : "Refund";
            ?>
                <tr>
                    <td><?php echo $x; ?></td>
                    <td><?php echo htmlspecialchars($row['cur_date']); ?></td>
                    <td><b><?php echo htmlspecialchars(strtoupper($row['receipt_no'])); ?></b></td>
                    <td><?php echo htmlspecialchars($row['function_date']); ?></td>
                    <td style="text-align:left;"><?php echo htmlspecialchars(strtoupper($row['guest_name'])); ?></td>
                    <td><?php echo sprintf("%01.2f", $row['amount']); ?></td>
                    <td><?php echo htmlspecialchars(ucfirst($row['pay_mode'])); ?></td>
                    <td><?php echo $status; ?></td>
                    <td>
                        <a href="<?php echo $home_path ?>/transaction/frontdesk/reserv-refund-advance.php?roomBk=<?php echo urlencode($row['receipt_no']); ?>&rmBkID=<?php echo urlencode($row['booking_no']); ?>&rmAmt=<?php echo urlencode($row['amount']); ?>" class="btn-mypay-refund">
                            Refund
                        </a>
                    </td>
                </tr>
            <?php 
                } 
            } else { 
            ?>
                <tr>
                    <td colspan="9" style="padding: 20px; color: #777; text-align: center; font-size: 13px;">
                        No Reservation Advance records found
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

<?php include("../../footer.php"); ?>
</body>
</html>
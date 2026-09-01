<?php
ob_start();
error_reporting(0);
include("../../config.php");
include("../../header.php");

$sqlAC = mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC = mysql_fetch_array($sqlAC);
$adtCurDt = trim($rowAC['cur_date']);
?>
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">

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
    justify-content: space-between !important;
    align-items: center !important;
    gap: 8px !important;
    margin-bottom: 10px !important;
    flex-wrap: wrap !important;
}

.mypay-filter-group {
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    flex-wrap: wrap !important;
}

.mypay-date-input {
    width: 100px !important;
    height: 28px !important;
    text-align: center !important;
    padding: 0 5px !important;
    border: 1px solid #0073B5 !important;
    border-radius: 4px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    box-sizing: border-box !important;
}

.mypay-search-input {
    width: 280px !important;
    height: 28px !important;
    padding: 0 10px !important;
    border: 1px solid #0073B5 !important;
    border-radius: 4px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    outline: none !important;
    box-sizing: border-box !important;
}

.btn-mypay-search {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    border: 1px solid #005b8a !important;
    border-radius: 3px !important;
    padding: 4px 12px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    font-weight: bold !important;
    height: 28px !important;
    box-sizing: border-box !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 5px !important;
    cursor: pointer !important;
    line-height: 1 !important;
    text-decoration: none !important;
}

.btn-mypay-search:hover {
    background-color: #005b8a !important;
    color: #ffffff !important;
}

.mypay-btn-group {
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
}

.btn-mypay-add {
    background-color: #0084b4 !important;
    color: #ffffff !important;
    border: 1px solid #00739c !important;
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

.btn-mypay-add:hover {
    background-color: #00739c !important;
    color: #ffffff !important;
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

.mypay-icon-plus {
    background-color: #28a745 !important;
    color: #ffffff !important;
    border-radius: 50% !important;
    width: 14px !important;
    height: 14px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 10px !important;
    font-weight: bold !important;
    line-height: 14px !important;
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
    min-width: 1550px !important;
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

.btn-mypay-row-print {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    border: 1px solid #005b8a !important;
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

.btn-mypay-row-print:hover {
    background-color: #005b8a !important;
    color: #ffffff !important;
}

.btn-mypay-row-cancel {
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

.btn-mypay-row-cancel:hover {
    background-color: #c9302c !important;
    color: #ffffff !important;
}

.btn-mypay-row-disabled {
    background-color: #e9ecef !important;
    color: #adb5bd !important;
    border: 1px solid #ced4da !important;
    border-radius: 3px !important;
    padding: 3px 10px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 11px !important;
    font-weight: bold !important;
    display: inline-block !important;
    cursor: not-allowed !important;
    line-height: 1.3 !important;
}
</style>

<script>
jQuery(document).ready(function(){
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        dateFormat: "dd/mm/yy"
    });

    $(".datepicker1").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        dateFormat: "dd/mm/yy"
    });

    $("#msgFo").fadeOut(5000);

    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+A", function() { 
            window.location.href = "view-fpvoucher.php";
        }); 
        shortcut.add("Ctrl+E", function() { 
            window.location.href = "<?php echo $home_path; ?>/dashboard.php";
        }); 
    }
});

function clkSubmit() {
    var fromdate = $('#from_date').val() || '';
    var todate = $('#to_date').val() || '';
    var srtx = $('#searchTxt').val().trim();
    document.location = "view-fpvoucher-details.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&val=" + encodeURIComponent(srtx);
}
</script>

<body class="bgBODY">

<?php if(isset($_GET['msg'])){ ?>
    <p style="text-align:center;margin:10px 0;">
        <label id="msgFo" style="color:#7B0E0E;font-weight:bold;font-size:13px;"><?php echo htmlspecialchars($_GET['msg']); ?></label>
    </p>
<?php } ?>

<div class="mypay-container">

    <!-- Top Action and Search Bar -->
    <div class="mypay-actions-bar">
        <div class="mypay-filter-group">
            <span style="font-weight:bold;font-size:12px;">From:</span>
            <input name="from_date" type="text" class="mypay-date-input datepicker" id="from_date" value="<?php if(isset($_GET['fromdate'])){ echo htmlspecialchars($_GET['fromdate']); } else { echo htmlspecialchars($adtCurDt); } ?>" placeholder="From Date" />
            <span style="font-weight:bold;font-size:12px;margin-left:4px;">To:</span>
            <input name="to_date" type="text" class="mypay-date-input datepicker1" id="to_date" value="<?php if(isset($_GET['todate'])){ echo htmlspecialchars($_GET['todate']); } else { echo htmlspecialchars($adtCurDt); } ?>" placeholder="To Date" />
            <input type="text" id="searchTxt" name="searchTxt" class="mypay-search-input" placeholder="Guest name / FP No / Booking No / Voucher No" value="<?php if(isset($_GET['val'])) { echo htmlspecialchars($_GET['val']); } ?>" onkeypress="if(event.keyCode==13){ clkSubmit(); return false; }" />
            <button type="button" name="submt" id="submt" class="btn-mypay-search" onclick="clkSubmit();">
                <i class="fa fa-search"></i> Search
            </button>
            <?php if((isset($_GET['val']) && trim($_GET['val']) != '') || (isset($_GET['fromdate']) && trim($_GET['fromdate']) != '')) { ?>
                <a href="view-fpvoucher-details.php" class="btn-mypay-search" style="background:#6c757d;border-color:#5a6268;text-decoration:none;">Reset</a>
            <?php } ?>
        </div>

        <div class="mypay-btn-group">
            <a href="view-fpvoucher.php" class="btn-mypay-add" id="add" title="Add Voucher (Ctrl+A)">
                <span class="mypay-icon-plus"><i class="fa fa-plus"></i></span>
                <span>Add Voucher</span>
            </a>
            <a href="<?php echo $home_path; ?>/dashboard.php" class="btn-mypay-exit" id="exit" title="Exit (Ctrl+E)">
                <span class="mypay-icon-exit"><i class="fa fa-sign-out"></i></span>
                <span>Exit</span>
            </a>
        </div>
    </div>

    <!-- Data Table Container -->
    <div class="mypay-table-wrapper" id="dvContainer">
        <table class="mypay-table" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="banner-row">
                    <th colspan="16">VIEW FUNCTION PROSPECTUS VOUCHER DETAILS</th>
                </tr>
                <tr class="header-row">
                    <th style="width: 3%;">Sl.No</th>
                    <th style="width: 6%;">Voucher#</th>
                    <th style="width: 6%;">Voucher Date</th>
                    <th style="width: 6%;">Booking#</th>
                    <th style="width: 6%;">BK Date</th>
                    <th style="width: 6%;">FP#</th>
                    <th style="width: 6%;">FP Date</th>
                    <th style="width: 4%;">Pax</th>
                    <th style="width: 10%;">Guest Name</th>
                    <th style="width: 7%;">Total Amt</th>
                    <th style="width: 6%;">Tax Amt</th>
                    <th style="width: 6%;">Adv Amt</th>
                    <th style="width: 7%;">Voucher Amt</th>
                    <th style="width: 6%;">Status</th>
                    <th style="width: 4%;">Print</th>
                    <th style="width: 5%;">Cancel</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $sqlAC = mysql_query("select * from audt_control where audtcontrol_id='1'");
            $rowAC = mysql_fetch_array($sqlAC);
            $adtCurDt = $rowAC['cur_date'];
            $ad = array_map('trim', explode('/', $adtCurDt));
            $cur = $ad[2] . '/' . $ad[1] . '/' . $ad[0];

            $frm = '';
            if(isset($_GET['fromdate']) && trim($_GET['fromdate']) != '') {
                $fr = array_map('trim', explode('/', $_GET['fromdate']));
                $frm = $fr[2] . '-' . $fr[1] . '-' . $fr[0];
            }
            
            $tod = '';
            if(isset($_GET['todate']) && trim($_GET['todate']) != '') {
                $to = array_map('trim', explode('/', $_GET['todate']));
                $tod = $to[2] . '-' . $to[1] . '-' . $to[0];
            }

            if($frm != '' && $tod != '' && isset($_GET['val']) && trim($_GET['val']) != '') {
                $v = mysql_real_escape_string($_GET['val']);
                $item_where = " where str_to_date(vouchrdate,'%d/%m/%Y') >= '$frm' AND str_to_date(vouchrdate,'%d/%m/%Y') <= '$tod' AND (fname like '%$v%' OR vouchrno like '%$v%' OR fpno like '%$v%' OR bkno like '%$v%') AND bill_status!='3' order by str_to_date(vouchrdate,'%d/%m/%Y') DESC";
            } else if($frm != '' && $tod != '') {
                $item_where = " where str_to_date(vouchrdate,'%d/%m/%Y') >= '$frm' AND str_to_date(vouchrdate,'%d/%m/%Y') <= '$tod' AND bill_status!='3' order by str_to_date(vouchrdate,'%d/%m/%Y') DESC";
            } else if(isset($_GET['val']) && trim($_GET['val']) != '') {
                $v = mysql_real_escape_string($_GET['val']);
                $item_where = " where (fname like '%$v%' OR vouchrno like '%$v%' OR fpno like '%$v%' OR bkno like '%$v%') AND bill_status!='3' order by str_to_date(vouchrdate,'%d/%m/%Y') DESC";
            } else {
                $item_where = " where bill_status!='3' order by str_to_date(vouchrdate,'%d/%m/%Y') DESC";
            }

            $sql = mysql_query("select * from bq_opvchrhdr $item_where");
            $x = 0;
            if($sql && is_resource($sql) && mysql_num_rows($sql) > 0) {
                while($row = mysql_fetch_array($sql)) {
                    $x++;
                    $stats = ($row['bill_status'] == 1) ? 'Processing' : (($row['bill_status'] == 2) ? 'Billed' : (($row['bill_status'] == 3) ? 'Cancelled' : ''));
            ?>
                <tr>
                    <td><?php echo $x; ?></td>
                    <td><b><?php echo htmlspecialchars($row['vouchrno']); ?></b></td>
                    <td><?php echo htmlspecialchars($row['vouchrdate']); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['bkno'])); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['bkdate'])); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['fpno'])); ?></td>
                    <td><?php echo htmlspecialchars($row['fpdate']); ?></td>
                    <td><?php echo htmlspecialchars($row['gpax']); ?></td>
                    <td style="text-align:left;"><?php echo htmlspecialchars(strtoupper($row['fname'])); ?></td>
                    <td style="text-align:right;"><?php echo sprintf("%01.2f", $row['nontaxableamt']); ?></td>
                    <td style="text-align:right;"><?php echo sprintf("%01.2f", $row['taxableamt']); ?></td>
                    <td style="text-align:right;"><?php echo sprintf("%01.2f", $row['advamt']); ?></td>
                    <td style="text-align:right;font-weight:bold;"><?php echo sprintf("%01.2f", $row['vchramt']); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($stats)); ?></td>
                    <td>
                        <a href="<?php echo $home_path;?>/transaction/view/print-voucher-billing.php?vuNum=<?php echo urlencode($row['vouchrno']); ?>" target="_blank" class="btn-mypay-row-print">
                            <i class="fa fa-print"></i> Print
                        </a>
                    </td>
                    <td>
                        <?php if($row['bill_status'] == 1) { ?>
                            <a href="<?php echo $home_path;?>/action/cancel-voucher-details.php?vucNo=<?php echo urlencode($row['vouchrno']);?>&fpNum=<?php echo urlencode($row['fpno']);?>&bkno=<?php echo urlencode($row['bkno']);?>" onclick="return confirm('Are you sure you want to cancel this voucher?');" class="btn-mypay-row-cancel">
                                Cancel
                            </a>
                        <?php } else { ?>
                            <span class="btn-mypay-row-disabled">Cancel</span>
                        <?php } ?>
                    </td>
                </tr>
            <?php 
                } 
            } else { 
            ?>
                <tr>
                    <td colspan="16" style="padding: 20px; color: #777; text-align: center; font-size: 13px;">
                        No Voucher records found
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
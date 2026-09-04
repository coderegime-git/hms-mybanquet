<?php
error_reporting(0);
ob_start();
include("../../config.php");
include("../../header.php");

$sqlAC = mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC = ($sqlAC && mysql_num_rows($sqlAC) > 0) ? mysql_fetch_array($sqlAC) : array();
$adtCurDt = isset($rowAC['cur_date']) ? trim($rowAC['cur_date']) : date('d/m/Y');

// Filter parameters
$frDateParam = isset($_GET['fromdate']) ? trim($_GET['fromdate']) : '';
$toDateParam = isset($_GET['todate']) ? trim($_GET['todate']) : '';
$valParam    = isset($_GET['val']) ? trim($_GET['val']) : '';

// Default dates
$displayFrom = ($frDateParam != '') ? $frDateParam : $adtCurDt;
$displayTo   = ($toDateParam != '') ? $toDateParam : $adtCurDt;

// Date conversions for SQL
$frm = '';
$tod = '';
if ($displayFrom != '' && $displayTo != '') {
    $fr = explode('/', $displayFrom);
    $to = explode('/', $displayTo);
    if (count($fr) == 3 && count($to) == 3) {
        $frm = $fr[2] . '-' . $fr[1] . '-' . $fr[0];
        $tod = $to[2] . '-' . $to[1] . '-' . $to[0];
    }
}
?>
<link rel="stylesheet" href="<?php echo $home_path;?>/css/mypay-master.css">
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo $home_path; ?>/js/shortcut.js"></script>

<style type="text/css">
/* Master View Styling for GST Amendment */
body, body.bgBODY {
    background-color: #ffffff !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    margin: 0 !important;
    padding: 0 !important;
}

.mypay-container {
    width: 96% !important;
    max-width: 100% !important;
    margin: 20px auto 40px auto !important;
    padding: 0 !important;
}

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

.mypay-filter-label {
    font-size: 13px !important;
    font-weight: bold !important;
    color: #222222 !important;
    margin: 0 !important;
    padding: 0 2px !important;
}

.mypay-date-input {
    width: 105px !important;
    height: 30px !important;
    line-height: 30px !important;
    text-align: center !important;
    padding: 0 6px !important;
    border: 1px solid #0073B5 !important;
    border-radius: 4px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #333333 !important;
    background: #ffffff !important;
    box-sizing: border-box !important;
    outline: none !important;
}

.mypay-date-input:focus {
    border-color: #0084b4 !important;
    box-shadow: 0 0 3px rgba(0, 132, 180, 0.4) !important;
}

.mypay-search-input {
    width: 250px !important;
    height: 30px !important;
    line-height: 30px !important;
    padding: 0 10px !important;
    border: 1px solid #0073B5 !important;
    border-radius: 4px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #333333 !important;
    background: #ffffff !important;
    box-sizing: border-box !important;
    outline: none !important;
}

.mypay-search-input:focus {
    border-color: #0084b4 !important;
    box-shadow: 0 0 3px rgba(0, 132, 180, 0.4) !important;
}

.btn-mypay-search {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    border: 1px solid #005b8a !important;
    border-radius: 3px !important;
    padding: 0 14px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    font-weight: bold !important;
    height: 30px !important;
    line-height: 28px !important;
    box-sizing: border-box !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    cursor: pointer !important;
    text-decoration: none !important;
}

.btn-mypay-search:hover {
    background-color: #005b8a !important;
    color: #ffffff !important;
}

.btn-mypay-reset {
    background-color: #6c757d !important;
    color: #ffffff !important;
    border: 1px solid #5a6268 !important;
    border-radius: 3px !important;
    padding: 0 10px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    font-weight: bold !important;
    height: 30px !important;
    line-height: 28px !important;
    box-sizing: border-box !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 4px !important;
    cursor: pointer !important;
    text-decoration: none !important;
}

.btn-mypay-reset:hover {
    background-color: #5a6268 !important;
    color: #ffffff !important;
}

.btn-mypay-print {
    background-color: #28a745 !important;
    color: #ffffff !important;
    border: 1px solid #1e7e34 !important;
    border-radius: 3px !important;
    padding: 0 12px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    font-weight: bold !important;
    height: 30px !important;
    line-height: 28px !important;
    box-sizing: border-box !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 5px !important;
    cursor: pointer !important;
}

.btn-mypay-print:hover {
    background-color: #218838 !important;
    color: #ffffff !important;
}

.mypay-btn-group {
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
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
    height: 30px !important;
    box-sizing: border-box !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    text-decoration: none !important;
    cursor: pointer !important;
}

.btn-mypay-exit:hover {
    background-color: #004466 !important;
    color: #ffffff !important;
}

.mypay-icon-exit {
    color: #f39c12 !important;
    font-size: 13px !important;
}

/* Master Table Styling */
.mypay-table-wrapper {
    width: 100% !important;
    overflow-x: auto !important;
    border: 1px solid #0073B5 !important;
    background: #ffffff !important;
}

.mypay-table {
    width: 100% !important;
    min-width: 1350px !important;
    border-collapse: collapse !important;
    border: none !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
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
    height: 36px !important;
    padding: 8px 12px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    border: 1px solid #0073B5 !important;
}

.mypay-table thead tr.header-row th {
    background-color: #f5f5f5 !important;
    color: #222222 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-weight: bold !important;
    font-size: 13px !important;
    text-align: center !important;
    height: 34px !important;
    padding: 8px 10px !important;
    border: 1px solid #e0e0e0 !important;
    white-space: nowrap !important;
}

.mypay-table tbody td {
    padding: 8px 10px !important;
    border: 1px solid #e0e0e0 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #333333 !important;
    text-align: center !important;
    background-color: #ffffff !important;
    height: 34px !important;
    vertical-align: middle !important;
}

.mypay-table tbody tr:hover td {
    background-color: #f8fbfe !important;
}

.mypay-table td.text-right {
    text-align: right !important;
    padding-right: 12px !important;
}

.mypay-table td.text-left {
    text-align: left !important;
    padding-left: 10px !important;
}

.mypay-table tfoot td {
    background-color: #f8fafc !important;
    border: 1px solid #e0e0e0 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    font-weight: bold !important;
    color: #1e293b !important;
    padding: 8px 10px !important;
    height: 36px !important;
    vertical-align: middle !important;
}

.mypay-bill-link {
    color: #0073B5 !important;
    font-weight: bold !important;
    text-decoration: none !important;
}

.mypay-bill-link:hover {
    color: #005b8a !important;
    text-decoration: underline !important;
}

.badge-status {
    display: inline-block !important;
    padding: 2px 8px !important;
    font-size: 11px !important;
    font-weight: bold !important;
    line-height: 1.2 !important;
    border-radius: 12px !important;
}

.badge-active {
    background-color: #e6f9ed !important;
    color: #1a7f37 !important;
    border: 1px solid #abefc6 !important;
}

.badge-processing {
    background-color: #fff8c5 !important;
    color: #9a6700 !important;
    border: 1px solid #d4a72c !important;
}

.badge-passive {
    background-color: #fbeae9 !important;
    color: #cf222e !important;
    border: 1px solid #f7c3c0 !important;
}

.btn-amend-action {
    background: #0073B5 !important;
    color: #ffffff !important;
    border: 1px solid #005b8a !important;
    border-radius: 3px !important;
    padding: 3px 10px !important;
    font-size: 11px !important;
    font-weight: bold !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 4px !important;
    cursor: pointer !important;
    text-decoration: none !important;
    transition: background 0.15s ease !important;
}

.btn-amend-action:hover {
    background: #005580 !important;
    color: #ffffff !important;
}

/* Modal Popup Styling */
.modal-header {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    padding: 12px 18px !important;
    border-radius: 5px 5px 0 0 !important;
}

.modal-header .modal-title {
    color: #ffffff !important;
    font-weight: bold !important;
    font-size: 14px !important;
    text-transform: uppercase !important;
    margin: 0 !important;
}

.modal-header .close {
    color: #ffffff !important;
    opacity: 0.85 !important;
    font-size: 22px !important;
    text-shadow: none !important;
}

.modal-header .close:hover {
    opacity: 1 !important;
}

.modal-content {
    border-radius: 6px !important;
    border: 1px solid #0073B5 !important;
    box-shadow: 0 4px 16px rgba(0, 115, 181, 0.2) !important;
}

.modal-footer {
    background-color: #f8fafc !important;
    padding: 10px 18px !important;
    border-top: 1px solid #e2e8f0 !important;
    border-radius: 0 0 5px 5px !important;
}

.btn-modal-submit {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    border: 1px solid #005b8a !important;
    border-radius: 3px !important;
    padding: 6px 18px !important;
    font-weight: bold !important;
    font-size: 12.5px !important;
    cursor: pointer !important;
}

.btn-modal-submit:hover {
    background-color: #005580 !important;
    color: #ffffff !important;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-5:+5",
        dateFormat: "dd/mm/yy"
    });

    $(".datepicker1").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-5:+5",
        dateFormat: "dd/mm/yy"
    });

    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+E", function() { 
            window.location.href = "<?php echo $home_path; ?>/dashboard.php";
        });
    }

    $('#searchTxt').on('keypress', function(e){
        if(e.which == 13){
            e.preventDefault();
            clkSubmit();
        }
    });
});

function clkSubmit() {
    var fromdate = $('#from_date').val() || '';
    var todate   = $('#to_date').val() || '';
    var val      = $('#searchTxt').val().trim();
    document.location.href = "gst_amendment.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&val=" + encodeURIComponent(val);
}

function srcSub(){
    document.location.href = "gst_amendment.php";
}

function selBadFeed(bl, bk, fr, to){
    $.ajax({
        type: 'GET',
        url: '../../action/selpopupViewgstInd.php',
        data: {
            bl: bl,
            bk: bk,
            fr: fr,
            to: to
        },
        success: function(data){
            $('#feedBk').html(data);
        }
    });	 
}

function printPage(){
    var divContents = $("#dvContainer").html();
    var printWindow = window.open('', '', 'height=600,width=1000');
    printWindow.document.write('<html><head><title>GST Amendments</title>');
    printWindow.document.write('<style>table {width:100%;border-collapse:collapse;font-family:Arial,sans-serif;font-size:12px;} th, td {border:1px solid #ccc;padding:6px;text-align:center;} th {background-color:#0073B5;color:#fff;} .text-right {text-align:right;} .text-left {text-align:left;} th.banner-row th {font-size:13px;}</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(divContents);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print(); 
}
</script>

<body class="bgBODY">

<div class="mypay-container">

    <!-- Top Action & Filter Bar Matching Master Style -->
    <div class="mypay-actions-bar">
        <div class="mypay-filter-group">
            <span class="mypay-filter-label">From:</span>
            <input name="from_date" type="text" class="mypay-date-input datepicker" id="from_date" value="<?php echo htmlspecialchars($displayFrom); ?>" placeholder="From Date" autocomplete="off" />
            
            <span class="mypay-filter-label" style="margin-left:4px;">To:</span>
            <input name="to_date" type="text" class="mypay-date-input datepicker1" id="to_date" value="<?php echo htmlspecialchars($displayTo); ?>" placeholder="To Date" autocomplete="off" />
            
            <input type="text" id="searchTxt" name="searchTxt" class="mypay-search-input" placeholder="Search Guest Name / Bill# / Book#" value="<?php if($valParam != '') { echo htmlspecialchars($valParam); } ?>" />
            
            <button type="button" class="btn-mypay-search" onclick="clkSubmit()" title="Display Records">
                <i class="fa fa-search"></i> <span>Display</span>
            </button>
            
            <?php if(($valParam != '') || ($frDateParam != '')) { ?>
                <button type="button" class="btn-mypay-reset" onclick="srcSub()" title="Clear Filter">
                    <i class="fa fa-times"></i> <span>Clear</span>
                </button>
            <?php } ?>

            <button type="button" class="btn-mypay-print" onclick="printPage()" title="Print View">
                <i class="fa fa-print"></i> <span>Print</span>
            </button>
        </div>

        <div class="mypay-btn-group">
            <a href="<?php echo $home_path; ?>/dashboard.php" class="btn-mypay-exit" id="exit" title="Exit (Ctrl+E)">
                <span class="mypay-icon-exit"><i class="fa fa-sign-out"></i></span>
                <span>Exit</span>
            </a>
        </div>
    </div>

    <!-- Data Table Container Matching Master Layout -->
    <div class="mypay-table-wrapper" id="dvContainer">
        <table class="mypay-table" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="banner-row">
                    <th colspan="14">
                        GST AMENDMENTS FROM <?php echo htmlspecialchars($displayFrom); ?> TO <?php echo htmlspecialchars($displayTo); ?>
                    </th>
                </tr>
                <tr class="header-row">
                    <th style="width: 3.5%;">Sl.no</th>
                    <th style="width: 7%;">Bill No</th>
                    <th style="width: 6.5%;">Booking Date</th>
                    <th style="width: 6.5%;">Bill Date</th>
                    <th style="width: 8%;">Venue</th>
                    <th style="width: 7%;">Session</th>
                    <th style="width: 8%;">Function</th>
                    <th style="width: 11%;">Guest Name</th>
                    <th style="width: 10%;">Address</th>
                    <th style="width: 7%;">City</th>
                    <th style="width: 8%;">GSTIN</th>
                    <th style="width: 7%;" class="text-right">Total Amount</th>
                    <th style="width: 5%;">Status</th>
                    <th style="width: 5.5%;">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $whereClause = " where bill_status != '3' ";
            if ($frm != '' && $tod != '') {
                $whereClause .= " AND str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' ";
            }

            if ($valParam != '') {
                $v = mysql_real_escape_string($valParam);
                $whereClause .= " AND (bill_no like '%$v%' OR bill_date like '%$v%' OR guest_name like '%$v%' OR bkno like '%$v%') ";
            }

            $sql = mysql_query("select distinct bill_no, bill_date, guest_name, fname, bkno, billamt, bill_status from bq_opbillhdr $whereClause group by bill_no order by RIGHT(bill_no, 5) ASC");
            
            $x = 0;
            $totalNetAmt = 0;

            if($sql && is_resource($sql) && mysql_num_rows($sql) > 0) {
                while($row = mysql_fetch_array($sql)) {
                    $x++;
                    $billNo = $row['bill_no'];
                    $slR_res = mysql_query("select * from bq_opbillhdr where bill_no='$billNo' AND bill_status != '3'");
                    $slR = ($slR_res && mysql_num_rows($slR_res) > 0) ? mysql_fetch_array($slR_res) : array();

                    $billStatus = isset($slR['bill_status']) ? $slR['bill_status'] : $row['bill_status'];
                    if($billStatus == '3'){
                        $statusBadge = '<span class="badge-status badge-passive">Cancelled</span>';
                    } else if($billStatus == '2'){
                        $statusBadge = '<span class="badge-status badge-active">Settled</span>';
                    } else if($billStatus == '1'){
                        $statusBadge = '<span class="badge-status badge-processing">Processing</span>';
                    } else {
                        $statusBadge = '<span class="badge-status">' . htmlspecialchars($billStatus) . '</span>';
                    }

                    $bAmt = (float)$row['billamt'];
                    $totalNetAmt += $bAmt;

                    $printUrl = ($billStatus == '3') 
                        ? $home_path . "/transaction/view/fob_duplicate_print_cancel.php?bilNo=" . urlencode($billNo) . "&sts=" . urlencode($billStatus)
                        : $home_path . "/transaction/view/bill_print_pdf.php?bilNo=" . urlencode($billNo) . "&sts=" . urlencode($billStatus) . "&type=D";
            ?>
                <tr>
                    <td><?php echo $x; ?></td>
                    <td>
                        <a href="<?php echo $printUrl; ?>" class="mypay-bill-link" title="Print Bill" target="_blank">
                            <?php echo htmlspecialchars(strtoupper($billNo)); ?>
                        </a>
                    </td>
                    <td><?php echo isset($slR['bkdate']) ? htmlspecialchars($slR['bkdate']) : ''; ?></td>
                    <td><?php echo htmlspecialchars($row['bill_date']); ?></td>
                    <td class="text-left"><?php echo isset($slR['venue']) ? htmlspecialchars(strtoupper($slR['venue'])) : ''; ?></td>
                    <td class="text-left"><?php echo isset($slR['session']) ? htmlspecialchars(strtoupper($slR['session'])) : ''; ?></td>
                    <td class="text-left"><?php echo isset($slR['funct']) ? htmlspecialchars(strtoupper($slR['funct'])) : ''; ?></td>
                    <td class="text-left"><?php echo isset($slR['fname']) ? htmlspecialchars(strtoupper($slR['fname'])) : (isset($row['guest_name']) ? htmlspecialchars(strtoupper($row['guest_name'])) : ''); ?></td>
                    <td class="text-left"><?php echo isset($slR['add1']) ? htmlspecialchars(strtoupper($slR['add1'])) : ''; ?></td>
                    <td class="text-left"><?php echo isset($slR['city']) ? htmlspecialchars(strtoupper($slR['city'])) : ''; ?></td>
                    <td class="text-left"><?php echo isset($slR['gst_no']) ? htmlspecialchars(strtoupper($slR['gst_no'])) : ''; ?></td>
                    <td class="text-right"><b><?php echo number_format($bAmt, 2); ?></b></td>
                    <td><?php echo $statusBadge; ?></td>
                    <td>
                        <button type="button" class="btn-amend-action" data-toggle="modal" data-target="#myModal" onClick="selBadFeed('<?php echo htmlspecialchars($row['bill_no']); ?>', '<?php echo htmlspecialchars($row['bkno']); ?>', '<?php echo htmlspecialchars($displayFrom); ?>', '<?php echo htmlspecialchars($displayTo); ?>');" title="GST Amend">
                            <i class="fa fa-pencil-square-o"></i> Amend
                        </button>
                    </td>
                </tr>
            <?php 
                } 
            } else { 
            ?>
                <tr>
                    <td colspan="14" style="padding: 24px 10px !important; color: #777777; text-align: center; font-size: 13px;">
                        No GST Amendment records found for the selected criteria
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            <?php if($x > 0) { ?>
            <tfoot>
                <tr>
                    <td colspan="11" class="text-right" style="font-weight:bold;text-transform:uppercase;color:#1e293b;">
                        Total Amount:
                    </td>
                    <td class="text-right" style="font-weight:bold;color:#0073B5;font-size:13px;">
                        <?php echo number_format($totalNetAmt, 2); ?>
                    </td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
            <?php } ?>
        </table>
    </div>

</div>

<!-- Modal Dialog For GST Amendment -->
<form id="taxTypes" name="taxTypes" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_bqtgstInsert.php" method="post">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="max-width: 520px; margin: 30px auto;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">GST Amendment Details</h4>
                </div>
                <div class="modal-body" style="padding: 15px 20px;">
                    <table style="width:100%;border-collapse:separate;border-spacing:0 8px;">
                        <tbody id="feedBk">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-modal-submit">
                        <i class="fa fa-floppy-o"></i> Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php include("../../footer.php"); ?>
</body>
</html>
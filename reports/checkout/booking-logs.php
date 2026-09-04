<?php
error_reporting(0);
ob_start();
include("../../config.php");
include("../../header.php");

$sqlAC = mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC = mysql_fetch_array($sqlAC);
$adtCurDt = trim($rowAC['cur_date']);

// Filter inputs
$frDateParam = isset($_GET['fromdate']) ? trim($_GET['fromdate']) : '';
$toDateParam = isset($_GET['todate']) ? trim($_GET['todate']) : '';
$stsParam    = isset($_GET['sts']) ? trim($_GET['sts']) : 'all';
$valParam    = isset($_GET['val']) ? trim($_GET['val']) : '';

// Default dates if empty
$displayFrom = ($frDateParam != '') ? $frDateParam : ($adtCurDt ? $adtCurDt : date('d/m/Y'));
$displayTo   = ($toDateParam != '') ? $toDateParam : ($adtCurDt ? $adtCurDt : date('d/m/Y'));

// Pagination parameters
$limit = isset($_GET['limit']) && is_numeric($_GET['limit']) ? (int)$_GET['limit'] : 25;
if (!in_array($limit, [10, 25, 50, 100, 500])) {
    $limit = 25;
}

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}

// Construct WHERE clause
$where = " where 1=1 ";
if ($displayFrom != '' && $displayTo != '') {
    $fr = explode('/', $displayFrom);
    $to = explode('/', $displayTo);
    if (count($fr) == 3 && count($to) == 3) {
        $frm = $fr[2] . '-' . $fr[1] . '-' . $fr[0];
        $tod = $to[2] . '-' . $to[1] . '-' . $to[0];
        $where .= " AND str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' ";
    }
}

if ($stsParam != '' && $stsParam != 'all') {
    $s = mysql_real_escape_string($stsParam);
    $where .= " AND confirm_status = '$s' ";
}

if ($valParam != '') {
    $v = mysql_real_escape_string($valParam);
    $where .= " AND (booking_no like '%$v%' OR guest_name like '%$v%' OR venue like '%$v%' OR book_date like '%$v%' OR phone like '%$v%' OR funct like '%$v%' OR company_name like '%$v%') ";
}

// Count total matching records and total pax
$countSql = mysql_query("select count(*) as total, sum(guaranted) as sum_pax from (select booking_no, venue, guaranted from bq_hallbooking $where group by booking_no, venue) as t");
$countRow = mysql_fetch_array($countSql);
$totalRecords = $countRow['total'] ? (int)$countRow['total'] : 0;
$totalPaxOverall = $countRow['sum_pax'] ? (int)$countRow['sum_pax'] : 0;

$totalPages = ceil($totalRecords / $limit);
if ($totalPages < 1) {
    $totalPages = 1;
}
if ($page > $totalPages) {
    $page = $totalPages;
}

$offset = ($page - 1) * $limit;
$startRecord = ($totalRecords > 0) ? ($offset + 1) : 0;
$endRecord = min($offset + $limit, $totalRecords);

// Helper for pagination links
function getPageUrl($p, $frDateParam, $toDateParam, $stsParam, $valParam, $limit) {
    return "booking-logs.php?fromdate=" . urlencode($frDateParam) . "&todate=" . urlencode($toDateParam) . "&sts=" . urlencode($stsParam) . "&val=" . urlencode($valParam) . "&limit=" . $limit . "&page=" . $p;
}

// Status definitions from bq_stscolor
$sqlRv = mysql_query("select * from bq_stscolor where roomoccupy_id='1'");
$rowRv = mysql_fetch_array($sqlRv); 
$sqlRd = mysql_query("select * from bq_stscolor where roomoccupy_id='2'");
$rowRd = mysql_fetch_array($sqlRd);
$sqlRo = mysql_query("select * from bq_stscolor where roomoccupy_id='3'");
$rowRo = mysql_fetch_array($sqlRo); 
$sqlRg = mysql_query("select * from bq_stscolor where roomoccupy_id='4'");
$rowRg = mysql_fetch_array($sqlRg);
$sqlRm = mysql_query("select * from bq_stscolor where roomoccupy_id='5'");
$rowRm = mysql_fetch_array($sqlRm);
$sqlRe = mysql_query("select * from bq_stscolor where roomoccupy_id='6'");
$rowbl = mysql_fetch_array($sqlRe);
?>
<link rel="stylesheet" href="<?php echo $home_path;?>/css/mypay-master.css">
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<script src="../../js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo $home_path; ?>/js/shortcut.js"></script>

<style type="text/css">
/* ==========================================================================
   Master Pages Style - Standardized Unified Banquet (MyPay) Design System
   ========================================================================== */
body, body.bgBODY {
    background-color: #ffffff !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    margin: 0 !important;
    padding: 0 !important;
}

.mypay-container {
    width: 98% !important;
    max-width: 100% !important;
    margin: 15px auto 40px auto !important;
    padding: 0 !important;
}

/* Action Bar above List View */
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

.mypay-select {
    height: 30px !important;
    line-height: 28px !important;
    padding: 0 8px !important;
    border: 1px solid #0073B5 !important;
    border-radius: 4px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #333333 !important;
    background: #ffffff !important;
    box-sizing: border-box !important;
    outline: none !important;
    min-width: 120px !important;
}

.mypay-select:focus {
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
    transition: border-color 0.15s ease-in-out !important;
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
    transition: background-color 0.15s ease-in-out !important;
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
    transition: background-color 0.15s ease-in-out !important;
}

.btn-mypay-reset:hover {
    background-color: #5a6268 !important;
    color: #ffffff !important;
}

.btn-mypay-excel {
    background-color: #107c41 !important;
    color: #ffffff !important;
    border: 1px solid #0b5a2e !important;
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
    text-decoration: none !important;
    transition: background-color 0.15s ease-in-out !important;
}

.btn-mypay-excel:hover {
    background-color: #0b5a2e !important;
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
    transition: background-color 0.15s ease-in-out !important;
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

/* Scroll Container for Wide Tables */
.mypay-table-wrapper {
    width: 100% !important;
    overflow-x: auto !important;
    border: 1px solid #0073B5 !important;
    background: #ffffff !important;
}

/* Master-style View Data Table */
.mypay-table {
    width: 100% !important;
    min-width: 1650px !important;
    border-collapse: collapse !important;
    border: none !important;
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
    height: 36px !important;
    padding: 8px 12px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    border: 1px solid #0073B5 !important;
    vertical-align: middle !important;
}

.mypay-table thead tr.header-row th {
    background-color: #f5f5f5 !important;
    color: #222222 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-weight: bold !important;
    font-size: 12px !important;
    text-align: center !important;
    height: 32px !important;
    padding: 6px 8px !important;
    border: 1px solid #e0e0e0 !important;
    vertical-align: middle !important;
    white-space: nowrap !important;
}

.mypay-table tbody td {
    padding: 6px 8px !important;
    border: 1px solid #e0e0e0 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    color: #333333 !important;
    text-align: center !important;
    background-color: #ffffff !important;
    height: 30px !important;
    vertical-align: middle !important;
}

.mypay-table tbody tr:hover td {
    background-color: #f8fbfe !important;
}

/* Master Status Badge Styling */
.badge-status {
    display: inline-block !important;
    padding: 2px 8px !important;
    font-size: 11px !important;
    font-weight: bold !important;
    line-height: 1.2 !important;
    border-radius: 12px !important;
    text-align: center !important;
    letter-spacing: 0.3px !important;
    white-space: nowrap !important;
}

.badge-active {
    background-color: #e6f9ed !important;
    color: #1a7f37 !important;
    border: 1px solid #abefc6 !important;
}

.badge-passive, .badge-deactive {
    background-color: #fbeae9 !important;
    color: #cf222e !important;
    border: 1px solid #f7c3c0 !important;
}

.badge-processing {
    background-color: #fef7e0 !important;
    color: #b06000 !important;
    border: 1px solid #fce8b2 !important;
}

/* Alignment Helpers */
.mypay-table td.text-right, .mypay-table th.text-right {
    text-align: right !important;
    padding-right: 10px !important;
}

.mypay-table td.text-left, .mypay-table th.text-left {
    text-align: left !important;
    padding-left: 10px !important;
}

/* Page Totals Row */
.mypay-table tfoot tr.totals-row td {
    background-color: #f8fafc !important;
    font-weight: bold !important;
    color: #0f172a !important;
    border-top: 2px solid #0073B5 !important;
    font-size: 12px !important;
    height: 34px !important;
}

/* Standardized Pagination Styling */
.mypay-pagination-bar {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-top: 15px !important;
    padding: 8px 4px !important;
    flex-wrap: wrap !important;
    gap: 10px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
}

.mypay-page-info {
    color: #555555 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
}

.mypay-page-select {
    height: 28px !important;
    padding: 2px 6px !important;
    border: 1px solid #c0c8d0 !important;
    border-radius: 3px !important;
    font-size: 12px !important;
    background: #ffffff !important;
    color: #333333 !important;
    cursor: pointer !important;
    outline: none !important;
}

.mypay-page-select:focus {
    border-color: #0084b4 !important;
}

.mypay-pagination {
    display: inline-flex !important;
    align-items: center !important;
    gap: 3px !important;
    list-style: none !important;
    margin: 0 !important;
    padding: 0 !important;
}

.mypay-page-link {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-width: 28px !important;
    height: 28px !important;
    padding: 0 6px !important;
    border: 1px solid #d0d7de !important;
    border-radius: 3px !important;
    background-color: #ffffff !important;
    color: #0073B5 !important;
    text-decoration: none !important;
    font-size: 12px !important;
    font-weight: bold !important;
    cursor: pointer !important;
    transition: all 0.15s ease !important;
    box-sizing: border-box !important;
}

.mypay-page-link:hover:not(.disabled):not(.active) {
    background-color: #f0f4f8 !important;
    border-color: #0073B5 !important;
    color: #005b8a !important;
    text-decoration: none !important;
}

.mypay-page-link.active {
    background-color: #0073B5 !important;
    border-color: #005b8a !important;
    color: #ffffff !important;
    cursor: default !important;
    text-decoration: none !important;
}

.mypay-page-link.disabled {
    background-color: #f6f8fa !important;
    border-color: #e1e4e8 !important;
    color: #adb5bd !important;
    cursor: not-allowed !important;
    text-decoration: none !important;
}
</style>

<script>
jQuery(document).ready(function(){
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+5",
        dateFormat: "dd/mm/yy"
    });

    $(".datepicker1").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+5",
        dateFormat: "dd/mm/yy"
    });
    
    $("#msgFo").fadeOut(5000);

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
    var todate = $('#to_date').val() || '';
    var sts = $('#confirm_status').val() || 'all';
    var srtx = $('#searchTxt').val().trim();
    var limit = $('#limitSelect').val() || '25';
    document.location = "booking-logs.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&sts=" + encodeURIComponent(sts) + "&val=" + encodeURIComponent(srtx) + "&limit=" + encodeURIComponent(limit) + "&page=1";
}

function changeLimit(lim) {
    var fromdate = $('#from_date').val() || '';
    var todate = $('#to_date').val() || '';
    var sts = $('#confirm_status').val() || 'all';
    var srtx = $('#searchTxt').val().trim();
    document.location = "booking-logs.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&sts=" + encodeURIComponent(sts) + "&val=" + encodeURIComponent(srtx) + "&limit=" + encodeURIComponent(lim) + "&page=1";
}

function srcSub(){
    document.location = "booking-logs.php";
}

function printPage(){
    var divContents = $("#dvContainer").html();
    var printWindow = window.open('', '', 'height=600,width=950');
    printWindow.document.write('<html><head><title>Booking Status Report</title>');
    printWindow.document.write('<style>table {width:100%;border-collapse:collapse;font-family:Arial,sans-serif;font-size:11px;} th, td {border:1px solid #ccc;padding:5px;text-align:center;} th {background-color:#0073B5;color:#fff;} .text-right {text-align:right;} .text-left {text-align:left;} th.banner-row th {font-size:13px;}</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(divContents);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print(); 
}
</script>

<body class="bgBODY">

<div class="mypay-container">

    <?php if(isset($_GET['msg'])){ ?>
        <p style="text-align:center;margin:10px 0;">
            <label id="msgFo" style="color:#7B0E0E;font-weight:bold;font-size:13px;"><?php echo htmlspecialchars($_GET['msg']); ?></label>
        </p>
    <?php } ?>

    <!-- Top Action & Search Bar Matching Master Style -->
    <div class="mypay-actions-bar">
        <div class="mypay-filter-group">
            <span class="mypay-filter-label">From:</span>
            <input name="from_date" type="text" class="mypay-date-input datepicker" id="from_date" value="<?php echo htmlspecialchars($displayFrom); ?>" placeholder="From Date" autocomplete="off" />
            
            <span class="mypay-filter-label" style="margin-left:4px;">To:</span>
            <input name="to_date" type="text" class="mypay-date-input datepicker1" id="to_date" value="<?php echo htmlspecialchars($displayTo); ?>" placeholder="To Date" autocomplete="off" />
            
            <span class="mypay-filter-label" style="margin-left:4px;">Status:</span>
            <select name="sts" id="confirm_status" class="mypay-select">
                <option value="all" <?php echo ($stsParam == 'all' || empty($stsParam)) ? 'selected' : ''; ?>>All Statuses</option>
                <?php 
                $sqlBS = mysql_query("select distinct room_availability, roomavail_define from bq_stscolor where roomavail_define!='1'");
                if($sqlBS) {
                    while($rowBS = mysql_fetch_array($sqlBS)) {
                        $sel = ($rowBS['roomavail_define'] == $stsParam) ? 'selected' : '';
                        echo '<option value="'.htmlspecialchars($rowBS['roomavail_define']).'" '.$sel.'>'.htmlspecialchars($rowBS['room_availability']).'</option>';
                    }
                }
                ?>
                <option value="7" <?php echo ($stsParam == '7') ? 'selected' : ''; ?>>CANCELLED</option>
            </select>

            <input type="text" id="searchTxt" name="searchTxt" class="mypay-search-input" placeholder="Search Booking#/Name/Venue/Phone..." value="<?php if($valParam != '') { echo htmlspecialchars($valParam); } ?>" />
            
            <button type="button" name="submt" id="submt" class="btn-mypay-search" onclick="clkSubmit()" title="Display Records">
                <i class="fa fa-search"></i> <span>Display</span>
            </button>
            
            <?php if(($valParam != '') || ($frDateParam != '') || ($stsParam != 'all')) { ?>
                <button type="button" class="btn-mypay-reset" onclick="srcSub()" title="Clear Filter">
                    <i class="fa fa-times"></i> <span>Clear</span>
                </button>
            <?php } ?>

            <a href="<?php echo $home_path ?>/reports/checkout/xt_booking_logs.php?fromdate=<?php echo urlencode($displayFrom); ?>&todate=<?php echo urlencode($displayTo); ?>&sts=<?php echo urlencode($stsParam); ?>" class="btn-mypay-excel" title="Export to Excel">
                <i class="fa fa-file-excel-o"></i> <span>Export</span>
            </a>

            <button type="button" class="btn-mypay-print" onclick="printPage()" title="Print Current View">
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
                    <th colspan="19">BOOKING STATUS & LOGS</th>
                </tr>
                <tr class="header-row">
                    <th style="width: 3%;">Sl.no</th>
                    <th style="width: 5.5%;">Booking#</th>
                    <th style="width: 5.5%;">Fn Date</th>
                    <th style="width: 10%;">Guest Name</th>
                    <th style="width: 7.5%;">Venue</th>
                    <th style="width: 6%;">Session</th>
                    <th style="width: 4%;">From</th>
                    <th style="width: 4%;">To</th>
                    <th style="width: 3.5%;" class="text-right">Pax</th>
                    <th style="width: 7.5%;">Function</th>
                    <th style="width: 6.5%;">Phone</th>
                    <th style="width: 7%;">Email</th>
                    <th style="width: 8%;">Company</th>
                    <th style="width: 7%;">Booked by</th>
                    <th style="width: 6.5%;">Booker no</th>
                    <th style="width: 5.5%;" class="text-right">Adv</th>
                    <th style="width: 5%;">Receipt no</th>
                    <th style="width: 5%;">Pay mode</th>
                    <th style="width: 5.5%;">Status</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            // Paginated query
            $sql = mysql_query("select * from bq_hallbooking $where group by booking_no, venue order by str_to_date(book_date,'%d/%m/%Y') ASC, booking_no ASC LIMIT $offset, $limit");
            $x = $offset;

            $pagePax = 0;
            $pageAdv = 0;

            if($sql && is_resource($sql) && mysql_num_rows($sql) > 0) {
                while($row = mysql_fetch_array($sql)) {
                    $x++;

                    // Advance amount & receipt details
                    $sqlR = mysql_query("select sum(amount) as advAmt, receipt_no, pay_mode, booking_no from bq_hallresvadv where booking_no='".$row['booking_no']."' AND status='1' AND hallbook_id='".$row['hallbook_id']."' group by booking_no");
                    $rowR = mysql_fetch_array($sqlR);
                    $advAmt = !empty($rowR['advAmt']) ? (float)$rowR['advAmt'] : 0.00;
                    $receiptNo = !empty($rowR['receipt_no']) ? $rowR['receipt_no'] : '-';
                    $payMode = !empty($rowR['pay_mode']) ? ucfirst($rowR['pay_mode']) : '-';

                    $paxVal = (int)$row['guaranted'];
                    $pagePax += $paxVal;
                    $pageAdv += $advAmt;

                    // Status Badge matching Master View styling
                    if($row['confirm_status'] == 1) {
                        $rmAVai = !empty($rowRv['room_availability']) ? $rowRv['room_availability'] : 'AVAILABLE';
                        $statusBadge = '<span class="badge-status badge-processing">'.htmlspecialchars(strtoupper($rmAVai)).'</span>';
                    } else if($row['confirm_status'] == 2) {
                        $rmAVai = !empty($rowRd['room_availability']) ? $rowRd['room_availability'] : 'CONFIRMED';
                        $statusBadge = '<span class="badge-status badge-active">'.htmlspecialchars(strtoupper($rmAVai)).'</span>';
                    } else if($row['confirm_status'] == 3) {
                        $rmAVai = !empty($rowRo['room_availability']) ? $rowRo['room_availability'] : 'PROVISIONAL';
                        $statusBadge = '<span class="badge-status badge-processing">'.htmlspecialchars(strtoupper($rmAVai)).'</span>';
                    } else if($row['confirm_status'] == 4) {
                        $rmAVai = !empty($rowRg['room_availability']) ? $rowRg['room_availability'] : 'HOLD';
                        $statusBadge = '<span class="badge-status badge-processing">'.htmlspecialchars(strtoupper($rmAVai)).'</span>';
                    } else if($row['confirm_status'] == 5) {
                        $rmAVai = !empty($rowRm['room_availability']) ? $rowRm['room_availability'] : 'MAINTENANCE';
                        $statusBadge = '<span class="badge-status badge-processing">'.htmlspecialchars(strtoupper($rmAVai)).'</span>';
                    } else if($row['confirm_status'] == 6) {
                        $rmAVai = !empty($rowbl['room_availability']) ? $rowbl['room_availability'] : 'BILLED';
                        $statusBadge = '<span class="badge-status badge-active">'.htmlspecialchars(strtoupper($rmAVai)).'</span>';
                    } else if($row['confirm_status'] == 7) {
                        $statusBadge = '<span class="badge-status badge-passive">CANCELLED</span>';
                    } else {
                        $statusBadge = '<span class="badge-status badge-processing">UNKNOWN</span>';
                    }
            ?>
                <tr>
                    <td><?php echo $x; ?></td>
                    <td><b><?php echo htmlspecialchars(strtoupper($row['booking_no'])); ?></b></td>
                    <td><?php echo htmlspecialchars($row['book_date']); ?></td>
                    <td class="text-left"><b><?php echo htmlspecialchars(strtoupper($row['guest_name'])); ?></b></td>
                    <td class="text-left"><?php echo htmlspecialchars(strtoupper($row['venue'])); ?></td>
                    <td class="text-left"><?php echo htmlspecialchars(strtoupper($row['session'])); ?></td>
                    <td><?php echo htmlspecialchars($row['from_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['to_time']); ?></td>
                    <td class="text-right"><?php echo htmlspecialchars($row['guaranted']); ?></td>
                    <td class="text-left"><?php echo htmlspecialchars(strtoupper($row['funct'])); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td class="text-left"><?php echo htmlspecialchars($row['email']); ?></td>
                    <td class="text-left"><?php echo htmlspecialchars(strtoupper($row['company_name'])); ?></td>
                    <td class="text-left"><?php echo htmlspecialchars(strtoupper($row['contact_person'])); ?></td>
                    <td><?php echo htmlspecialchars($row['contact_mobile']); ?></td>
                    <td class="text-right"><?php echo ($advAmt > 0) ? number_format($advAmt, 2) : '0.00'; ?></td>
                    <td><?php echo htmlspecialchars($receiptNo); ?></td>
                    <td><?php echo htmlspecialchars($payMode); ?></td>
                    <td><?php echo $statusBadge; ?></td>
                </tr>
            <?php 
                } 
            } else { 
            ?>
                <tr>
                    <td colspan="19" style="padding: 20px 10px !important; color: #777777; text-align: center; font-size: 13px;">
                        No Booking records found for the selected criteria
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            <?php if($totalRecords > 0) { ?>
            <tfoot>
                <tr class="totals-row">
                    <td colspan="8" class="text-right"><b>PAGE TOTAL:</b></td>
                    <td class="text-right"><b><?php echo number_format($pagePax); ?></b></td>
                    <td colspan="6" class="text-right"></td>
                    <td class="text-right"><b><?php echo number_format($pageAdv, 2); ?></b></td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
            <?php } ?>
        </table>
    </div>

    <!-- Pagination Controls Bar -->
    <div class="mypay-pagination-bar">
        <div class="mypay-page-info">
            <span>Showing <b><?php echo $startRecord; ?></b> to <b><?php echo $endRecord; ?></b> of <b><?php echo $totalRecords; ?></b> entries</span>
            <span>&bull;</span>
            <span>Show:</span>
            <select id="limitSelect" class="mypay-page-select" onchange="changeLimit(this.value);">
                <option value="10" <?php if($limit == 10) echo 'selected'; ?>>10</option>
                <option value="25" <?php if($limit == 25) echo 'selected'; ?>>25</option>
                <option value="50" <?php if($limit == 50) echo 'selected'; ?>>50</option>
                <option value="100" <?php if($limit == 100) echo 'selected'; ?>>100</option>
                <option value="500" <?php if($limit == 500) echo 'selected'; ?>>500</option>
            </select>
            <span>entries</span>
        </div>

        <div class="mypay-pagination">
            <!-- First & Prev -->
            <?php if ($page > 1) { ?>
                <a href="<?php echo getPageUrl(1, $frDateParam, $toDateParam, $stsParam, $valParam, $limit); ?>" class="mypay-page-link" title="First Page">&laquo;</a>
                <a href="<?php echo getPageUrl($page - 1, $frDateParam, $toDateParam, $stsParam, $valParam, $limit); ?>" class="mypay-page-link" title="Previous Page">&lsaquo;</a>
            <?php } else { ?>
                <span class="mypay-page-link disabled">&laquo;</span>
                <span class="mypay-page-link disabled">&lsaquo;</span>
            <?php } ?>

            <!-- Page Number Links -->
            <?php
            $startPage = max(1, $page - 2);
            $endPage = min($totalPages, $page + 2);

            if ($startPage > 1) {
                echo '<a href="' . getPageUrl(1, $frDateParam, $toDateParam, $stsParam, $valParam, $limit) . '" class="mypay-page-link">1</a>';
                if ($startPage > 2) {
                    echo '<span class="mypay-page-link disabled" style="cursor:default;">...</span>';
                }
            }

            for ($p = $startPage; $p <= $endPage; $p++) {
                if ($p == $page) {
                    echo '<span class="mypay-page-link active">' . $p . '</span>';
                } else {
                    echo '<a href="' . getPageUrl($p, $frDateParam, $toDateParam, $stsParam, $valParam, $limit) . '" class="mypay-page-link">' . $p . '</a>';
                }
            }

            if ($endPage < $totalPages) {
                if ($endPage < $totalPages - 1) {
                    echo '<span class="mypay-page-link disabled" style="cursor:default;">...</span>';
                }
                echo '<a href="' . getPageUrl($totalPages, $frDateParam, $toDateParam, $stsParam, $valParam, $limit) . '" class="mypay-page-link">' . $totalPages . '</a>';
            }
            ?>

            <!-- Next & Last -->
            <?php if ($page < $totalPages) { ?>
                <a href="<?php echo getPageUrl($page + 1, $frDateParam, $toDateParam, $stsParam, $valParam, $limit); ?>" class="mypay-page-link" title="Next Page">&rsaquo;</a>
                <a href="<?php echo getPageUrl($totalPages, $frDateParam, $toDateParam, $stsParam, $valParam, $limit); ?>" class="mypay-page-link" title="Last Page">&raquo;</a>
            <?php } else { ?>
                <span class="mypay-page-link disabled">&rsaquo;</span>
                <span class="mypay-page-link disabled">&raquo;</span>
            <?php } ?>
        </div>
    </div>

</div>

<?php include("../../footer.php"); ?>
</body>
</html>
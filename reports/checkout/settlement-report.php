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
$venueParam  = isset($_GET['ven']) ? trim($_GET['ven']) : 'all';
$valParam    = isset($_GET['val']) ? trim($_GET['val']) : '';

// Default dates if empty
$displayFrom = ($frDateParam != '') ? $frDateParam : ($adtCurDt ? $adtCurDt : date('d/m/Y'));
$displayTo   = ($toDateParam != '') ? $toDateParam : ($adtCurDt ? $adtCurDt : date('d/m/Y'));

// Property definition for Print Header
$sqlPd = mysql_query("select * from property_definition where propdef_id='1'");
$rowPd = mysql_fetch_array($sqlPd);
$prop_name = !empty($rowPd['prop_name']) ? $rowPd['prop_name'] : 'MY BANQUET';
$city = !empty($rowPd['city']) ? $rowPd['city'] : '';

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
        $where .= " AND str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' ";
    }
}

if ($venueParam != '' && $venueParam != 'all') {
    $vEsc = mysql_real_escape_string($venueParam);
    $where .= " AND venue = '$vEsc' ";
}

if ($valParam != '') {
    $v = mysql_real_escape_string($valParam);
    $where .= " AND (bill_no like '%$v%' OR fname like '%$v%' OR bkno like '%$v%' OR venue like '%$v%') ";
}

// Count total matching records
$countSql = mysql_query("select count(*) as total from bq_opbillhdr $where");
$countRow = mysql_fetch_array($countSql);
$totalRecords = $countRow['total'] ? (int)$countRow['total'] : 0;

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

// Total column count for banner row
$colSpanTotal = 22;

// Helper for pagination links
function getPageUrl($p, $frDateParam, $toDateParam, $venueParam, $valParam, $limit) {
    return "settlement-report.php?fromdate=" . urlencode($frDateParam) . "&todate=" . urlencode($toDateParam) . "&ven=" . urlencode($venueParam) . "&val=" . urlencode($valParam) . "&limit=" . $limit . "&page=" . $p;
}
?>
<link rel="stylesheet" href="<?php echo $home_path;?>/css/mypay-master.css">
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<script src="../../js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo $home_path; ?>/js/shortcut.js"></script>

<style type="text/css">
/* ==========================================================================
   Master Pages Style - Standardized Unified Settlement Report (MyPay)
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
    min-width: 140px !important;
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
    min-width: 1850px !important;
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

.mypay-table tbody tr.row-cancelled td {
    color: #cf222e !important;
}

.bill-link {
    color: #0073B5 !important;
    font-weight: bold !important;
    cursor: pointer !important;
    text-decoration: none !important;
}

.bill-link:hover {
    text-decoration: underline !important;
    color: #005580 !important;
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
    var ven = $('#venue').val() || 'all';
    var srtx = $('#searchTxt').val().trim();
    var limit = $('#limitSelect').val() || '25';
    document.location = "settlement-report.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&ven=" + encodeURIComponent(ven) + "&val=" + encodeURIComponent(srtx) + "&limit=" + encodeURIComponent(limit) + "&page=1";
}

function changeLimit(lim) {
    var fromdate = $('#from_date').val() || '';
    var todate = $('#to_date').val() || '';
    var ven = $('#venue').val() || 'all';
    var srtx = $('#searchTxt').val().trim();
    document.location = "settlement-report.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&ven=" + encodeURIComponent(ven) + "&val=" + encodeURIComponent(srtx) + "&limit=" + encodeURIComponent(lim) + "&page=1";
}

function srcSub(){
    document.location = "settlement-report.php";
}

function selRefNo(vl, ot){
    var printUrl = '<?php echo $home_path; ?>/transaction/view/print-bqt-billing.php?blN=' + encodeURIComponent(vl) + '&vucNo=' + encodeURIComponent(ot);
    var newwindow = window.open(printUrl, "_blank", 'scrollbars=1,menubar=0,resizable=1,width=1000,height=700');
    if (newwindow) {
        newwindow.focus();
    }
}

function printPage(){
    var divContents = $("#dvContainer").html();
    var printWindow = window.open('', '', 'height=600,width=950');
    printWindow.document.write('<html><head><title>Settlement Report</title>');
    printWindow.document.write('<style>table {width:100%;border-collapse:collapse;font-family:Arial,sans-serif;font-size:11px;} th, td {border:1px solid #ccc;padding:5px;text-align:center;} th {background-color:#0073B5;color:#fff;} .text-right {text-align:right;} .text-left {text-align:left;} th.banner-row th {font-size:13px;}</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h3 style="text-align:center;font-family:Arial;margin-bottom:5px;"><?php echo htmlspecialchars($prop_name); ?><?php echo !empty($city) ? ", ".htmlspecialchars($city) : ""; ?></h3>');
    printWindow.document.write('<h4 style="text-align:center;font-family:Arial;margin-top:0;margin-bottom:10px;">SETTLEMENT REPORT (<?php echo htmlspecialchars($displayFrom); ?> to <?php echo htmlspecialchars($displayTo); ?>)</h4>');
    printWindow.document.write(divContents);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print(); 
}
</script>

<body class="bgBODY">

<div class="mypay-container">

    <!-- Top Action & Search Bar Matching Master Style -->
    <div class="mypay-actions-bar">
        <div class="mypay-filter-group">
            <span class="mypay-filter-label">From:</span>
            <input name="from_date" type="text" class="mypay-date-input datepicker" id="from_date" value="<?php echo htmlspecialchars($displayFrom); ?>" placeholder="From Date" autocomplete="off" />
            
            <span class="mypay-filter-label" style="margin-left:4px;">To:</span>
            <input name="to_date" type="text" class="mypay-date-input datepicker1" id="to_date" value="<?php echo htmlspecialchars($displayTo); ?>" placeholder="To Date" autocomplete="off" />
            
            <span class="mypay-filter-label" style="margin-left:4px;">Venue:</span>
            <select name="venue" id="venue" class="mypay-select">
                <option value="all" <?php echo ($venueParam == 'all' || empty($venueParam)) ? 'selected' : ''; ?>>All Venues</option>
                <?php 
                $sqlBS = mysql_query("select distinct venue_code, venue_desc from bq_venue where status='1' order by venue_desc ASC");
                if ($sqlBS) {
                    while ($rowBS = mysql_fetch_array($sqlBS)) {
                        $sel = ($rowBS['venue_code'] == $venueParam) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($rowBS['venue_code']) . '" ' . $sel . '>' . htmlspecialchars($rowBS['venue_desc']) . '</option>';
                    }
                }
                ?>
            </select>

            <input type="text" id="searchTxt" name="searchTxt" class="mypay-search-input" placeholder="Search Bill# / Guest / Venue..." value="<?php if($valParam != '') { echo htmlspecialchars($valParam); } ?>" />
            
            <button type="button" name="submt" id="submt" class="btn-mypay-search" onclick="clkSubmit()" title="Display Records">
                <i class="fa fa-search"></i> <span>Display</span>
            </button>
            
            <?php if(($valParam != '') || ($frDateParam != '') || ($venueParam != 'all')) { ?>
                <button type="button" class="btn-mypay-reset" onclick="srcSub()" title="Clear Filter">
                    <i class="fa fa-times"></i> <span>Clear</span>
                </button>
            <?php } ?>

            <a href="<?php echo $home_path ?>/reports/checkout/xt_settlement_report_xls.php?fromdate=<?php echo urlencode($displayFrom); ?>&todate=<?php echo urlencode($displayTo); ?>&ven=<?php echo urlencode($venueParam); ?>" class="btn-mypay-excel" title="Export to Excel">
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
                    <th colspan="<?php echo $colSpanTotal; ?>">BANQUET SETTLEMENT REPORT</th>
                </tr>
                <tr class="header-row">
                    <th style="width: 3%;">Sl.no</th>
                    <th style="width: 5.5%;">Bill#</th>
                    <th style="width: 5%;">Bill Date</th>
                    <th style="width: 9%;">Guest / Company</th>
                    <th style="width: 6.5%;">Venue</th>
                    <th style="width: 6%;">Function</th>
                    <th style="width: 3.5%;" class="text-right">Pax</th>
                    <th style="width: 5.5%;" class="text-right">Bill Amt</th>
                    <th style="width: 5%;" class="text-right">Advance</th>
                    <th style="width: 4.5%;" class="text-right">Cash</th>
                    <th style="width: 4.5%;" class="text-right">Card</th>
                    <th style="width: 4.5%;" class="text-right">Company</th>
                    <th style="width: 4.5%;" class="text-right">UPI</th>
                    <th style="width: 4.5%;" class="text-right">Cheque</th>
                    <th style="width: 4.5%;" class="text-right">NEFT</th>
                    <th style="width: 4%;" class="text-right">Room</th>
                    <th style="width: 4%;" class="text-right">Refund</th>
                    <th style="width: 5%;">Card Desc</th>
                    <th style="width: 4.5%;">CC No</th>
                    <th style="width: 5.5%;">Company Name</th>
                    <th style="width: 6%;">Remarks</th>
                    <th style="width: 5.5%;">Settled by</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            // Paginated query
            $sql = mysql_query("select * from bq_opbillhdr $where order by opbillhdr_id ASC LIMIT $offset, $limit");
            $x = $offset;

            // Page total accumulators
            $pagePax = 0;
            $pageBillAmt = 0;
            $pageAdvAmt = 0;
            $pageCash = 0;
            $pageCard = 0;
            $pageCompany = 0;
            $pageUPI = 0;
            $pageCheque = 0;
            $pageNeft = 0;
            $pageRoom = 0;
            $pageRefund = 0;

            if ($sql && is_resource($sql) && mysql_num_rows($sql) > 0) {
                while ($row = mysql_fetch_array($sql)) {
                    $x++;

                    $isCancelled = ($row['bill_status'] == '3');
                    $rowClass = $isCancelled ? 'row-cancelled' : '';

                    // Venue & Booking info
                    $rVn = mysql_fetch_array(mysql_query("select venue_desc from bq_venue where venue_code='".$row['venue']."'"));
                    $venueDesc = !empty($rVn['venue_desc']) ? $rVn['venue_desc'] : $row['venue'];

                    $rbk = mysql_fetch_array(mysql_query("select funct from bq_hallbooking where booking_no='".$row['bkno']."'"));
                    $rbf = mysql_fetch_array(mysql_query("select func_desc from bq_function where func_code='".$rbk['funct']."'"));

                    // Pax calculation
                    $rbp = mysql_fetch_array(mysql_query("select fpno from bq_opfpmenuhdr where bkno='".$row['bkno']."' and bill_status!='3'"));
                    $sqV = mysql_fetch_array(mysql_query("select gpax from bq_opvchrhdr where fpno='".$rbp['fpno']."' AND bill_status!='3'"));
                    $paxCount = !empty($sqV['gpax']) ? (int)$sqV['gpax'] : (int)$row['gpax'];

                    // Settlement record
                    $sqBl = mysql_fetch_array(mysql_query("select * from bq_opbillstldtl where bill_no='".$row['bill_no']."'"));

                    $billTotal = (float)$row['billamt'] + (float)$row['advamt'];
                    $advAmt = (float)$row['advamt'];
                    $cashVal = (float)$sqBl['cash'];
                    $cardVal = (float)$sqBl['card'];
                    $compVal = (float)$sqBl['company'];
                    $upiVal = (float)$sqBl['upi'];
                    $chequeVal = (float)$sqBl['cheque'];
                    $neftVal = (float)$sqBl['neft'];
                    $roomVal = (float)$sqBl['room'];
                    $refundVal = (float)$sqBl['refund'];

                    $pagePax += $paxCount;
                    $pageBillAmt += $billTotal;
                    $pageAdvAmt += $advAmt;
                    $pageCash += $cashVal;
                    $pageCard += $cardVal;
                    $pageCompany += $compVal;
                    $pageUPI += $upiVal;
                    $pageCheque += $chequeVal;
                    $pageNeft += $neftVal;
                    $pageRoom += $roomVal;
                    $pageRefund += $refundVal;

                    $vouchrNo = isset($sqBl['vouchrno']) ? $sqBl['vouchrno'] : '';
            ?>
                <tr class="<?php echo $rowClass; ?>">
                    <td><?php echo $x; ?></td>
                    <td>
                        <a href="javascript:void(0);" onclick="selRefNo('<?php echo htmlspecialchars($row['bill_no']); ?>','<?php echo htmlspecialchars($vouchrNo); ?>');" class="bill-link" title="Click to print bill">
                            <b><?php echo htmlspecialchars(strtoupper($row['bill_no'])); ?></b>
                        </a>
                    </td>
                    <td><?php echo htmlspecialchars($row['bill_date']); ?></td>
                    <td class="text-left"><b><?php echo htmlspecialchars(strtoupper($row['fname'])); ?></b></td>
                    <td class="text-left"><?php echo htmlspecialchars(strtoupper($venueDesc)); ?></td>
                    <td class="text-left"><?php echo htmlspecialchars(strtoupper($rbf['func_desc'])); ?></td>
                    <td class="text-right"><?php echo number_format($paxCount); ?></td>
                    <td class="text-right"><b><?php echo number_format($billTotal, 2); ?></b></td>
                    <td class="text-right"><?php echo number_format($advAmt, 2); ?></td>
                    <td class="text-right"><?php echo ($cashVal > 0) ? number_format($cashVal, 2) : '0.00'; ?></td>
                    <td class="text-right"><?php echo ($cardVal > 0) ? number_format($cardVal, 2) : '0.00'; ?></td>
                    <td class="text-right"><?php echo ($compVal > 0) ? number_format($compVal, 2) : '0.00'; ?></td>
                    <td class="text-right"><?php echo ($upiVal > 0) ? number_format($upiVal, 2) : '0.00'; ?></td>
                    <td class="text-right"><?php echo ($chequeVal > 0) ? number_format($chequeVal, 2) : '0.00'; ?></td>
                    <td class="text-right"><?php echo ($neftVal > 0) ? number_format($neftVal, 2) : '0.00'; ?></td>
                    <td class="text-right"><?php echo ($roomVal > 0) ? number_format($roomVal, 2) : '0.00'; ?></td>
                    <td class="text-right"><?php echo ($refundVal > 0) ? number_format($refundVal, 2) : '0.00'; ?></td>
                    <td><?php echo htmlspecialchars($sqBl['card_desc']); ?></td>
                    <td><?php echo htmlspecialchars($sqBl['ccno']); ?></td>
                    <td class="text-left"><?php echo htmlspecialchars(strtoupper($sqBl['compname'])); ?></td>
                    <td class="text-left"><?php echo htmlspecialchars($sqBl['remarks']); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($sqBl['added_by'])); ?></td>
                </tr>
            <?php 
                } 
            } else { 
            ?>
                <tr>
                    <td colspan="<?php echo $colSpanTotal; ?>" style="padding: 20px 10px !important; color: #777777; text-align: center; font-size: 13px;">
                        No Settlement Report records found for the selected criteria
                    </td>
                </tr>
            <?php } ?>
            </tbody>

            <?php if ($totalRecords > 0) { ?>
            <tfoot>
                <tr class="totals-row">
                    <td colspan="6" class="text-right"><b>PAGE TOTAL:</b></td>
                    <td class="text-right"><b><?php echo number_format($pagePax); ?></b></td>
                    <td class="text-right"><b><?php echo number_format($pageBillAmt, 2); ?></b></td>
                    <td class="text-right"><b><?php echo number_format($pageAdvAmt, 2); ?></b></td>
                    <td class="text-right"><b><?php echo number_format($pageCash, 2); ?></b></td>
                    <td class="text-right"><b><?php echo number_format($pageCard, 2); ?></b></td>
                    <td class="text-right"><b><?php echo number_format($pageCompany, 2); ?></b></td>
                    <td class="text-right"><b><?php echo number_format($pageUPI, 2); ?></b></td>
                    <td class="text-right"><b><?php echo number_format($pageCheque, 2); ?></b></td>
                    <td class="text-right"><b><?php echo number_format($pageNeft, 2); ?></b></td>
                    <td class="text-right"><b><?php echo number_format($pageRoom, 2); ?></b></td>
                    <td class="text-right"><b><?php echo number_format($pageRefund, 2); ?></b></td>
                    <td colspan="5"></td>
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
                <a href="<?php echo getPageUrl(1, $frDateParam, $toDateParam, $venueParam, $valParam, $limit); ?>" class="mypay-page-link" title="First Page">&laquo;</a>
                <a href="<?php echo getPageUrl($page - 1, $frDateParam, $toDateParam, $venueParam, $valParam, $limit); ?>" class="mypay-page-link" title="Previous Page">&lsaquo;</a>
            <?php } else { ?>
                <span class="mypay-page-link disabled">&laquo;</span>
                <span class="mypay-page-link disabled">&lsaquo;</span>
            <?php } ?>

            <!-- Page Number Links -->
            <?php
            $startPage = max(1, $page - 2);
            $endPage = min($totalPages, $page + 2);

            if ($startPage > 1) {
                echo '<a href="' . getPageUrl(1, $frDateParam, $toDateParam, $venueParam, $valParam, $limit) . '" class="mypay-page-link">1</a>';
                if ($startPage > 2) {
                    echo '<span class="mypay-page-link disabled" style="cursor:default;">...</span>';
                }
            }

            for ($p = $startPage; $p <= $endPage; $p++) {
                if ($p == $page) {
                    echo '<span class="mypay-page-link active">' . $p . '</span>';
                } else {
                    echo '<a href="' . getPageUrl($p, $frDateParam, $toDateParam, $venueParam, $valParam, $limit) . '" class="mypay-page-link">' . $p . '</a>';
                }
            }

            if ($endPage < $totalPages) {
                if ($endPage < $totalPages - 1) {
                    echo '<span class="mypay-page-link disabled" style="cursor:default;">...</span>';
                }
                echo '<a href="' . getPageUrl($totalPages, $frDateParam, $toDateParam, $venueParam, $valParam, $limit) . '" class="mypay-page-link">' . $totalPages . '</a>';
            }
            ?>

            <!-- Next & Last -->
            <?php if ($page < $totalPages) { ?>
                <a href="<?php echo getPageUrl($page + 1, $frDateParam, $toDateParam, $venueParam, $valParam, $limit); ?>" class="mypay-page-link" title="Next Page">&rsaquo;</a>
                <a href="<?php echo getPageUrl($totalPages, $frDateParam, $toDateParam, $venueParam, $valParam, $limit); ?>" class="mypay-page-link" title="Last Page">&raquo;</a>
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
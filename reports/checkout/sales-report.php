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

if ($valParam != '') {
    $v = mysql_real_escape_string($valParam);
    $where .= " AND (bill_no like '%$v%' OR fname like '%$v%' OR bkno like '%$v%' OR fpno like '%$v%') ";
}

// Preload Dynamic Group Codes
$grpCodes = array();
$sqlTS = mysql_query("select distinct grpcode, grpname from bq_grpcode where status='1' order by grpcode ASC");
if ($sqlTS) {
    while ($rowTS = mysql_fetch_assoc($sqlTS)) {
        $grpCodes[] = $rowTS;
    }
}

// Check if GST is present in this date range or use standard tax structures
$hasGST = false;
$checkGST = mysql_query("select count(*) as cnt from bq_opbillhdr $where AND (cgst > 0 or sgst > 0)");
if ($checkGST) {
    $rowGST = mysql_fetch_assoc($checkGST);
    if ($rowGST['cnt'] > 0) {
        $hasGST = true;
    }
}

$taxCodes = array();
if (!$hasGST) {
    $sqlTax = mysql_query("select * from bq_taxstruct where status='1' group by tax_code order by tax_code ASC");
    if ($sqlTax) {
        while ($rTax = mysql_fetch_assoc($sqlTax)) {
            $taxCodes[] = $rTax['tax_code'];
        }
    }
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
$colSpanTotal = 7 + count($grpCodes) + 1 + ($hasGST ? 2 : count($taxCodes)) + 4;

// Helper for pagination links
function getPageUrl($p, $frDateParam, $toDateParam, $valParam, $limit) {
    return "sales-report.php?fromdate=" . urlencode($frDateParam) . "&todate=" . urlencode($toDateParam) . "&val=" . urlencode($valParam) . "&limit=" . $limit . "&page=" . $p;
}
?>
<link rel="stylesheet" href="<?php echo $home_path;?>/css/mypay-master.css">
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<script src="../../js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo $home_path; ?>/js/shortcut.js"></script>

<style type="text/css">
/* ==========================================================================
   Master Pages Style - Standardized Unified Sales Report (MyPay) Design System
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
    min-width: 1750px !important;
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
    var srtx = $('#searchTxt').val().trim();
    var limit = $('#limitSelect').val() || '25';
    document.location = "sales-report.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&val=" + encodeURIComponent(srtx) + "&limit=" + encodeURIComponent(limit) + "&page=1";
}

function changeLimit(lim) {
    var fromdate = $('#from_date').val() || '';
    var todate = $('#to_date').val() || '';
    var srtx = $('#searchTxt').val().trim();
    document.location = "sales-report.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&val=" + encodeURIComponent(srtx) + "&limit=" + encodeURIComponent(lim) + "&page=1";
}

function srcSub(){
    document.location = "sales-report.php";
}

function selRefNo(val){
    var printUrl = '<?php echo $home_path; ?>/transaction/view/bill-print-pdout.php?billNo=' + encodeURIComponent(val);
    var newwindow = window.open(printUrl, "_blank", 'scrollbars=1,menubar=0,resizable=1,width=1000,height=700');
    if (newwindow) {
        newwindow.focus();
    }
}

function printPage(){
    var divContents = $("#dvContainer").html();
    var printWindow = window.open('', '', 'height=600,width=950');
    printWindow.document.write('<html><head><title>Sales Report</title>');
    printWindow.document.write('<style>table {width:100%;border-collapse:collapse;font-family:Arial,sans-serif;font-size:11px;} th, td {border:1px solid #ccc;padding:5px;text-align:center;} th {background-color:#0073B5;color:#fff;} .text-right {text-align:right;} .text-left {text-align:left;} th.banner-row th {font-size:13px;}</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h3 style="text-align:center;font-family:Arial;margin-bottom:5px;"><?php echo htmlspecialchars($prop_name); ?><?php echo !empty($city) ? ", ".htmlspecialchars($city) : ""; ?></h3>');
    printWindow.document.write('<h4 style="text-align:center;font-family:Arial;margin-top:0;margin-bottom:10px;">BANQUET SALES REPORT (<?php echo htmlspecialchars($displayFrom); ?> to <?php echo htmlspecialchars($displayTo); ?>)</h4>');
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
            
            <input type="text" id="searchTxt" name="searchTxt" class="mypay-search-input" placeholder="Search Bill# / Guest / Venue..." value="<?php if($valParam != '') { echo htmlspecialchars($valParam); } ?>" />
            
            <button type="button" name="submt" id="submt" class="btn-mypay-search" onclick="clkSubmit()" title="Display Records">
                <i class="fa fa-search"></i> <span>Display</span>
            </button>
            
            <?php if(($valParam != '') || ($frDateParam != '')) { ?>
                <button type="button" class="btn-mypay-reset" onclick="srcSub()" title="Clear Filter">
                    <i class="fa fa-times"></i> <span>Clear</span>
                </button>
            <?php } ?>

            <a href="<?php echo $home_path ?>/reports/checkout/xt_sales_report_xls.php?fromdate=<?php echo urlencode($displayFrom); ?>&todate=<?php echo urlencode($displayTo); ?>" class="btn-mypay-excel" title="Export to Excel">
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
                    <th colspan="<?php echo $colSpanTotal; ?>">BANQUET SALES REPORT</th>
                </tr>
                <tr class="header-row">
                    <th style="width: 3%;">Sl.no</th>
                    <th style="width: 6%;">Bill#</th>
                    <th style="width: 5.5%;">Bill Date</th>
                    <th style="width: 10%;">Guest / Company</th>
                    <th style="width: 6.5%;">Venue</th>
                    <th style="width: 6.5%;">Function</th>
                    <th style="width: 3.5%;" class="text-right">Pax</th>
                    
                    <?php foreach ($grpCodes as $gc) { ?>
                        <th class="text-right" style="min-width: 80px;"><?php echo htmlspecialchars(ucwords($gc['grpname'])); ?></th>
                    <?php } ?>
                    
                    <th class="text-right" style="min-width: 80px;">Net Amt</th>
                    
                    <?php if ($hasGST) { ?>
                        <th class="text-right" style="min-width: 75px;">CGST</th>
                        <th class="text-right" style="min-width: 75px;">SGST</th>
                    <?php } else { ?>
                        <?php foreach ($taxCodes as $tc) { ?>
                            <th class="text-right" style="min-width: 75px;"><?php echo htmlspecialchars($tc); ?></th>
                        <?php } ?>
                    <?php } ?>
                    
                    <th class="text-right" style="min-width: 70px;">Disc</th>
                    <th class="text-right" style="min-width: 65px;">RND</th>
                    <th class="text-right" style="min-width: 85px;">Grand Total</th>
                    <th style="min-width: 75px;">Billed by</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            // Paginated query
            $sql = mysql_query("select * from bq_opbillhdr $where order by opbillhdr_id ASC LIMIT $offset, $limit");
            $x = $offset;

            // Page total accumulators
            $pagePax = 0;
            $pageGrpTotals = array();
            foreach ($grpCodes as $gc) {
                $pageGrpTotals[$gc['grpcode']] = 0;
            }
            $pageNet = 0;
            $pageCGST = 0;
            $pageSGST = 0;
            $pageTaxTotals = array();
            foreach ($taxCodes as $tc) {
                $pageTaxTotals[$tc] = 0;
            }
            $pageDisc = 0;
            $pageRnd = 0;
            $pageGrand = 0;

            if ($sql && is_resource($sql) && mysql_num_rows($sql) > 0) {
                while ($row = mysql_fetch_array($sql)) {
                    $x++;

                    $isCancelled = ($row['bill_status'] == '3');
                    $rowClass = $isCancelled ? 'row-cancelled' : '';

                    // Booking & Function info
                    $rbk = mysql_fetch_array(mysql_query("select venue, funct from bq_hallbooking where booking_no='".$row['bkno']."'"));
                    $rbf = mysql_fetch_array(mysql_query("select func_desc from bq_function where func_code='".$rbk['funct']."'"));
                    
                    // Pax
                    $rbp = mysql_fetch_array(mysql_query("select fpno from bq_opfpmenuhdr where bkno='".$row['bkno']."'"));
                    $sqV = mysql_fetch_array(mysql_query("select gpax from bq_opvchrhdr where fpno='".$rbp['fpno']."' AND bill_status!='3'"));
                    $paxCount = !empty($sqV['gpax']) ? (int)$sqV['gpax'] : (int)$row['gpax'];
                    $pagePax += $paxCount;

                    // Round-off
                    $rRnd = mysql_fetch_array(mysql_query("select itemrate from bq_opbillhdtl where itemcode='RND' AND bill_no='".$row['bill_no']."'"));
                    $rndRate = isset($rRnd['itemrate']) ? (float)$rRnd['itemrate'] : (float)$row['roundoff'];

                    // Net amount, disc, grand total
                    $netAmt = (float)$row['nontaxableamt'];
                    $discAmt = (float)$row['discamt'];
                    $advAmt = (float)$row['advamt'];
                    $grandTotal = round((float)$row['billamt'] + $rndRate + $advAmt);

                    $pageNet += $netAmt;
                    $pageDisc += $discAmt;
                    $pageRnd += $rndRate;
                    $pageGrand += $grandTotal;
            ?>
                <tr class="<?php echo $rowClass; ?>">
                    <td><?php echo $x; ?></td>
                    <td>
                        <a href="javascript:void(0);" onclick="selRefNo('<?php echo htmlspecialchars($row['bill_no']); ?>');" class="bill-link" title="Click to print bill">
                            <b><?php echo htmlspecialchars(strtoupper($row['bill_no'])); ?></b>
                        </a>
                    </td>
                    <td><?php echo htmlspecialchars($row['bill_date']); ?></td>
                    <td class="text-left"><b><?php echo htmlspecialchars(strtoupper($row['fname'])); ?></b></td>
                    <td class="text-left"><?php echo htmlspecialchars(strtoupper($rbk['venue'])); ?></td>
                    <td class="text-left"><?php echo htmlspecialchars(strtoupper($rbf['func_desc'])); ?></td>
                    <td class="text-right"><?php echo number_format($paxCount); ?></td>

                    <!-- Dynamic Group Code Amounts -->
                    <?php 
                    foreach ($grpCodes as $gc) {
                        $sqL = mysql_query("select sum(item_total) as grpAmt from bq_opbillhdtl where bill_no='".$row['bill_no']."' AND grpcode='".$gc['grpcode']."' AND bill_status!='3'");
                        $rowL = mysql_fetch_array($sqL);
                        $gAmt = !empty($rowL['grpAmt']) ? (float)$rowL['grpAmt'] : 0.00;
                        $pageGrpTotals[$gc['grpcode']] += $gAmt;
                    ?>
                        <td class="text-right"><?php echo ($gAmt > 0) ? number_format($gAmt, 2) : '0.00'; ?></td>
                    <?php } ?>

                    <!-- Net Amount -->
                    <td class="text-right"><b><?php echo number_format($netAmt, 2); ?></b></td>

                    <!-- Taxes / GST -->
                    <?php if ($hasGST) { 
                        $cgstVal = (float)$row['cgst'];
                        $sgstVal = (float)$row['sgst'];
                        $pageCGST += $cgstVal;
                        $pageSGST += $sgstVal;
                    ?>
                        <td class="text-right"><?php echo ($cgstVal > 0) ? number_format($cgstVal, 2) : '0.00'; ?></td>
                        <td class="text-right"><?php echo ($sgstVal > 0) ? number_format($sgstVal, 2) : '0.00'; ?></td>
                    <?php } else { ?>
                        <?php 
                        $rwVoucher = mysql_fetch_array(mysql_query("select vouchrno from bq_opbillhdtl where bill_no='".$row['bill_no']."' LIMIT 1"));
                        $vouchrNo = isset($rwVoucher['vouchrno']) ? $rwVoucher['vouchrno'] : '';

                        foreach ($taxCodes as $tc) {
                            $sqS = mysql_query("select sum(taxamt) as txAmt from bq_opvchrtaxdtl where vouchrno='".$vouchrNo."' AND taxcode='".$tc."' AND bill_status!='3'");
                            $rotS = mysql_fetch_array($sqS);
                            $tAmt = !empty($rotS['txAmt']) ? (float)$rotS['txAmt'] : 0.00;
                            $pageTaxTotals[$tc] += $tAmt;
                        ?>
                            <td class="text-right"><?php echo ($tAmt > 0) ? number_format($tAmt, 2) : '0.00'; ?></td>
                        <?php } ?>
                    <?php } ?>

                    <td class="text-right"><?php echo ($discAmt > 0) ? number_format($discAmt, 2) : '0.00'; ?></td>
                    <td class="text-right"><?php echo ($rndRate != 0) ? number_format($rndRate, 2) : '0.00'; ?></td>
                    <td class="text-right"><b><?php echo number_format($grandTotal, 2); ?></b></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['added_by'])); ?></td>
                </tr>
            <?php 
                } 
            } else { 
            ?>
                <tr>
                    <td colspan="<?php echo $colSpanTotal; ?>" style="padding: 20px 10px !important; color: #777777; text-align: center; font-size: 13px;">
                        No Sales Report records found for the selected criteria
                    </td>
                </tr>
            <?php } ?>
            </tbody>

            <?php if ($totalRecords > 0) { ?>
            <tfoot>
                <tr class="totals-row">
                    <td colspan="6" class="text-right"><b>PAGE TOTAL:</b></td>
                    <td class="text-right"><b><?php echo number_format($pagePax); ?></b></td>

                    <?php foreach ($grpCodes as $gc) { ?>
                        <td class="text-right"><b><?php echo number_format($pageGrpTotals[$gc['grpcode']], 2); ?></b></td>
                    <?php } ?>

                    <td class="text-right"><b><?php echo number_format($pageNet, 2); ?></b></td>

                    <?php if ($hasGST) { ?>
                        <td class="text-right"><b><?php echo number_format($pageCGST, 2); ?></b></td>
                        <td class="text-right"><b><?php echo number_format($pageSGST, 2); ?></b></td>
                    <?php } else { ?>
                        <?php foreach ($taxCodes as $tc) { ?>
                            <td class="text-right"><b><?php echo number_format($pageTaxTotals[$tc], 2); ?></b></td>
                        <?php } ?>
                    <?php } ?>

                    <td class="text-right"><b><?php echo number_format($pageDisc, 2); ?></b></td>
                    <td class="text-right"><b><?php echo number_format($pageRnd, 2); ?></b></td>
                    <td class="text-right"><b><?php echo number_format($pageGrand, 2); ?></b></td>
                    <td></td>
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
                <a href="<?php echo getPageUrl(1, $frDateParam, $toDateParam, $valParam, $limit); ?>" class="mypay-page-link" title="First Page">&laquo;</a>
                <a href="<?php echo getPageUrl($page - 1, $frDateParam, $toDateParam, $valParam, $limit); ?>" class="mypay-page-link" title="Previous Page">&lsaquo;</a>
            <?php } else { ?>
                <span class="mypay-page-link disabled">&laquo;</span>
                <span class="mypay-page-link disabled">&lsaquo;</span>
            <?php } ?>

            <!-- Page Number Links -->
            <?php
            $startPage = max(1, $page - 2);
            $endPage = min($totalPages, $page + 2);

            if ($startPage > 1) {
                echo '<a href="' . getPageUrl(1, $frDateParam, $toDateParam, $valParam, $limit) . '" class="mypay-page-link">1</a>';
                if ($startPage > 2) {
                    echo '<span class="mypay-page-link disabled" style="cursor:default;">...</span>';
                }
            }

            for ($p = $startPage; $p <= $endPage; $p++) {
                if ($p == $page) {
                    echo '<span class="mypay-page-link active">' . $p . '</span>';
                } else {
                    echo '<a href="' . getPageUrl($p, $frDateParam, $toDateParam, $valParam, $limit) . '" class="mypay-page-link">' . $p . '</a>';
                }
            }

            if ($endPage < $totalPages) {
                if ($endPage < $totalPages - 1) {
                    echo '<span class="mypay-page-link disabled" style="cursor:default;">...</span>';
                }
                echo '<a href="' . getPageUrl($totalPages, $frDateParam, $toDateParam, $valParam, $limit) . '" class="mypay-page-link">' . $totalPages . '</a>';
            }
            ?>

            <!-- Next & Last -->
            <?php if ($page < $totalPages) { ?>
                <a href="<?php echo getPageUrl($page + 1, $frDateParam, $toDateParam, $valParam, $limit); ?>" class="mypay-page-link" title="Next Page">&rsaquo;</a>
                <a href="<?php echo getPageUrl($totalPages, $frDateParam, $toDateParam, $valParam, $limit); ?>" class="mypay-page-link" title="Last Page">&raquo;</a>
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
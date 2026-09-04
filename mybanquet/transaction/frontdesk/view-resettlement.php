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

// Pagination
$limit = isset($_GET['limit']) && is_numeric($_GET['limit']) ? (int)$_GET['limit'] : 10;
if (!in_array($limit, [10, 25, 50, 100])) {
    $limit = 10;
}

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}

// Build WHERE clause
$where = " where 1=1 ";
if ($frDateParam != '' && $toDateParam != '') {
    $fr = explode('/', $frDateParam);
    $to = explode('/', $toDateParam);
    if (count($fr) == 3 && count($to) == 3) {
        $frm = $fr[2] . '-' . $fr[1] . '-' . $fr[0];
        $tod = $to[2] . '-' . $to[1] . '-' . $to[0];
        $where .= " AND str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' ";
    }
} else {
    $ad = explode('/', $adtCurDt);
    if (count($ad) == 3) {
        $addC = $ad[2] . '-' . $ad[1] . '-' . $ad[0];
        $where .= " AND str_to_date(bill_date,'%d/%m/%Y') = '$addC' ";
    }
}

if ($valParam != '') {
    $v = mysql_real_escape_string($valParam);
    $where .= " AND (bill_no like '%$v%' OR fpno like '%$v%' OR remarks like '%$v%') ";
}

// Default settleflag
$where .= " AND settleflag = '1' ";

// Count records
$countSql = mysql_query("select count(distinct bill_no) as total, sum(billamt) as sum_bill, sum(cash) as sum_cash, sum(card) as sum_card from bq_opbillstldtl $where");
$countRow = ($countSql && mysql_num_rows($countSql) > 0) ? mysql_fetch_array($countSql) : array();
$totalRecords = isset($countRow['total']) ? (int)$countRow['total'] : 0;
$totalBill    = isset($countRow['sum_bill']) ? (float)$countRow['sum_bill'] : 0.00;
$totalCash    = isset($countRow['sum_cash']) ? (float)$countRow['sum_cash'] : 0.00;
$totalCard    = isset($countRow['sum_card']) ? (float)$countRow['sum_card'] : 0.00;

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

function getPageUrl($p, $frDateParam, $toDateParam, $valParam, $limit) {
    return "view-resettlement.php?fromdate=" . urlencode($frDateParam) . "&todate=" . urlencode($toDateParam) . "&val=" . urlencode($valParam) . "&limit=" . $limit . "&page=" . $p;
}
?>
<link rel="stylesheet" href="<?php echo $home_path;?>/css/mypay-master.css">
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo $home_path; ?>/js/shortcut.js"></script>

<style type="text/css">
/* Master View Styling */
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

.btn-mypay-add {
    background-color: #0084b4 !important;
    color: #ffffff !important;
    border: 1px solid #00739c !important;
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
    min-width: 1400px !important;
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

.badge-passive {
    background-color: #fbeae9 !important;
    color: #cf222e !important;
    border: 1px solid #f7c3c0 !important;
}

.btn-resettle-action {
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
    text-decoration: none !important;
    transition: background 0.15s ease !important;
}

.btn-resettle-action:hover {
    background: #005580 !important;
    color: #ffffff !important;
}

/* Pagination */
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
}

.mypay-page-link:hover:not(.disabled):not(.active) {
    background-color: #f0f4f8 !important;
    border-color: #0073B5 !important;
}

.mypay-page-link.active {
    background-color: #0073B5 !important;
    border-color: #005b8a !important;
    color: #ffffff !important;
}

.mypay-page-link.disabled {
    background-color: #f6f8fa !important;
    border-color: #e1e4e8 !important;
    color: #adb5bd !important;
    cursor: not-allowed !important;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
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

    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+A", function() { 
            window.location.href = "settlement.php";
        });
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
    var limit = $('#limitSelect').val() || '10';
    document.location = "view-resettlement.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&val=" + encodeURIComponent(srtx) + "&limit=" + encodeURIComponent(limit) + "&page=1";
}

function changeLimit(lim) {
    var fromdate = $('#from_date').val() || '';
    var todate = $('#to_date').val() || '';
    var srtx = $('#searchTxt').val().trim();
    document.location = "view-resettlement.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&val=" + encodeURIComponent(srtx) + "&limit=" + encodeURIComponent(lim) + "&page=1";
}

function srcSub(){
    document.location = "view-resettlement.php";
}

function printPage(){
    var divContents = $("#dvContainer").html();
    var printWindow = window.open('', '', 'height=600,width=950');
    printWindow.document.write('<html><head><title>View Resettlement Details</title>');
    printWindow.document.write('<style>table {width:100%;border-collapse:collapse;font-family:Arial,sans-serif;font-size:12px;} th, td {border:1px solid #ccc;padding:6px;text-align:center;} th {background-color:#0073B5;color:#fff;} .text-right {text-align:right;} th.banner-row th {font-size:13px;}</style>');
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
            
            <input type="text" id="searchTxt" name="searchTxt" class="mypay-search-input" placeholder="Search Bill No / FP No / Remarks" value="<?php if($valParam != '') { echo htmlspecialchars($valParam); } ?>" />
            
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
            <a href="settlement.php" class="btn-mypay-add" id="add" title="Settlement (Ctrl+A)">
                <span class="mypay-icon-plus"><i class="fa fa-plus"></i></span>
                <span>Settlement</span>
            </a>
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
                    <th colspan="16">VIEW RESETTLEMENT DETAILS</th>
                </tr>
                <tr class="header-row">
                    <th style="width: 3.5%;">Sl.no</th>
                    <th style="width: 7%;">Bill No</th>
                    <th style="width: 6.5%;">Bill Date</th>
                    <th style="width: 6.5%;">FP No</th>
                    <th style="width: 7%;" class="text-right">Bill Amount</th>
                    <th style="width: 6%;" class="text-right">Cash</th>
                    <th style="width: 6%;" class="text-right">Card</th>
                    <th style="width: 6%;" class="text-right">Company</th>
                    <th style="width: 6%;" class="text-right">Cheque</th>
                    <th style="width: 6%;" class="text-right">NEFT</th>
                    <th style="width: 6%;" class="text-right">Room</th>
                    <th style="width: 6%;" class="text-right">Refund</th>
                    <th style="width: 6%;" class="text-right">Void</th>
                    <th style="width: 10%;">Remarks</th>
                    <th style="width: 6%;">Status</th>
                    <th style="width: 6%;">Resettle</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $sql = mysql_query("select * from bq_opbillstldtl $where group by bill_no order by bill_no ASC LIMIT $offset, $limit");
            $x = $offset;

            $pageBill = 0;
            $pageCash = 0;
            $pageCard = 0;

            if($sql && is_resource($sql) && mysql_num_rows($sql) > 0) {
                while($row = mysql_fetch_array($sql)) {
                    $x++;
                    $settleflag = $row['settleflag'];
                    if($settleflag == '3'){
                        $statusBadge = '<span class="badge-status badge-passive">Cancelled</span>';
                    } else {
                        $statusBadge = '<span class="badge-status badge-active">Settled</span>';
                    }

                    $bAmt = (float)$row['billamt'];
                    $csh  = (float)$row['cash'];
                    $crd  = (float)$row['card'];

                    $pageBill += $bAmt;
                    $pageCash += $csh;
                    $pageCard += $crd;

                    $resettleUrl = "resettlement.php?blNo=" . urlencode($row['bill_no']) . "&rgNm=" . urlencode($row['reg_num']) . "&billNm=" . urlencode($row['bill_no']);
            ?>
                <tr>
                    <td><?php echo $x; ?></td>
                    <td><b><?php echo htmlspecialchars(strtoupper($row['bill_no'])); ?></b></td>
                    <td><?php echo htmlspecialchars($row['bill_date']); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['fpno'])); ?></td>
                    <td class="text-right"><b><?php echo number_format($bAmt, 2); ?></b></td>
                    <td class="text-right"><?php echo number_format($csh, 2); ?></td>
                    <td class="text-right"><?php echo number_format($crd, 2); ?></td>
                    <td class="text-right"><?php echo number_format((float)$row['company'], 2); ?></td>
                    <td class="text-right"><?php echo number_format((float)$row['cheque'], 2); ?></td>
                    <td class="text-right"><?php echo number_format((float)$row['neft'], 2); ?></td>
                    <td class="text-right"><?php echo number_format((float)$row['room'], 2); ?></td>
                    <td class="text-right"><?php echo number_format((float)$row['refund'], 2); ?></td>
                    <td class="text-right"><?php echo number_format((float)$row['void'], 2); ?></td>
                    <td><?php echo htmlspecialchars($row['remarks']); ?></td>
                    <td><?php echo $statusBadge; ?></td>
                    <td>
                        <a href="<?php echo $resettleUrl; ?>" class="btn-resettle-action" title="Resettle Bill">
                            <i class="fa fa-refresh"></i> Resettle
                        </a>
                    </td>
                </tr>
            <?php 
                } 
            } else { 
            ?>
                <tr>
                    <td colspan="16" style="padding: 20px 10px !important; color: #777777; text-align: center; font-size: 13px;">
                        No Resettlement records found for the selected criteria
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination Controls Bar -->
    <?php if($totalRecords > 0) { ?>
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
            </select>
            <span>entries</span>
        </div>

        <div class="mypay-pagination">
            <?php if ($page > 1) { ?>
                <a href="<?php echo getPageUrl(1, $frDateParam, $toDateParam, $valParam, $limit); ?>" class="mypay-page-link" title="First Page">&laquo;</a>
                <a href="<?php echo getPageUrl($page - 1, $frDateParam, $toDateParam, $valParam, $limit); ?>" class="mypay-page-link" title="Previous Page">&lsaquo;</a>
            <?php } else { ?>
                <span class="mypay-page-link disabled">&laquo;</span>
                <span class="mypay-page-link disabled">&lsaquo;</span>
            <?php } ?>

            <?php
            $startPage = max(1, $page - 2);
            $endPage = min($totalPages, $page + 2);

            for ($p = $startPage; $p <= $endPage; $p++) {
                if ($p == $page) {
                    echo '<span class="mypay-page-link active">' . $p . '</span>';
                } else {
                    echo '<a href="' . getPageUrl($p, $frDateParam, $toDateParam, $valParam, $limit) . '" class="mypay-page-link">' . $p . '</a>';
                }
            }
            ?>

            <?php if ($page < $totalPages) { ?>
                <a href="<?php echo getPageUrl($page + 1, $frDateParam, $toDateParam, $valParam, $limit); ?>" class="mypay-page-link" title="Next Page">&rsaquo;</a>
                <a href="<?php echo getPageUrl($totalPages, $frDateParam, $toDateParam, $valParam, $limit); ?>" class="mypay-page-link" title="Last Page">&raquo;</a>
            <?php } else { ?>
                <span class="mypay-page-link disabled">&rsaquo;</span>
                <span class="mypay-page-link disabled">&raquo;</span>
            <?php } ?>
        </div>
    </div>
    <?php } ?>

</div>

<?php include("../../footer.php"); ?>
</body>
</html>
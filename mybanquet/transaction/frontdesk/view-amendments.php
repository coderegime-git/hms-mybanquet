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

// Pagination parameters
$limit = isset($_GET['limit']) && is_numeric($_GET['limit']) ? (int)$_GET['limit'] : 10;
if (!in_array($limit, [10, 25, 50, 100])) {
    $limit = 10;
}

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}

// Construct WHERE clause
$where = " where 1=1 ";
if ($frDateParam != '' && $toDateParam != '') {
    $fr = explode('/', $frDateParam);
    $frm = $fr[2] . '-' . $fr[1] . '-' . $fr[0];
    $to = explode('/', $toDateParam);
    $tod = $to[2] . '-' . $to[1] . '-' . $to[0];
    $where .= " AND str_to_date(func_date,'%d/%m/%Y') >= '$frm' AND str_to_date(func_date,'%d/%m/%Y') <= '$tod' ";
}
if ($valParam != '') {
    $v = mysql_real_escape_string($valParam);
    $where .= " AND (amendno like '%$v%' OR fp_no like '%$v%' OR booking_no like '%$v%' OR guest_name like '%$v%') ";
}

// Count total matching records
$countSql = mysql_query("select count(*) as total from bq_amendments $where");
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

// Helper for pagination links
function getPageUrl($p, $frDateParam, $toDateParam, $valParam, $limit) {
    return "view-amendments.php?fromdate=" . urlencode($frDateParam) . "&todate=" . urlencode($toDateParam) . "&val=" . urlencode($valParam) . "&limit=" . $limit . "&page=" . $p;
}
?>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<script src="../../js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo $home_path; ?>/js/shortcut.js"></script>

<style type="text/css">
/* ==========================================================================
   Standardized Frontdesk View Styling - Unified MyPay Design System
   ========================================================================== */
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

/* Action & Search Bar on Top */
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
    font-size: 12px !important;
    font-weight: bold !important;
    color: #333333 !important;
    margin: 0 !important;
    padding: 0 2px !important;
}

.mypay-date-input {
    width: 100px !important;
    height: 28px !important;
    line-height: 28px !important;
    text-align: center !important;
    padding: 0 5px !important;
    border: 1px solid #0073B5 !important;
    border-radius: 4px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
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
    width: 280px !important;
    height: 28px !important;
    line-height: 28px !important;
    padding: 0 10px !important;
    border: 1px solid #0073B5 !important;
    border-radius: 4px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
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
    padding: 0 12px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    font-weight: bold !important;
    height: 28px !important;
    line-height: 26px !important;
    box-sizing: border-box !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 5px !important;
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
    height: 28px !important;
    line-height: 26px !important;
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

.btn-mypay-print {
    background-color: #28a745 !important;
    color: #ffffff !important;
    border: 1px solid #1e7e34 !important;
    border-radius: 3px !important;
    padding: 0 12px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    font-weight: bold !important;
    height: 28px !important;
    line-height: 26px !important;
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

/* Table Wrapper for Horizontal & Vertical Scroll */
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
    min-width: 1400px !important;
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
    padding: 6px 8px !important;
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

/* Row Action Print Button */
.btn-mypay-row-print {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    border: 1px solid #005b8a !important;
    border-radius: 3px !important;
    padding: 3px 10px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 11px !important;
    font-weight: bold !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 4px !important;
    text-decoration: none !important;
    cursor: pointer !important;
    line-height: 1.3 !important;
    transition: background-color 0.15s ease-in-out !important;
}

.btn-mypay-row-print:hover {
    background-color: #005b8a !important;
    color: #ffffff !important;
}

/* ==========================================================================
   Standardized Pagination Styling
   ========================================================================== */
.mypay-pagination-bar {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-top: 12px !important;
    padding: 8px 4px !important;
    flex-wrap: wrap !important;
    gap: 10px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
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
        shortcut.add("Ctrl+A", function() { 
            window.location.href = "amendments.php";
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
    document.location = "view-amendments.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&val=" + encodeURIComponent(srtx) + "&limit=" + encodeURIComponent(limit) + "&page=1";
}

function changeLimit(lim) {
    var fromdate = $('#from_date').val() || '';
    var todate = $('#to_date').val() || '';
    var srtx = $('#searchTxt').val().trim();
    document.location = "view-amendments.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&val=" + encodeURIComponent(srtx) + "&limit=" + encodeURIComponent(lim) + "&page=1";
}

function srcSub(){
    document.location = "view-amendments.php";
}

function printPage(){
    var divContents = $("#dvContainer").html();
    var printWindow = window.open('', '', 'height=600,width=900');
    printWindow.document.write('<html><head><title>Amendments Details</title>');
    printWindow.document.write('<style>table {width:100%;border-collapse:collapse;font-family:Arial,sans-serif;font-size:11px;} th, td {border:1px solid #ccc;padding:6px;text-align:center;} th {background-color:#0073B5;color:#fff;} th.banner-row th {font-size:13px;}</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(divContents);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print(); 
}
</script>

<body class="bgBODY">

<?php if(isset($_GET['msg'])){ ?>
<p style="text-align:center;margin:10px 0;">
    <label id="msgFo" style="color:#7B0E0E;font-weight:bold;font-size:13px;"><?php echo htmlspecialchars($_GET['msg']); ?></label>
</p>
<?php } ?>

<div class="mypay-container">

    <!-- Top Action & Search Bar -->
    <div class="mypay-actions-bar">
        <div class="mypay-filter-group">
            <span class="mypay-filter-label">From:</span>
            <input name="from_date" type="text" class="mypay-date-input datepicker" id="from_date" value="<?php if($frDateParam != ''){ echo htmlspecialchars($frDateParam); } else { echo htmlspecialchars($adtCurDt); } ?>" placeholder="From Date" autocomplete="off" />
            
            <span class="mypay-filter-label" style="margin-left:4px;">To:</span>
            <input name="to_date" type="text" class="mypay-date-input datepicker1" id="to_date" value="<?php if($toDateParam != ''){ echo htmlspecialchars($toDateParam); } else { echo htmlspecialchars($adtCurDt); } ?>" placeholder="To Date" autocomplete="off" />
            
            <input type="text" id="searchTxt" name="searchTxt" class="mypay-search-input" placeholder="Amend No / FP No / Booking No / Guest" value="<?php if($valParam != '') { echo htmlspecialchars($valParam); } ?>" />
            
            <button type="button" name="submt" id="submt" class="btn-mypay-search" onclick="clkSubmit()" title="Display Records">
                <i class="fa fa-search"></i> <span>Display</span>
            </button>
            
            <?php if(($valParam != '') || ($frDateParam != '')) { ?>
                <button type="button" class="btn-mypay-reset" onclick="srcSub()" title="Clear Filter">
                    <i class="fa fa-times"></i> <span>Clear</span>
                </button>
            <?php } ?>

            <button type="button" class="btn-mypay-print" onclick="printPage()" title="Print Current View">
                <i class="fa fa-print"></i> <span>Print</span>
            </button>
        </div>

        <div class="mypay-btn-group">
            <a href="amendments.php" class="btn-mypay-add" id="add" title="Add Amendment (Ctrl+A)">
                <span class="mypay-icon-plus"><i class="fa fa-plus"></i></span>
                <span>Add Amendment</span>
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
                    <th colspan="14">VIEW AMENDMENTS DETAILS</th>
                </tr>
                <tr class="header-row">
                    <th style="width: 3%;">Sl.no</th>
                    <th style="width: 7%;">Amend#</th>
                    <th style="width: 7%;">FP#</th>
                    <th style="width: 7%;">Booking#</th>
                    <th style="width: 15%;">Guest Name</th>
                    <th style="width: 7%;">Func Date</th>
                    <th style="width: 9%;">Venue</th>
                    <th style="width: 8%;">Session</th>
                    <th style="width: 5%;">Exp Pax</th>
                    <th style="width: 5%;">Grn Pax</th>
                    <th style="width: 9%;">Amended Venue</th>
                    <th style="width: 8%;">Amended Session</th>
                    <th style="width: 5%;">Print</th>
                    <th style="width: 8%;">Amended By</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            // Paginated query
            $sql = mysql_query("select * from bq_amendments $where order by amend_id DESC LIMIT $offset, $limit");
            $x = $offset;
            if($sql && is_resource($sql) && mysql_num_rows($sql) > 0) {
                while($row = mysql_fetch_array($sql)) {
                    $x++;
                    $expPax = $row['amd_expx'] ? $row['amd_expx'] : $row['exppax'];
                    $grnPax = $row['amd_grpx'] ? $row['amd_grpx'] : $row['grntpax'];
                    $amdVen = $row['amd_ven'] ? $row['amd_ven'] : '-';
                    $amdSess = $row['amd_sess'] ? $row['amd_sess'] : '-';
            ?>
                <tr>
                    <td><?php echo $x; ?></td>
                    <td><b><?php echo htmlspecialchars(strtoupper($row['amendno'])); ?></b></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['fp_no'])); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['booking_no'])); ?></td>
                    <td style="text-align:left;"><?php echo htmlspecialchars(strtoupper($row['guest_name'])); ?></td>
                    <td><?php echo htmlspecialchars($row['func_date']); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['venue'])); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['session'])); ?></td>
                    <td><?php echo htmlspecialchars($expPax); ?></td>
                    <td><?php echo htmlspecialchars($grnPax); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($amdVen)); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($amdSess)); ?></td>
                    <td>
                        <a href="../view/print-fp-creation.php?fpNum=<?php echo urlencode($row['fp_no']); ?>&amend=<?php echo urlencode($row['amendno']); ?>" target="_blank" class="btn-mypay-row-print" title="Print FP Amendment">
                            <i class="fa fa-print"></i> <span>Print</span>
                        </a>
                    </td>
                    <td><?php echo htmlspecialchars(strtoupper($row['amend_by'])); ?></td>
                </tr>
            <?php 
                } 
            } else { 
            ?>
                <tr>
                    <td colspan="14" style="padding: 30px 10px !important;">
                        <div style="margin: 0 auto; width: 60%; padding: 12px; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 4px; color: #64748b; font-size: 13px; font-weight: 600;">
                            <i class="fa fa-info-circle" style="color: #0073B5; font-size: 15px; margin-right: 6px;"></i> No Amendments found...
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
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

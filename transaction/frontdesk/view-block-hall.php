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
$where = " where confirm_status='6' ";

if ($frDateParam != '' && $toDateParam != '') {
    $fr = explode('/', $frDateParam);
    $to = explode('/', $toDateParam);
    if (count($fr) == 3 && count($to) == 3) {
        $frm = $fr[2] . '-' . $fr[1] . '-' . $fr[0];
        $tod = $to[2] . '-' . $to[1] . '-' . $to[0];
        $where .= " AND str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' ";
    }
}

if ($valParam != '') {
    $v = mysql_real_escape_string($valParam);
    $where .= " AND (venue like '%$v%' OR session like '%$v%' OR booking_no like '%$v%' OR book_date like '%$v%') ";
}

// Count records
$countSql = mysql_query("select count(*) as total from bq_hallbooking $where");
$countRow = ($countSql && mysql_num_rows($countSql) > 0) ? mysql_fetch_array($countSql) : array();
$totalRecords = isset($countRow['total']) ? (int)$countRow['total'] : 0;

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
    return "view-block-hall.php?fromdate=" . urlencode($frDateParam) . "&todate=" . urlencode($toDateParam) . "&val=" . urlencode($valParam) . "&limit=" . $limit . "&page=" . $p;
}
?>
<link rel="stylesheet" href="<?php echo $home_path;?>/css/mypay-master.css">
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/js/shortcut.js"></script>

<style type="text/css">
/* Master View Styling for View Block Hall */
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
    min-width: 1000px !important;
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

.badge-status {
    display: inline-block !important;
    padding: 2px 8px !important;
    font-size: 11px !important;
    font-weight: bold !important;
    line-height: 1.2 !important;
    border-radius: 12px !important;
}

.badge-blocked {
    background-color: #fff3cd !important;
    color: #856404 !important;
    border: 1px solid #ffeeba !important;
}

/* Action buttons */
.mypay-actions-cell {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 6px !important;
}

.mypay-edit-btn {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    border: 1px solid #005b8a !important;
    border-radius: 3px !important;
    width: 26px !important;
    height: 26px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-decoration: none !important;
    font-size: 12px !important;
    transition: background-color 0.15s ease-in-out !important;
}

.mypay-edit-btn:hover {
    background-color: #005b8a !important;
    color: #ffffff !important;
}

.btn-release-action {
    background-color: #e74c3c !important;
    color: #ffffff !important;
    border: 1px solid #c0392b !important;
    border-radius: 3px !important;
    padding: 0 10px !important;
    height: 26px !important;
    line-height: 24px !important;
    font-size: 11.5px !important;
    font-weight: bold !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 4px !important;
    text-decoration: none !important;
    cursor: pointer !important;
    transition: background-color 0.15s ease-in-out !important;
}

.btn-release-action:hover {
    background-color: #c0392b !important;
    color: #ffffff !important;
    text-decoration: none !important;
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
        yearRange: "-5:+5",
        dateFormat: "dd/mm/yy"
    });

    $(".datepicker1").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-5:+5",
        dateFormat: "dd/mm/yy"
    });

    $("#msgFo").fadeOut(5000);

    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+A", function() { 
            window.location.href = "block_halls.php";
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
    var todate   = $('#to_date').val() || '';
    var val      = $('#searchTxt').val().trim();
    var limit    = $('#limitSelect').val() || '10';
    document.location.href = "view-block-hall.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&val=" + encodeURIComponent(val) + "&limit=" + encodeURIComponent(limit) + "&page=1";
}

function changeLimit(lim) {
    var fromdate = $('#from_date').val() || '';
    var todate   = $('#to_date').val() || '';
    var val      = $('#searchTxt').val().trim();
    document.location.href = "view-block-hall.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&val=" + encodeURIComponent(val) + "&limit=" + encodeURIComponent(lim) + "&page=1";
}

function srcSub(){
    document.location.href = "view-block-hall.php";
}

function printPage(){
    var divContents = $("#dvContainer").html();
    var printWindow = window.open('', '', 'height=600,width=1000');
    printWindow.document.write('<html><head><title>View Block Hall Details</title>');
    printWindow.document.write('<style>table {width:100%;border-collapse:collapse;font-family:Arial,sans-serif;font-size:12px;} th, td {border:1px solid #ccc;padding:6px;text-align:center;} th {background-color:#0073B5;color:#fff;} th.banner-row th {font-size:13px;} .mypay-actions-cell {display:none;}</style>');
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
            <label id="msgFo" style="color:#28a745;font-weight:bold;font-size:13px;"><?php echo htmlspecialchars($_GET['msg']); ?></label>
        </p>
    <?php } ?>

    <!-- Top Action & Filter Bar Matching Master Style -->
    <div class="mypay-actions-bar">
        <div class="mypay-filter-group">
            <span class="mypay-filter-label">From:</span>
            <input name="from_date" type="text" class="mypay-date-input datepicker" id="from_date" value="<?php echo htmlspecialchars($frDateParam); ?>" placeholder="From Date" autocomplete="off" />
            
            <span class="mypay-filter-label" style="margin-left:4px;">To:</span>
            <input name="to_date" type="text" class="mypay-date-input datepicker1" id="to_date" value="<?php echo htmlspecialchars($toDateParam); ?>" placeholder="To Date" autocomplete="off" />
            
            <input type="text" id="searchTxt" name="searchTxt" class="mypay-search-input" placeholder="Search Venue / Session / Booking#" value="<?php if($valParam != '') { echo htmlspecialchars($valParam); } ?>" />
            
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
            <a href="block_halls.php" class="btn-mypay-add" id="add" title="Add Block Halls (Ctrl+A)">
                <span class="mypay-icon-plus"><i class="fa fa-plus"></i></span>
                <span>Add Block Halls</span>
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
                    <th colspan="9">VIEW BLOCK HALL DETAILS</th>
                </tr>
                <tr class="header-row">
                    <th style="width: 4%;">Sl.no</th>
                    <th style="width: 10%;">Booking No</th>
                    <th style="width: 12%;">Blocked Date</th>
                    <th style="width: 20%;">Venue</th>
                    <th style="width: 14%;">Session</th>
                    <th style="width: 10%;">From Time</th>
                    <th style="width: 10%;">To Time</th>
                    <th style="width: 8%;">Status</th>
                    <th style="width: 12%;">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $sql = mysql_query("select * from bq_hallbooking $where order by hallbook_id desc LIMIT $offset, $limit");
            $x = $offset;

            if($sql && is_resource($sql) && mysql_num_rows($sql) > 0) {
                while($row = mysql_fetch_array($sql)) {
                    $x++;
                    $hallbook_id = $row['hallbook_id'];
                    $editUrl = "edit_block_hall.php?id=" . urlencode($hallbook_id);
                    $releaseUrl = $home_path . "/action/release-blockhalls.php?hallbook_id=" . urlencode($hallbook_id) . "&venue=" . urlencode($row['venue']) . "&session=" . urlencode($row['session']) . "&book_date=" . urlencode($row['book_date']);
            ?>
                <tr>
                    <td><?php echo $x; ?></td>
                    <td><b><?php echo htmlspecialchars(strtoupper($row['booking_no'])); ?></b></td>
                    <td><?php echo htmlspecialchars($row['book_date']); ?></td>
                    <td><b><?php echo htmlspecialchars(strtoupper($row['venue'])); ?></b></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['session'])); ?></td>
                    <td><?php echo htmlspecialchars($row['from_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['to_time']); ?></td>
                    <td><span class="badge-status badge-blocked">Blocked</span></td>
                    <td>
                        <div class="mypay-actions-cell">
                            <a href="<?php echo $editUrl; ?>" class="mypay-edit-btn" title="Edit Block Hall">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                            <a href="<?php echo $releaseUrl; ?>" class="btn-release-action" onclick="return confirm('Do you want to release this blocked hall?');" title="Release Hall">
                                <i class="fa fa-unlock"></i> Release
                            </a>
                        </div>
                    </td>
                </tr>
            <?php 
                } 
            } else { 
            ?>
                <tr>
                    <td colspan="9" style="padding: 24px 10px !important; color: #777777; text-align: center; font-size: 13px;">
                        No Blocked Halls found
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
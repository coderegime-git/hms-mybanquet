<?php
error_reporting(0);
ob_start();
include("../../config.php");
include("../../header.php");
?>

<link href="<?php echo $home_path; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script src="../../js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo $home_path; ?>/js/shortcut.js"></script>

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

/* Action & Search Bar on Top */
.mypay-actions-bar {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    gap: 10px !important;
    margin-bottom: 10px !important;
    flex-wrap: wrap !important;
}

.mypay-filter-group {
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
}

.mypay-search-input {
    width: 270px !important;
    height: 28px !important;
    line-height: 28px !important;
    padding: 0 10px !important;
    border: 1px solid #c0c8d0 !important;
    border-radius: 3px !important;
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
    box-shadow: 0 0 3px rgba(0, 132, 180, 0.3) !important;
}

.btn-mypay-search {
    background-color: #0084b4 !important;
    color: #ffffff !important;
    border: 1px solid #00739c !important;
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

.btn-mypay-search:hover {
    background-color: #00739c !important;
    color: #ffffff !important;
}

.btn-mypay-reset {
    background-color: #f6f8fa !important;
    color: #57606a !important;
    border: 1px solid #d0d7de !important;
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
    background-color: #e9ecef !important;
    color: #24292f !important;
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

/* View Data Table Matching Refund Advance */
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

/* Action Icons */
.btn-mypay-action-icon {
    font-size: 15px !important;
    display: inline-block !important;
    line-height: 1 !important;
    text-decoration: none !important;
    cursor: pointer !important;
    transition: transform 0.15s ease, color 0.15s ease !important;
    padding: 2px 4px !important;
}

.btn-mypay-action-icon:hover {
    transform: scale(1.2) !important;
    text-decoration: none !important;
}

.icon-create {
    color: #28a745 !important;
}
.icon-create:hover {
    color: #218838 !important;
}

.icon-edit {
    color: #0073B5 !important;
}
.icon-edit:hover {
    color: #005b8a !important;
}

.icon-print {
    color: #333333 !important;
}
.icon-print:hover {
    color: #000000 !important;
}

.icon-cancel {
    color: #d9534f !important;
}
.icon-cancel:hover {
    color: #c9302c !important;
}

.icon-disabled {
    color: #bcc4bf !important;
    font-size: 15px !important;
    cursor: not-allowed !important;
    display: inline-block !important;
    padding: 2px 4px !important;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
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
    var srtx = encodeURIComponent($('#searchTxt').val().trim());
    document.location.href = "view-fb-creation-chk.php?val=" + srtx;
}

function srcSub(){
    document.location.href = "view-fb-creation-chk.php";
}

function fpcancel(a, e){
    var fpNum = a;
    var bkno = e;
    swal({
        title: "Do You Want To Cancel FP?",
        text: "FP NO: " + fpNum,
        icon: "warning",
        buttons: {
            cancel: "No",
            confirm: "Yes"
        }
    })
    .then(function (isOkay) {
        if (isOkay) {
            document.location.href = "<?php echo $home_path;?>/action/cancel-fp-creation.php?fpNum=" + encodeURIComponent(fpNum) + "&bkno=" + encodeURIComponent(bkno);
        }
    });
    return false;
}
</script>

<body class="bgBODY">

<?php if(isset($_GET['msg'])){ ?>
<script type="text/javascript">
$(document).ready(function(){
    var fpNum = $('#fpNum').val();
    swal({
        title: "Do You Want To Print FP?",
        text: "FP NO: <?php echo htmlspecialchars($_GET['fpNum']); ?>",
        icon: "warning",
        buttons: {
            cancel: "No",
            confirm: "Yes"
        }
    })
    .then(function (isOkay) {
        if (isOkay) {
            window.open('../view/print-fp-creation.php?fpNum=' + encodeURIComponent(fpNum));
        }
    });
});
</script>
<?php } ?>

<?php if(isset($_GET['cmsg'])){ ?>
<script type="text/javascript">
$(document).ready(function(){
    swal({
        title: "FP: <?php echo htmlspecialchars($_GET['fpNum']); ?> Cancelled",
        icon: "warning",
        buttons: {
            confirm: "OK"
        }
    });
});
</script>
<?php } ?>

<input id="fpNum" type="hidden" value="<?php echo htmlspecialchars($_GET['fpNum']); ?>" /> 
<input id="msg" type="hidden" value="<?php echo htmlspecialchars($_GET['msg']); ?>" /> 

<div class="mypay-container">

    <!-- Top Action & Search Bar -->
    <div class="mypay-actions-bar">
        <div class="mypay-filter-group">
            <input type="text" id="searchTxt" name="searchTxt" class="mypay-search-input" placeholder="Guest Name / Function Date / Booking No" value="<?php echo isset($_GET['val']) ? htmlspecialchars($_GET['val']) : ''; ?>" />
            <button type="button" id="submt" class="btn-mypay-search" onclick="clkSubmit()" title="Display Records">
                <i class="fa fa-search"></i> <span>Display</span>
            </button>
            <?php if(isset($_GET['val']) && $_GET['val'] != ''){ ?>
            <button type="button" class="btn-mypay-reset" onclick="srcSub()" title="Clear Filter">
                <i class="fa fa-times"></i> <span>Clear</span>
            </button>
            <?php } ?>
        </div>

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
                    <th colspan="13">VIEW FUNCTION PROSPECTUS CREATION DETAILS</th>
                </tr>
                <tr class="header-row">
                    <th style="width: 4%;">Sl.No</th>
                    <th style="width: 9%;">Booking No#</th>
                    <th style="width: 5%;">Id#</th>
                    <th style="width: 18%;">Guest Name</th>
                    <th style="width: 12%;">Venue</th>
                    <th style="width: 8%;">Session</th>
                    <th style="width: 9%;">Function Date</th>
                    <th style="width: 6%;">Create</th>
                    <th style="width: 5%;">Edit</th>
                    <th style="width: 5%;">Print</th>
                    <th style="width: 6%;">FP Cancel</th>
                    <th style="width: 7%;">Created By</th>
                    <th style="width: 6%;">Created On</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $sqlAC = mysql_query("select * from audt_control where audtcontrol_id='1'");
            $rowAC = mysql_fetch_array($sqlAC);
            $adtCurDt = trim($rowAC['cur_date']);
            $ad = explode('/', $adtCurDt);
            $cur = $ad[2] . '-' . $ad[1] . '-' . $ad[0];

            $val = isset($_GET['val']) ? trim($_GET['val']) : '';

            if($val != ''){
                $safeVal = mysql_real_escape_string($val);
                $sql = mysql_query("select * from bq_hallbooking where (book_date = '$safeVal' or guest_name like '%$safeVal%' or booking_no like '%$safeVal%') and confirm_status='2' order by str_to_date(book_date,'%d/%m/%Y') ASC");
            } else {
                $sql = mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') >= '$cur' and confirm_status='2' order by str_to_date(book_date,'%d/%m/%Y') ASC");
            }

            $x = 0;
            if($sql && is_resource($sql) && mysql_num_rows($sql) > 0) {
                while($row = mysql_fetch_array($sql)) {
                    $x++;

                    $sqlC = mysql_fetch_array(mysql_query("select * from bq_opfpmenuhdr where bkno='" . mysql_real_escape_string($row['booking_no']) . "' and fpno='" . mysql_real_escape_string($row['fpno']) . "'"));

                    $sqlv = mysql_query("select * from bq_venue where venue_code='" . mysql_real_escape_string($row['venue']) . "' AND status ='1'");
                    $rov = mysql_fetch_array($sqlv);

                    $billtype = ($pid == '1') ? 'print-fp-creation.php' : 'print-fp-creation.php';
            ?>
                <tr>
                    <td><?php echo $x; ?></td>
                    <td><b><?php echo htmlspecialchars($row['booking_no']); ?></b></td>
                    <td><?php echo htmlspecialchars($row['hallbook_id']); ?></td>
                    <td style="text-align:left;"><?php echo htmlspecialchars(strtoupper($row['guest_name'])); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($rov['venue_desc'])); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['session'])); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['book_date'])); ?></td>
                    <td>
                        <?php if($sqlC['bill_status'] == 3 || $sqlC['bill_status'] == '') { ?>
                            <a href="<?php echo $home_path;?>/transaction/frontdesk/fp_creation.php?bkNo=<?php echo urlencode($row['booking_no']);?>&bid=<?php echo urlencode($row['hallbook_id']);?>" class="btn-mypay-action-icon icon-create" title="Create FP">
                                <i class="fa fa-plus-square"></i>
                            </a>
                        <?php } else { ?>
                            <i class="fa fa-plus-square icon-disabled" title="FP Already Created"></i>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($sqlC['bill_status'] == 1) { ?>
                            <a href="<?php echo $home_path;?>/transaction/frontdesk/edit-fp-creation.php?fpNo=<?php echo urlencode($row['fpno']);?>" class="btn-mypay-action-icon icon-edit" title="Edit FP">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                        <?php } else { ?>
                            <i class="fa fa-pencil-square-o icon-disabled" title="Edit Disabled"></i>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if(!empty($row['fpno'])){ ?>
                            <a href="<?php echo $home_path;?>/transaction/view/<?php echo $billtype; ?>?fpNum=<?php echo urlencode($row['fpno']);?>" target="_blank" class="btn-mypay-action-icon icon-print" title="Print FP">
                                <i class="fa fa-print"></i>
                            </a>
                        <?php } else { ?>
                            <i class="fa fa-print icon-disabled" title="Print Disabled"></i>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($sqlC['bill_status'] == 1) { ?>
                            <a onclick="fpcancel('<?php echo htmlspecialchars($row['fpno']); ?>','<?php echo htmlspecialchars($row['booking_no']); ?>');" class="btn-mypay-action-icon icon-cancel" title="Cancel FP">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        <?php } else { ?>
                            <i class="fa fa-trash-o icon-disabled" title="Cancel Disabled"></i>
                        <?php } ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['added_by']); ?></td>
                    <td><?php echo htmlspecialchars($row['added_on']); ?></td>
                </tr>
            <?php 
                } 
            } else { 
            ?>
                <tr>
                    <td colspan="13" style="padding: 20px; color: #777; text-align: center; font-size: 13px;">
                        No Function Prospectus records found
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
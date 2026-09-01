<?php
ob_start();
error_reporting(0);
include("../../config.php");
include("../../header.php");
?>
<!-- Form validation & plugins -->
<link rel="stylesheet" href="../../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="../../js/sweetalert.min.js"></script>

<style type="text/css">
/* Standardized Master / Transaction View Styling */
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

.mypay-search-box {
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
}

.mypay-search-input {
    width: 300px !important;
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
    min-width: 1600px !important;
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

/* Pay Action Button */
.btn-mypay-pay {
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

.btn-mypay-pay:hover {
    background-color: #005b8a !important;
    color: #ffffff !important;
}

.btn-mypay-pay-disabled {
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

/* Status Badge Styling */
.badge-status {
    display: inline-block !important;
    padding: 2px 8px !important;
    font-size: 10px !important;
    font-weight: bold !important;
    line-height: 1.2 !important;
    border-radius: 10px !important;
    text-align: center !important;
    letter-spacing: 0.3px !important;
    white-space: nowrap !important;
}

.badge-confirm {
    background-color: #e6f9ed !important;
    color: #1a7f37 !important;
    border: 1px solid #abefc6 !important;
}

.badge-tentative {
    background-color: #fff8c5 !important;
    color: #9a6700 !important;
    border: 1px solid #d4a72c !important;
}

.badge-blocked {
    background-color: #fbeae9 !important;
    color: #cf222e !important;
    border: 1px solid #f7c3c0 !important;
}

.badge-other {
    background-color: #f0f3f6 !important;
    color: #57606a !important;
    border: 1px solid #d0d7de !important;
}
</style>

<script>
jQuery(document).ready(function(){
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
    document.location = "view-hall-advance.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&val=" + encodeURIComponent(srtx);
}

function srcSub(){
    $('#from_date').val('');
    $('#to_date').val('');
    $('#searchTxt').val('');
}
</script>

<body class="bgBODY">

<?php if(isset($_GET['msg'])){ ?>
<input id="rserNo" value="<?php echo htmlspecialchars($_GET['rserNo']); ?>" type="hidden" /> 
<input id="rcptNo" value="<?php echo htmlspecialchars($_GET['rcptNo']); ?>" type="hidden" /> 
<script>
$(document).ready(function(){
    var rserNo = $('#rserNo').val();
    var rcptNo = $('#rcptNo').val();
    swal({
        title: "Do You Want To Print Advance?",
        text: "Advance No: <?php echo htmlspecialchars($_GET['rcptNo']); ?>",
        icon: "warning",
        buttons: {
            cancel: true,
            confirm: "Yes",
        },
    }).then(function (isOkay) {
        if (isOkay) {
            window.open('../view/print-HallReserv-advance.php?rserNo=' + encodeURIComponent(rserNo) + '&rcptNo=' + encodeURIComponent(rcptNo) + '&_blank', 'printWin', 'width=1000,height=700');
        }
    });
});
</script>
<?php } ?>

<div class="mypay-container">

    <!-- Top Action and Search Bar -->
    <div class="mypay-actions-bar">
        <div class="mypay-search-box">
            <input type="text" id="searchTxt" name="searchTxt" class="mypay-search-input" placeholder="Enter Guest name / Phone / Venue / Booking#" value="<?php if(isset($_GET['val'])) { echo htmlspecialchars($_GET['val']); } ?>" onkeypress="if(event.keyCode==13){ clkSubmit(); return false; }" />
            <button type="button" name="submt" id="submt" class="btn-mypay-search" onclick="clkSubmit();">
                <i class="fa fa-search"></i> Search
            </button>
            <?php if(isset($_GET['val']) && trim($_GET['val']) != '') { ?>
                <a href="view-hall-advance.php" class="btn-mypay-search" style="background:#6c757d;border-color:#5a6268;text-decoration:none;">Reset</a>
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
                    <th colspan="21">VIEW HALL ADVANCE DETAILS</th>
                </tr>
                <tr class="header-row">
                    <th style="width: 3%;">Sl.No</th>
                    <th style="width: 5%;">Booking#</th>
                    <th style="width: 5%;">Booking Date</th>
                    <th style="width: 5%;">Fn Date</th>
                    <th style="width: 8%;">Guest Name</th>
                    <th style="width: 7%;">Venue</th>
                    <th style="width: 5%;">Session</th>
                    <th style="width: 4%;">From</th>
                    <th style="width: 4%;">To</th>
                    <th style="width: 6%;">Function</th>
                    <th style="width: 5%;">Phone</th>
                    <th style="width: 6%;">Email</th>
                    <th style="width: 6%;">Company</th>
                    <th style="width: 5%;">Booked by</th>
                    <th style="width: 5%;">Booker No</th>
                    <th style="width: 4%;">Adv</th>
                    <th style="width: 5%;">Receipt No</th>
                    <th style="width: 5%;">Receipt Date</th>
                    <th style="width: 4%;">Pay Mode</th>
                    <th style="width: 5%;">Status</th>
                    <th style="width: 4%;">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $sqlAC = mysql_query("select * from audt_control where audtcontrol_id='1'");
            $rowAC = mysql_fetch_array($sqlAC);
            $adtCurDt = $rowAC['cur_date'];
            $ad = array_map('trim', explode('/', $adtCurDt));
            $cur = $ad[2] . '/' . $ad[1] . '/' . $ad[0];
            $cdate = $ad[2] . '-' . $ad[1] . '-' . $ad[0];

            if(isset($_GET['val']) && trim($_GET['val']) != '') {
                $val_esc = mysql_real_escape_string(trim($_GET['val']));
                $item_where = " where (guest_name like '%$val_esc%' OR phone like '%$val_esc%' OR venue like '%$val_esc%' OR booking_no like '%$val_esc%') AND confirm_status!='1' AND confirm_status!='7' AND str_to_date(book_date,'%d/%m/%Y') >= '$cdate' order by str_to_date(book_date,'%d/%m/%Y') ASC";
                $sql = mysql_query("select * from bq_hallbooking $item_where");
            } else {
                $sql = mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') >= '$cdate' AND confirm_status!='7' AND confirm_status!='1' order by str_to_date(book_date,'%d/%m/%Y') ASC"); 
            }

            $sqlRv = mysql_query("select * from bq_stscolor where roomoccupy_id='1'");
            $rowRv = ($sqlRv && mysql_num_rows($sqlRv) > 0) ? mysql_fetch_array($sqlRv) : array(); 
            $sqlRd = mysql_query("select * from bq_stscolor where roomoccupy_id='2'");
            $rowRd = ($sqlRd && mysql_num_rows($sqlRd) > 0) ? mysql_fetch_array($sqlRd) : array();
            $sqlRo = mysql_query("select * from bq_stscolor where roomoccupy_id='3'");
            $rowRo = ($sqlRo && mysql_num_rows($sqlRo) > 0) ? mysql_fetch_array($sqlRo) : array(); 
            $sqlRg = mysql_query("select * from bq_stscolor where roomoccupy_id='4'");
            $rowRg = ($sqlRg && mysql_num_rows($sqlRg) > 0) ? mysql_fetch_array($sqlRg) : array();
            $sqlRm = mysql_query("select * from bq_stscolor where roomoccupy_id='5'");
            $rowRm = ($sqlRm && mysql_num_rows($sqlRm) > 0) ? mysql_fetch_array($sqlRm) : array();
            $sqlRe = mysql_query("select * from bq_stscolor where roomoccupy_id='6'");
            $rowbl = ($sqlRe && mysql_num_rows($sqlRe) > 0) ? mysql_fetch_array($sqlRe) : array();

            $x = 0;
            $hasRows = false;

            if($sql && is_resource($sql) && mysql_num_rows($sql) > 0) {
                while($row = mysql_fetch_array($sql)) {
                    $sqS = mysql_query("select bkno from bq_opbillstldtl where bkno='" . $row['booking_no'] . "' AND settleflag='1'");
                    if(mysql_num_rows($sqS) > 0) {
                        continue; // Skip settled bills
                    }

                    $hasRows = true;
                    $x++;

                    $rmAVai = 'Unassigned';
                    $badgeClass = 'badge-other';
                    if($row['confirm_status'] == 1) {
                        $rmAVai = isset($rowRv['room_availability']) ? $rowRv['room_availability'] : 'Unassigned';
                        $badgeClass = 'badge-other';
                    } else if($row['confirm_status'] == 2) {
                        $rmAVai = isset($rowRd['room_availability']) ? $rowRd['room_availability'] : 'Confirmed';
                        $badgeClass = 'badge-confirm';
                    } else if($row['confirm_status'] == 3) {
                        $rmAVai = isset($rowRo['room_availability']) ? $rowRo['room_availability'] : 'Tentative';
                        $badgeClass = 'badge-tentative';
                    } else if($row['confirm_status'] == 4) {
                        $rmAVai = isset($rowRg['room_availability']) ? $rowRg['room_availability'] : 'Guaranteed';
                        $badgeClass = 'badge-confirm';
                    } else if($row['confirm_status'] == 5) {
                        $rmAVai = isset($rowRm['room_availability']) ? $rowRm['room_availability'] : 'Maintenance';
                        $badgeClass = 'badge-blocked';
                    } else if($row['confirm_status'] == 6) {
                        $rmAVai = isset($rowbl['room_availability']) ? $rowbl['room_availability'] : 'Blocked';
                        $badgeClass = 'badge-blocked';
                    }

                    $bk = array_map('trim', explode('/', $row['book_date']));
                    $bkD = $bk[2] . '-' . $bk[1] . '-' . $bk[0];

                    // Fetch receipts
                    $receipts = array();
                    $sqlR = mysql_query("select * from bq_hallresvadv where booking_no='" . $row['booking_no'] . "' AND status='1'");
                    if($sqlR && is_resource($sqlR)) {
                        while($rRow = mysql_fetch_array($sqlR)) {
                            $receipts[] = $rRow;
                        }
                    }

                    $rcptCount = count($receipts);
                    $rowspan = ($rcptCount > 0) ? $rcptCount : 1;
                    $canPay = ($row['confirm_status'] == "2" && strtotime($bkD) >= strtotime($cur));
            ?>
                <tr>
                    <td rowspan="<?php echo $rowspan; ?>"><?php echo $x; ?></td>
                    <td rowspan="<?php echo $rowspan; ?>"><b><?php echo htmlspecialchars($row['booking_no']); ?></b></td>
                    <td rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars($row['audit_date']); ?></td>
                    <td rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars($row['book_date']); ?></td>
                    <td style="text-align:left;" rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars(strtoupper($row['guest_name'])); ?></td>
                    <td style="text-align:left;" rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars(strtoupper($row['venue'])); ?></td>
                    <td style="text-align:left;" rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars(strtoupper($row['session'])); ?></td>
                    <td rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars($row['from_time']); ?></td>
                    <td rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars($row['to_time']); ?></td>
                    <td style="text-align:left;" rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars(strtoupper($row['funct'])); ?></td>
                    <td rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td style="text-align:left;" rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars($row['email']); ?></td>
                    <td style="text-align:left;" rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars(strtoupper($row['company_name'])); ?></td>
                    <td style="text-align:left;" rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars(strtoupper($row['contact_person'])); ?></td>
                    <td rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars($row['contact_mobile']); ?></td>

                    <?php if($rcptCount > 0) { ?>
                        <td><?php echo sprintf("%01.2f", $receipts[0]['netamt']); ?></td>
                        <td><?php echo htmlspecialchars($receipts[0]['receipt_no']); ?></td>
                        <td><?php echo htmlspecialchars($receipts[0]['cur_date']); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst($receipts[0]['pay_mode'])); ?></td>
                        <td><span class="badge-status <?php echo $badgeClass; ?>"><?php echo strtoupper($rmAVai); ?></span></td>
                        <td rowspan="<?php echo $rowspan; ?>">
                            <?php if($canPay) { ?>
                                <a href="reserv-hall-advance.php?roomBk=<?php echo urlencode($row['booking_no']); ?>&rmBkID=<?php echo urlencode($row['hallbook_id']); ?>" class="btn-mypay-pay">Pay</a>
                            <?php } else { ?>
                                <span class="btn-mypay-pay-disabled">Pay</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php for($i = 1; $i < $rcptCount; $i++) { ?>
                    <tr>
                        <td><?php echo sprintf("%01.2f", $receipts[$i]['netamt']); ?></td>
                        <td><?php echo htmlspecialchars($receipts[$i]['receipt_no']); ?></td>
                        <td><?php echo htmlspecialchars($receipts[$i]['cur_date']); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst($receipts[$i]['pay_mode'])); ?></td>
                        <td><span class="badge-status <?php echo $badgeClass; ?>"><?php echo strtoupper($rmAVai); ?></span></td>
                    </tr>
                    <?php } ?>

                    <?php } else { ?>
                        <td>0.00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td><span class="badge-status <?php echo $badgeClass; ?>"><?php echo strtoupper($rmAVai); ?></span></td>
                        <td>
                            <?php if($canPay) { ?>
                                <a href="reserv-hall-advance.php?roomBk=<?php echo urlencode($row['booking_no']); ?>&rmBkID=<?php echo urlencode($row['hallbook_id']); ?>" class="btn-mypay-pay">Pay</a>
                            <?php } else { ?>
                                <span class="btn-mypay-pay-disabled">Pay</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>

            <?php 
                }
            }

            if(!$hasRows) {
            ?>
                <tr>
                    <td colspan="21" style="padding: 20px; color: #777; text-align: center; font-size: 13px;">
                        No Hall Advance records found
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
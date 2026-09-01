<?php
ob_start();
error_reporting(0);
include("../../config.php");
include("../../header.php");
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
    width: 260px !important;
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

.btn-mypay-excel {
    background-color: #28a745 !important;
    color: #ffffff !important;
    border: 1px solid #1e7e34 !important;
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

.btn-mypay-excel:hover {
    background-color: #218838 !important;
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

.btn-mypay-print-row {
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

.btn-mypay-print-row:hover {
    background-color: #005b8a !important;
    color: #ffffff !important;
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
        shortcut.add("Ctrl+E", function() { 
            window.location.href = "<?php echo $home_path; ?>/dashboard.php";
        }); 
    }
});

function clkSubmit() {
    var fromdate = $('#from_date').val() || '';
    var todate = $('#to_date').val() || '';
    var srtx = $('#searchTxt').val().trim();
    document.location = "view-duplicateHall-advance.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&val=" + encodeURIComponent(srtx);
}

function opnDupADv(a, b, c){
    window.open('<?php echo $home_path;?>/transaction/view/print-HallReserv-advance.php?rserNo=' + encodeURIComponent(a) + '&rcptNo=' + encodeURIComponent(b) + '&sts=' + encodeURIComponent(c), '_blank', 'width=1000,height=700');
}
</script>

<body class="bgBODY">

<div class="mypay-container">

    <!-- Top Action and Search Bar -->
    <div class="mypay-actions-bar">
        <div class="mypay-filter-group">
            <span style="font-weight:bold;font-size:12px;">From:</span>
            <input name="from_date" type="text" class="mypay-date-input datepicker" id="from_date" value="<?php if(isset($_GET['fromdate'])){ echo htmlspecialchars($_GET['fromdate']); } ?>" placeholder="From Date" />
            <span style="font-weight:bold;font-size:12px;margin-left:4px;">To:</span>
            <input name="to_date" type="text" class="mypay-date-input datepicker1" id="to_date" value="<?php if(isset($_GET['todate'])){ echo htmlspecialchars($_GET['todate']); } ?>" placeholder="To Date" />
            <input type="text" id="searchTxt" name="searchTxt" class="mypay-search-input" placeholder="Enter Guest name / Bill# / Booking# / Receipt#" value="<?php if(isset($_GET['val'])) { echo htmlspecialchars($_GET['val']); } ?>" onkeypress="if(event.keyCode==13){ clkSubmit(); return false; }" />
            <button type="button" name="submt" id="submt" class="btn-mypay-search" onclick="clkSubmit();">
                <i class="fa fa-search"></i> Search
            </button>
            <a href="<?php echo $home_path ?>/reports/checkout/xt_viewDUpHAllADV-xls.php?fromdate=<?php echo urlencode($_GET['fromdate']); ?>&todate=<?php echo urlencode($_GET['todate']); ?>&val=<?php echo urlencode($_GET['val']); ?>" class="btn-mypay-excel">
                <i class="fa fa-file-excel-o"></i> Export
            </a>
            <?php if((isset($_GET['val']) && trim($_GET['val']) != '') || (isset($_GET['fromdate']) && trim($_GET['fromdate']) != '')) { ?>
                <a href="view-duplicateHall-advance.php" class="btn-mypay-search" style="background:#6c757d;border-color:#5a6268;text-decoration:none;">Reset</a>
            <?php } ?>
        </div>

        <div>
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
                    <th colspan="17">VIEW DUPLICATE HALL ADVANCE</th>
                </tr>
                <tr class="header-row">
                    <th style="width: 3%;">Sl.No</th>
                    <th style="width: 6%;">Booking#</th>
                    <th style="width: 5%;">Receipt Date</th>
                    <th style="width: 6%;">Receipt No</th>
                    <th style="width: 6%;">Bill No</th>
                    <th style="width: 5%;">Bill Date</th>
                    <th style="width: 10%;">Guest Name</th>
                    <th style="width: 8%;">Venue</th>
                    <th style="width: 6%;">Function Date</th>
                    <th style="width: 6%;">Phone</th>
                    <th style="width: 8%;">Contact Person</th>
                    <th style="width: 6%;">Contact Mobile</th>
                    <th style="width: 5%;">Adv Amount</th>
                    <th style="width: 5%;">Pay Mode</th>
                    <th style="width: 7%;">Remarks</th>
                    <th style="width: 5%;">User</th>
                    <th style="width: 4%;">Print</th>
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
                $val_esc = mysql_real_escape_string(trim($_GET['val']));
                $item_where = " where str_to_date(cur_date,'%d/%m/%Y') >= '$frm' AND str_to_date(cur_date,'%d/%m/%Y') <= '$tod' AND (guest_name like '%$val_esc%' OR booking_no like '%$val_esc%' OR receipt_no like '%$val_esc%') AND status!='3' order by str_to_date(cur_date,'%d/%m/%Y') ASC";
            } else if($frm != '' && $tod != '') {
                $item_where = " where str_to_date(cur_date,'%d/%m/%Y') >= '$frm' AND str_to_date(cur_date,'%d/%m/%Y') <= '$tod' AND status!='3' order by str_to_date(cur_date,'%d/%m/%Y') ASC";
            } else if(isset($_GET['val']) && trim($_GET['val']) != '') {
                $val_esc = mysql_real_escape_string(trim($_GET['val']));
                $item_where = " where (guest_name like '%$val_esc%' OR booking_no like '%$val_esc%' OR receipt_no like '%$val_esc%') AND status!='3' order by str_to_date(cur_date,'%d/%m/%Y') ASC";
            } else {
                $item_where = " where status!='3' order by str_to_date(cur_date,'%d/%m/%Y') DESC";
            }

            $sql = mysql_query("select * from bq_hallresvadv $item_where");
            $x = 0;
            if($sql && is_resource($sql) && mysql_num_rows($sql) > 0) {
                while($row = mysql_fetch_array($sql)) {
                    $x++;
                    $rw = mysql_fetch_array(mysql_query("select * from bq_hallbooking where hallbook_id='".$row['hallbook_id']."'"));
                    $rwHh = mysql_query("select * from bq_opbillstldtl where hallbook_id='".$row['hallbook_id']."'");
                    if($rwHh && mysql_num_rows($rwHh) > 0) {
                        $rwH = mysql_fetch_array($rwHh);
                    } else {
                        $rwH = mysql_fetch_array(mysql_query("select * from bq_opbillstldtl where bkno='".$row['booking_no']."'"));	
                    }
                    $advTot = $row['amount'] + $row['sgst'] + $row['cgst'];
            ?>
                <tr>
                    <td><?php echo $x; ?></td>
                    <td><b><?php echo htmlspecialchars($row['booking_no']); ?></b></td>
                    <td><?php echo htmlspecialchars($row['cur_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['receipt_no']); ?></td>
                    <td><?php echo isset($rwH['bill_no']) ? htmlspecialchars($rwH['bill_no']) : '-'; ?></td>
                    <td><?php echo isset($rwH['bill_date']) ? htmlspecialchars($rwH['bill_date']) : '-'; ?></td>
                    <td style="text-align:left;"><?php echo htmlspecialchars(strtoupper($row['guest_name'])); ?></td>
                    <td style="text-align:left;"><?php echo isset($rw['venue']) ? htmlspecialchars(strtoupper($rw['venue'])) : ''; ?></td>
                    <td><?php echo htmlspecialchars($row['function_date']); ?></td>
                    <td><?php echo isset($rw['phone']) ? htmlspecialchars($rw['phone']) : ''; ?></td>
                    <td style="text-align:left;"><?php echo isset($rw['contact_person']) ? htmlspecialchars(strtoupper($rw['contact_person'])) : ''; ?></td>
                    <td><?php echo isset($rw['contact_mobile']) ? htmlspecialchars($rw['contact_mobile']) : ''; ?></td>
                    <td><?php echo sprintf("%01.2f", $advTot); ?></td>
                    <td><?php echo htmlspecialchars(ucfirst($row['pay_mode'])); ?></td>
                    <td style="text-align:left;"><?php echo htmlspecialchars(ucfirst($row['remarks'])); ?></td>
                    <td><?php echo htmlspecialchars(ucfirst($row['added_by'])); ?></td>
                    <td>
                        <button type="button" class="btn-mypay-print-row" onclick="opnDupADv('<?php echo htmlspecialchars($row['booking_no']); ?>','<?php echo htmlspecialchars($row['receipt_no']); ?>','<?php echo isset($rw['confirm_status']) ? htmlspecialchars($rw['confirm_status']) : ''; ?>');">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </td>
                </tr>
            <?php 
                } 
            } else { 
            ?>
                <tr>
                    <td colspan="17" style="padding: 20px; color: #777; text-align: center; font-size: 13px;">
                        No Duplicate Hall Advance records found
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
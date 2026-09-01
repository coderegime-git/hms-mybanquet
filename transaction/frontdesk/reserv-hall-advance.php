<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../util.php");
?>
<!-- Form validation -->
<link rel="stylesheet" href="../../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">

<style type="text/css">
body, body.bgBODY {
    background-color: #ffffff !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    margin: 0 !important;
    padding: 0 !important;
}

.mypay-container {
    width: 100% !important;
    max-width: 100% !important;
    margin: 20px auto 40px auto !important;
    padding: 0 15px !important;
    box-sizing: border-box !important;
}

/* Centered Form Card Matching Master Design */
.mypay-card {
    width: 780px !important;
    max-width: 95% !important;
    margin: 0 auto !important;
    background: #ffffff !important;
    border: 1px solid #0073B5 !important;
    border-radius: 6px !important;
    overflow: hidden !important;
    box-shadow: none !important;
    padding: 0 !important;
}

.mypay-card-header {
    background: #0073B5 !important;
    color: #ffffff !important;
    text-align: center !important;
    height: 38px !important;
    line-height: 38px !important;
    padding: 0 15px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-weight: bold !important;
    font-size: 13px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    margin: 0 !important;
    border: none !important;
    border-radius: 5px 5px 0 0 !important;
}

.mypay-card-body {
    padding: 22px 35px !important;
    background: #ffffff !important;
    margin: 0 !important;
}

.mypay-form-table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 12px !important;
    border: none !important;
    margin: 0 !important;
    padding: 0 !important;
}

.mypay-form-table tr,
.mypay-form-table td {
    border: none !important;
    background: transparent !important;
    padding: 0 !important;
    vertical-align: middle !important;
}

.mypay-form-table td.mypay-label-cell {
    width: 28% !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #222222 !important;
    font-weight: normal !important;
    padding-right: 15px !important;
    text-align: left !important;
    line-height: 1.2 !important;
}

.mypay-form-table td.mypay-label-cell label {
    margin: 0 !important;
    padding: 0 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #222222 !important;
    font-weight: normal !important;
    display: inline-block !important;
}

.mypay-form-table td.mypay-label-cell label .req-star {
    color: #d9534f !important;
    font-style: normal !important;
    margin-left: 1px !important;
    font-weight: bold !important;
}

.mypay-form-table td.mypay-input-cell {
    width: 72% !important;
}

.mypay-input {
    width: 100% !important;
    height: 30px !important;
    line-height: 30px !important;
    padding: 0 10px !important;
    border: 1px solid #d0d7de !important;
    border-radius: 4px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #333333 !important;
    background: #ffffff !important;
    box-sizing: border-box !important;
    outline: none !important;
    box-shadow: none !important;
    margin: 0 !important;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
}

.mypay-input:focus {
    border-color: #0084b4 !important;
    box-shadow: 0 0 3px rgba(0, 132, 180, 0.3) !important;
}

.mypay-input[readonly], .mypay-input[disabled] {
    background-color: #f6f8fa !important;
    color: #57606a !important;
    cursor: not-allowed !important;
}

/* Card Bottom Action Bar */
.mypay-card-footer {
    background: #0073B5 !important;
    height: 44px !important;
    padding: 0 15px !important;
    box-sizing: border-box !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    gap: 8px !important;
    margin: 0 !important;
    border: none !important;
    border-radius: 0 0 5px 5px !important;
}

.btn-mypay-action {
    background: #005b8a !important;
    color: #ffffff !important;
    border: 1px solid rgba(255, 255, 255, 0.35) !important;
    border-radius: 3px !important;
    padding: 0 14px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    font-weight: bold !important;
    height: 28px !important;
    line-height: 26px !important;
    box-sizing: border-box !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 6px !important;
    text-decoration: none !important;
    cursor: pointer !important;
    margin: 0 !important;
    transition: background-color 0.15s ease-in-out !important;
}

.btn-mypay-action:hover {
    background: #00496e !important;
    color: #ffffff !important;
    text-decoration: none !important;
}

.btn-mypay-action i {
    font-size: 12px !important;
    vertical-align: middle !important;
}

.info-btn {
    color: #0073B5;
    cursor: pointer;
    font-size: 16px;
    margin-left: 8px;
    vertical-align: middle;
}
.info-btn:hover {
    color: #005b8a;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        dateFormat: "dd-mm-yy"
    });
  
    $(".datepicker1").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        dateFormat: "dd-mm-yy"
    }); 

    if(typeof jQuery.fn.validationEngine !== 'undefined') {
        jQuery("#taxTypes").validationEngine();
    }
    $("#msgFo").fadeOut(5000);
    $("#msgFoprop").fadeOut(5000);

    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+S", function() { 
            resvAdvSubmit();
        }); 
        shortcut.add("Ctrl+V", function() { 
            window.location.href = "view-hall-advance.php";
        });
        shortcut.add("Ctrl+C", function() { 
            clrAmt();
        });
        shortcut.add("Ctrl+E", function() { 
            window.location.href = "<?php echo $home_path; ?>/dashboard.php";
        });
    }
});

function pyMode(){
    var pyMde = $('#pay_mode').val();
    if(pyMde == 'CARD'){
        $('#cc_cheqno').val('');
        $('#cheque_date').val('');
        $('#upi').val('').attr('disabled', true);
        $('#card_desc').removeAttr('disabled');
        $('#cardno').removeAttr('disabled');
    } else if(pyMde == 'UPI'){
        $('#cc_cheqno').val('').attr('disabled', true);
        $('#cheque_date').val('').attr('disabled', true);
        $('#card_desc').val('').attr('disabled', true);
        $('#cardno').val('').attr('disabled', true);
        $('#upi').removeAttr('disabled');
    } else if(pyMde == 'cheque'){
        $('#card_desc').val('').attr('disabled', true);
        $('#cardno').val('').attr('disabled', true);
        $('#remarks').val('');
        $('#upi').val('').attr('disabled', true);
        $('#cc_cheqno').removeAttr('disabled');
        $('#cheque_date').removeAttr('disabled');
    } else {
        $('#card_desc').val('').attr('disabled', true);
        $('#cardno').val('').attr('disabled', true);
        $('#upi').val('').attr('disabled', true);
        $('#cc_cheqno').val('').attr('disabled', true);
        $('#cheque_date').val('').attr('disabled', true);
    }
}

function cardType(){
    var pyMde = $('#pay_mode').val();
    if(pyMde == 'CARD'){
        $('#cc_cheqno').removeAttr('disabled');
        $('#cheque_date').removeAttr('disabled');
    }
}

function resvAdvSubmit(){
    var pyMde = $('#pay_mode').val();
    var crDesc = $('#card_desc').val();
    var ccChq = $('#cc_cheqno').val();
    var remA = $('#remarks').val();
    var chDt = $('#cheque_date').val();
    var amt = $('#amount').val();

    if(!amt || amt <= 0){
        alert('Please enter a valid Amount');
        $('#amount').focus();
        return false;
    }

    if(pyMde == ''){
        alert('Please select Payment Mode');
        $('#pay_mode').focus();
        return false;
    }

    if(pyMde == 'CARD' && crDesc == ""){
        alert('Select card type');
        $('#card_desc').focus();
        return false;
    }
    
    if(pyMde == 'cheque' && ccChq == ""){
        alert('Enter cheque no');
        $('#cc_cheqno').focus();
        return false;
    } else if(pyMde == 'cheque' && chDt == ""){
        alert('Select cheque date');
        $('#cheque_date').focus();
        return false;
    }
    
    $('#card_desc').removeAttr('disabled');
    $('#cc_cheqno').removeAttr('disabled');
    $('#cheque_date').removeAttr('disabled');
    $('#cardno').removeAttr('disabled');
    $('#upi').removeAttr('disabled');
    $('#taxTypes').submit();
} 

function clrAmt(){
    $('#amount').val('');
    $('#netamt').val('');
    $('#reservAmt').val('');
    $('#taxamt').val('');
}

function hallAdv(){
    var amount = $('#amount').val();
    if(amount != '') {
        $.ajax({
            type: 'GET',
            url: '../../action/selReservHallAdvanceNOINcl.php',
            data: { amount: amount },
            success: function(data){
                var opt = data.split(',');
                $('#taxamt').val(opt[0]);
                $('#netamt').val(opt[1]);
            }
        });
    }
}

function selBadFeed(){
    var bookNo = $('#book_no').val();
    var bookId = $('#hallbook_id').val();
    $.ajax({
        type: 'GET',
        url: '../../action/seladvance_paid.php',
        data: { bookNo: bookNo, bookId: bookId },
        success: function(data){
            $('#feedBk').html(data);
        }
    });	 
}
</script> 

<body class="bgBODY">

<!-- Modal Details -->
<div id="myModal" class="modal fade" role="dialog" style="padding:20px 0 0 0;width:1000px;margin:0 auto;">
  <div class="modal-dialog" style="width:900px;">
    <div class="modal-content">
      <div class="modal-header" style="background:#0073B5;color:#fff;">
        <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
        <h4 class="modal-title" style="color:#fff;font-weight:bold;">Advance Paid Details</h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped" style="font-size:12px;width:100%;" cellpadding="0" cellspacing="0" border="1" >
          <tbody id="feedBk">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
$sqlAC = mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC = mysql_fetch_array($sqlAC);
$curTime = date('H:i:s');

$sqlR = mysql_query("select * from bq_hallbooking where booking_no='".$_GET['roomBk']."' AND hallbook_id='".$_GET['rmBkID']."' group by booking_no order by hallbook_id ASC");	
$row = mysql_fetch_array($sqlR);

$sqlAr = mysql_query("select sum(netamt) as amt from bq_hallresvadv where booking_no='".$_GET['roomBk']."' AND hallbook_id='".$_GET['rmBkID']."' and netamt > 0 and status=1");	
$rowAr = mysql_fetch_array($sqlAr);
$amnt = ($rowAr['amt'] > 0) ? $rowAr['amt'] : 0;
?>

<div class="mypay-container">

    <?php if(isset($_GET['msg'])){ ?>
        <p style="text-align:center;margin:10px 0;">
            <label id="msgFo" style="color:#7B0E0E;font-weight:bold;font-size:13px;"><?php echo htmlspecialchars($_GET['msg']); ?></label>
        </p>
    <?php } ?>

    <!-- Master Form Card -->
    <div class="mypay-card">
        <div class="mypay-card-header">
            Reservation Hall Advance
        </div>

        <form id="taxTypes" name="taxTypes" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_hallreserv_advance.php" method="post">
            <input type="hidden" name="book_no" id="book_no" value="<?php echo htmlspecialchars($_GET['roomBk']); ?>" readonly />
            <input type="hidden" name="hallbook_id" id="hallbook_id" value="<?php echo htmlspecialchars($_GET['rmBkID']); ?>" readonly />
            <input type="hidden" name="book_date" id="book_date" value="<?php echo htmlspecialchars($row['book_date']); ?>" readonly />
            <input name="reservAmt" id="reservAmt" type="hidden" value="" />
            <input name="inclusive" id="inclusive" type="hidden" value="" />

            <div class="mypay-card-body">
                <table class="mypay-form-table" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="cur_date">Date<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="cur_date" id="cur_date" class="mypay-input" value="<?php echo htmlspecialchars($rowAC['cur_date']);?>" readonly />
                            </td>
                        </tr>

                        <tr>
                            <td class="mypay-label-cell">
                                <label for="booking_no">Booking #<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="booking_no" id="booking_no" class="mypay-input" value="<?php echo htmlspecialchars($_GET['roomBk']); ?>" readonly />
                            </td>
                        </tr>

                        <tr>
                            <td class="mypay-label-cell">
                                <label for="guest_name">Guest Name<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="guest_name" id="guest_name" class="mypay-input" value="<?php echo htmlspecialchars($row['guest_name']); ?>" required />
                            </td>
                        </tr>

                        <tr>
                            <td class="mypay-label-cell">
                                <label for="advpaid">Advance Paid :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <div style="display:flex;align-items:center;">
                                    <input type="text" name="advpaid" id="advpaid" class="mypay-input" value="<?php echo sprintf("%01.2f", $amnt); ?>" readonly style="flex:1;" />
                                    <i class="fa fa-info-circle info-btn" title="View Advance Details" data-toggle="modal" data-target="#myModal" onclick="selBadFeed();"></i>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="mypay-label-cell">
                                <label for="amount">Amount<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <input type="text" name="amount" id="amount" class="mypay-input" style="width:160px;" placeholder="0.00" onblur="hallAdv();" onclick="clrAmt();" required />
                                    <label style="display:inline-flex;align-items:center;gap:5px;font-size:12px;margin:0;cursor:pointer;">
                                        <input type="checkbox" name="incLchk" id="incLchk" value="incl" checked disabled /> Nett
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="mypay-label-cell">
                                <label>Tax / Total :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <span style="font-size:12px;color:#555;">Tax:</span>
                                    <input type="text" name="taxamt" id="taxamt" class="mypay-input" style="width:110px;" value="" readonly placeholder="0.00" />
                                    <span style="font-size:12px;color:#555;margin-left:6px;">Total:</span>
                                    <input type="text" name="netamt" id="netamt" class="mypay-input" style="width:110px;" value="" readonly placeholder="0.00" />
                                </div>
                            </td>
                        </tr>

                        <?php 
                        $sqlPr = mysql_query("select * from property_definition where propdef_id='1'");
                        $rowPr = mysql_fetch_array($sqlPr);
                        $sqlPm = mysql_query("select distinct payment_mode from payment_mode where payment_mode!='COMPANY'");
                        ?>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="pay_mode">Pay Mode<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <select name="pay_mode" id="pay_mode" class="mypay-input" onchange="pyMode();" required>
                                    <option value="">--Select--</option>
                                    <?php while($rowPm = mysql_fetch_array($sqlPm)) { ?>
                                        <option value="<?php echo htmlspecialchars($rowPm['payment_mode']);?>" <?php if($rowPr['pay_mode'] == $rowPm['payment_mode']) echo 'selected'; ?>>
                                            <?php echo strtoupper($rowPm['payment_mode']);?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td class="mypay-label-cell">
                                <label for="card_desc">Card Type :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <select name="card_desc" id="card_desc" class="mypay-input" onchange="cardType();" disabled>
                                    <option value="">--Select--</option>
                                    <?php 
                                    $sqlF = mysql_query("select * from company_master where classf='creditcard'");
                                    while($rowF = mysql_fetch_array($sqlF)) { ?>
                                        <option value="<?php echo htmlspecialchars($rowF['comp_name']); ?>"><?php echo strtoupper($rowF['comp_name']); ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td class="mypay-label-cell">
                                <label for="upi">UPI :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <select name="upi" id="upi" class="mypay-input" disabled>
                                    <option value="">--Select--</option>
                                    <?php 
                                    $sqlF = mysql_query("select * from company_master where classf='upi'");
                                    while($rowF = mysql_fetch_array($sqlF)) { ?>
                                        <option value="<?php echo htmlspecialchars($rowF['comp_name']); ?>"><?php echo strtoupper($rowF['comp_name']); ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td class="mypay-label-cell">
                                <label for="cc_cheqno">CC / Cheque # :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="cc_cheqno" id="cc_cheqno" class="mypay-input" disabled />
                            </td>
                        </tr>

                        <tr>
                            <td class="mypay-label-cell">
                                <label for="cheque_date">Cheque Date :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="cheque_date" id="cheque_date" class="mypay-input datepicker" disabled />
                            </td>
                        </tr>

                        <tr>
                            <td class="mypay-label-cell">
                                <label for="cardno">Card No :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="cardno" id="cardno" class="mypay-input" disabled />
                            </td>
                        </tr>

                        <tr>
                            <td class="mypay-label-cell">
                                <label for="remarks">Remarks :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="remarks" id="remarks" class="mypay-input" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Card Bottom Action Bar -->
            <div class="mypay-card-footer">
                <button type="button" id="add" class="btn-mypay-action" onclick="return resvAdvSubmit();" title="Submit (Ctrl+S)">
                    <i class="fa fa-floppy-o"></i> Submit
                </button>
                <a href="view-hall-advance.php" class="btn-mypay-action" title="View (Ctrl+V)">
                    <i class="fa fa-eye"></i> View
                </a>
                <button type="button" id="rest" class="btn-mypay-action" onclick="clrAmt();" title="Clear (Ctrl+C)">
                    <i class="fa fa-paint-brush" style="color:#f39c12;"></i> Clear
                </button>
                <a href="<?php echo $home_path; ?>/dashboard.php" class="btn-mypay-action" title="Exit (Ctrl+E)">
                    <i class="fa fa-times" style="color:#e74c3c;"></i> Exit
                </a>
            </div>
        </form>
    </div>

</div>

<?php include("../../footer.php"); ?>
</body>
</html>
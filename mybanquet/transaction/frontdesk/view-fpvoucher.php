<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../util.php");

$sqlAC = mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC = mysql_fetch_array($sqlAC);
$curDate = $rowAC['cur_date'];
$curTime = date('H:i:s');
?>
<!-- Form validation & plugins -->
<link rel="stylesheet" href="../../form-valid/validationEngine.jquery.css" type="text/css"/>
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
    width: 98% !important;
    max-width: 1200px !important;
    margin: 20px auto 40px auto !important;
    padding: 0 10px !important;
    box-sizing: border-box !important;
}

/* Card Container */
.mypay-card {
    width: 100% !important;
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
    border-radius: 5px 5px 0 0 !important;
}

.mypay-card-body {
    padding: 20px !important;
    background: #ffffff !important;
}

/* 2-Column Split Grid */
.voucher-grid {
    display: flex !important;
    gap: 20px !important;
    flex-wrap: wrap !important;
}

.voucher-left-col {
    flex: 1 1 380px !important;
    min-width: 320px !important;
}

.voucher-right-col {
    flex: 1.5 1 500px !important;
    min-width: 450px !important;
}

/* Form Table */
.mypay-form-table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 8px !important;
    border: none !important;
    margin: 0 !important;
}

.mypay-form-table tr,
.mypay-form-table td {
    border: none !important;
    background: transparent !important;
    padding: 0 !important;
    vertical-align: middle !important;
}

.mypay-label-cell {
    width: 35% !important;
    font-size: 12px !important;
    color: #222222 !important;
    padding-right: 10px !important;
    text-align: left !important;
}

.mypay-label-cell label {
    margin: 0 !important;
    padding: 0 !important;
    font-size: 12px !important;
    color: #222222 !important;
    font-weight: normal !important;
}

.mypay-label-cell label .req-star {
    color: #d9534f !important;
    font-weight: bold !important;
}

.mypay-input-cell {
    width: 65% !important;
}

.mypay-input {
    width: 100% !important;
    height: 28px !important;
    line-height: 28px !important;
    padding: 0 8px !important;
    border: 1px solid #d0d7de !important;
    border-radius: 4px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    color: #333333 !important;
    background: #ffffff !important;
    box-sizing: border-box !important;
    outline: none !important;
}

.mypay-input:focus {
    border-color: #0084b4 !important;
}

.mypay-input[readonly] {
    background-color: #f6f8fa !important;
    color: #57606a !important;
}

/* Section Sub-Headers */
.sub-panel-title {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    font-weight: bold !important;
    font-size: 12px !important;
    padding: 6px 10px !important;
    margin: 12px 0 6px 0 !important;
    border-radius: 3px !important;
    text-transform: uppercase !important;
}

/* Mini Table inside Voucher */
.mini-table {
    width: 100% !important;
    border-collapse: collapse !important;
    font-size: 11px !important;
    border: 1px solid #d0d7de !important;
    margin-bottom: 10px !important;
}

.mini-table th {
    background-color: #f5f5f5 !important;
    color: #222222 !important;
    padding: 6px !important;
    border: 1px solid #e0e0e0 !important;
    text-align: center !important;
    font-size: 11px !important;
}

.mini-table td {
    padding: 4px !important;
    border: 1px solid #e0e0e0 !important;
    text-align: center !important;
}

.mini-table td input {
    width: 100% !important;
    height: 24px !important;
    padding: 0 4px !important;
    border: 1px solid #d0d7de !important;
    font-size: 11px !important;
    box-sizing: border-box !important;
    background: #ffffff !important;
}

/* Bottom Calculation Rows */
.calc-table {
    width: 100% !important;
    border-collapse: collapse !important;
    margin-top: 10px !important;
}

.calc-table td {
    padding: 4px 6px !important;
    vertical-align: middle !important;
    border: none !important;
}

.calc-label {
    text-align: right !important;
    font-weight: bold !important;
    font-size: 12px !important;
    color: #333333 !important;
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
    transition: background-color 0.15s ease-in-out !important;
}

.btn-mypay-action:hover {
    background: #00496e !important;
    color: #ffffff !important;
}

.btn-mypay-action i {
    font-size: 12px !important;
}

.btn-change-pax {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    border: 1px solid #005b8a !important;
    border-radius: 3px !important;
    padding: 2px 8px !important;
    font-size: 11px !important;
    font-weight: bold !important;
    cursor: pointer !important;
    height: 26px !important;
}
.btn-change-pax:hover {
    background-color: #005b8a !important;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
    $("#msgFo").fadeOut(5000);

    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+S", function() { 
            if(checkformSubmit()){
                $('#hotelDefi').attr('action', '<?php echo $home_path;?>/action/add_voucher_detail.php');  
                $('#hotelDefi').submit(); 
            }
        }); 
        shortcut.add("Ctrl+V", function() { 
            window.location.href = "view-fpvoucher-details.php";
        });
        shortcut.add("Ctrl+U", function() { 
            if(checkformSubmit()){
                $('#hotelDefi').attr('action', '<?php echo $home_path;?>/action/add_voucher_detail.php');  
                $('#hotelDefi').submit(); 
            }
        });
        shortcut.add("Ctrl+C", function() { 
            $('#hotelDefi').find("input[type=text], textarea").val("");
        });
        shortcut.add("Ctrl+E", function() { 
            window.location.href = "view-fpvoucher-details.php";
        });
    }
});

function checkformSubmit() {
    var fp_no = $('#fp_no').val();
    if(!fp_no || fp_no === ""){
        alert("Please select FP No!");
        $('#fp_no').focus();
        return false;
    }
    return true;
}

function selVoucherDet(){
    var fp_no = $('#fp_no').val();
    if(fp_no != ""){
        $.ajax({
            type: 'GET',
            url: '../../action/selectVoucherDet.php',
            data: { fp_no: fp_no },
            success: function(data){
                var opt = data.split('&#');
                $('#displyRo').hide();
                $('#dispADVHde').hide();
                $('#displyRoomDETT').show();
                $('#dispADVShw').show();
                $('#booking_no').val(opt[0]);
                $('#vouc_date').val(opt[1]);
                $('#guest_name').val(opt[2]);
                $('#session').val(opt[3]);
                $('#venue').val(opt[4]);
                $('#bill_instr').val(opt[5]);
                $('#con_person').val(opt[6]);
                $('#mobile').val(opt[7]);
                $('#total_pax').val(opt[8]);
                $('#displyRoomDETT').html(opt[9]);
                $('#dispADVShw').html(opt[10]);
                $('#total_val').val(opt[11]);
                $('#scst').val(opt[12]);
                $('#ccst').val(opt[13]);
                $('#net_amt').val(opt[14]);
                $('#remarks').val(opt[15]);
            }
        });
    } else {
        alert("Please select FP No!");
        $('#displyRo').show();
        $('#dispADVHde').show();
        $('#displyRoomDETT').html('').hide();
        $('#dispADVShw').html('').hide();
        $('#booking_no').val('');
        $('#vouc_date').val('');
        $('#guest_name').val('');
        $('#session').val('');
        $('#venue').val('');
        $('#bill_instr').val('');
        $('#con_person').val('');
        $('#mobile').val('');
        $('#total_pax').val('');
        $('#total_val').val('');
        $('#scst').val('');
        $('#ccst').val('');
        $('#net_amt').val('');
    }
}

function btnFcs(){
    var vl = $('#pax_num').val();
    $('#total_pax').val(vl);
    var fp_no = $('#fp_no').val();

    $.ajax({
        type: 'GET',
        url: '../../action/selectVoucherDetPAXCHange.php',
        data: { fp_no: fp_no, vl: vl },
        success: function(data){
            var opt = data.split(',');
            $('#displyRoomDETT').html(opt[0]);
            $('#total_val').val(opt[1]);
            $('#scst').val(opt[2]);
            $('#ccst').val(opt[3]);
            $('#net_amt').val(opt[4]);
        }
    });
}
</script> 

<body class="bgBODY">

<!-- Modal Change Pax -->
<div id="myModal" class="modal fade" role="dialog" style="padding:150px 0 0 0;width:450px;margin:0 auto;">
  <div class="modal-dialog" style="width:400px;">
    <div class="modal-content">
      <div class="modal-header" style="background:#0073B5;color:#fff;">
        <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
        <h4 class="modal-title" style="color:#fff;font-weight:bold;font-size:13px;">Change Pax Number</h4>
      </div>
      <div class="modal-body">
        <label style="font-weight:bold;display:block;margin-bottom:6px;">Enter New Pax:</label>
        <input name="pax_num" id="pax_num" type="text" class="mypay-input" placeholder="e.g. 100" />
      </div>
      <div class="modal-footer">
        <button type="button" onclick="btnFcs();" class="btn btn-primary" data-dismiss="modal">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="mypay-container">

    <?php if(isset($_GET['msg'])){ ?>
        <p style="text-align:center;margin:10px 0;">
            <label id="msgFo" style="color:#7B0E0E;font-weight:bold;font-size:13px;"><?php echo 'Voucher ' . htmlspecialchars($_GET['msg']); ?></label>
        </p>
    <?php } ?>

    <!-- Master Form Card -->
    <div class="mypay-card">
        <div class="mypay-card-header">
            Banquet Voucher Creation
        </div>

        <form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_voucher_detail.php" method="post" onsubmit="return checkformSubmit();">
            <div class="mypay-card-body">
                <div class="voucher-grid">
                    
                    <!-- Left Column: Voucher Info & Advance -->
                    <div class="voucher-left-col">
                        <table class="mypay-form-table" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="voucher_no">Voucher# :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <input name="voucher_no" id="voucher_no" type="text" class="mypay-input" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="fp_no">FP.#<span class="req-star">*</span> :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <select name="fp_no" id="fp_no" class="mypay-input" onChange="selVoucherDet();" required>
                                            <option value="">--Select--</option>
                                            <?php
                                            $sqle = mysql_query("select distinct fpno from bq_opfpmenuhdr where bkdate<='$curDate' AND bill_status='1' AND vuc_status=''");
                                            while($res = mysql_fetch_array($sqle)){ ?>
                                                <option value="<?php echo htmlspecialchars($res['fpno']); ?>"><?php echo strtoupper($res['fpno']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="booking_no">Booking# :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <input name="booking_no" id="booking_no" type="text" class="mypay-input" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="vouc_date">Date :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <input name="vouc_date" id="vouc_date" type="text" class="mypay-input" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="guest_name">Guest :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <input name="guest_name" id="guest_name" type="text" class="mypay-input" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="session">Session :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <input name="session" id="session" type="text" class="mypay-input" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="venue">Venue :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <input name="venue" id="venue" type="text" class="mypay-input" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="bill_instr">Billing Instruction :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <input name="bill_instr" id="bill_instr" type="text" class="mypay-input" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="con_person">Contact Person :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <input name="con_person" id="con_person" type="text" class="mypay-input" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="mobile">Mobile :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <input name="mobile" id="mobile" type="text" class="mypay-input" readonly />
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Advance Section -->
                        <div class="sub-panel-title">Advance Details</div>
                        <div style="max-height: 140px; overflow-y: auto;">
                            <table class="mini-table">
                                <thead>
                                    <tr>
                                        <th style="width: 35%;">Receipt#</th>
                                        <th style="width: 35%;">Date</th>
                                        <th style="width: 30%;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="dispADVHde">
                                    <?php for($cc=1; $cc<5; $cc++){ ?>
                                    <tr>
                                        <td><input name="advv_rcpt[]" id="adv_rcpt<?php echo $cc;?>" type="text" readonly /></td>
                                        <td><input name="advv_date[]" id="adv_date<?php echo $cc;?>" type="text" readonly /></td>
                                        <td><input name="advv_amount[]" id="adv_amount<?php echo $cc;?>" type="text" readonly /></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tbody id="dispADVShw" style="display:none;">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Right Column: Pax & Menu Creation -->
                    <div class="voucher-right-col">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                            <label style="font-weight:bold;font-size:12px;">Total Pax:</label>
                            <input name="total_pax" id="total_pax" type="text" class="mypay-input" style="width:100px;" readonly />
                            <button type="button" class="btn-change-pax" data-toggle="modal" data-target="#myModal">Change</button>
                        </div>

                        <div class="sub-panel-title">Menu Creation</div>
                        <div style="max-height: 280px; overflow-y: auto;">
                            <table class="mini-table">
                                <thead>
                                    <tr>
                                        <th style="width: 18%;">Item Code</th>
                                        <th style="width: 44%;">Item Name</th>
                                        <th style="width: 12%;">Qty</th>
                                        <th style="width: 12%;">Rate</th>
                                        <th style="width: 14%;">Value</th>
                                    </tr>
                                </thead>
                                <tbody id="displyRo">
                                    <?php for($cc=1; $cc<14; $cc++){ ?>
                                    <tr>
                                        <td><input name="itemm_code[]" id="item_code<?php echo $cc; ?>" type="text" readonly /></td>
                                        <td><input name="itemm_name[]" id="item_name<?php echo $cc; ?>" type="text" readonly /></td>
                                        <td><input name="itemm_qty[]" id="item_qty<?php echo $cc; ?>" type="text" readonly /></td>
                                        <td><input name="itemm_rate[]" id="item_rate<?php echo $cc; ?>" type="text" readonly /></td>
                                        <td><input name="itemm_value[]" id="item_value<?php echo $cc; ?>" type="text" readonly /></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tbody id="displyRoomDETT" style="display:none;">
                                </tbody>
                            </table>
                        </div>

                        <!-- Calculations Table -->
                        <table class="calc-table">
                            <tbody>
                                <tr>
                                    <td style="width: 50%;" rowspan="4" valign="top">
                                        <label style="font-weight:bold;font-size:12px;display:block;margin-bottom:4px;">Remarks:</label>
                                        <textarea rows="4" name="remarks" id="remarks" class="mypay-input" style="height:85px;text-transform:uppercase;"></textarea>
                                    </td>
                                    <td class="calc-label">Sub Total:</td>
                                    <td style="width: 130px;">
                                        <input name="total_val" id="total_val" type="text" class="mypay-input" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="calc-label">SGST 9%:</td>
                                    <td>
                                        <input name="scst" id="scst" type="text" class="mypay-input" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="calc-label">CGST 9%:</td>
                                    <td>
                                        <input name="ccst" id="ccst" type="text" class="mypay-input" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="calc-label">Net Amount:</td>
                                    <td>
                                        <input name="net_amt" id="net_amt" type="text" class="mypay-input" style="font-weight:bold;" readonly />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <!-- Card Bottom Action Bar -->
            <div class="mypay-card-footer">
                <button type="submit" id="send" name="send" class="btn-mypay-action" title="Submit (Ctrl+S)">
                    <i class="fa fa-floppy-o"></i> Submit
                </button>
                <a href="view-fpvoucher-details.php" class="btn-mypay-action" title="View (Ctrl+V)">
                    <i class="fa fa-eye"></i> View
                </a>
                <button type="submit" id="updateBtn" name="updateBtn" class="btn-mypay-action" title="Update (Ctrl+U)">
                    <i class="fa fa-refresh" style="color:#3498db;"></i> Update
                </button>
                <button type="reset" id="rest" class="btn-mypay-action" title="Clear (Ctrl+C)">
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
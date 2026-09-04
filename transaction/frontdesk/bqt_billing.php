<?php
error_reporting(0);
ob_start();
include("../../config.php");
include("../../header.php");
include("../../util.php");

$sqlAC = mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC = mysql_fetch_array($sqlAC);
$cr = array_map('trim', explode('/', $rowAC['cur_date']));
$ctt = $cr[2] . '-' . $cr[1] . '-' . $cr[0];
$curDate = $rowAC['cur_date'];
$curTime = date('H:i:s');
?>
<link rel="stylesheet" href="<?php echo $home_path;?>/css/mypay-master.css">
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<script src="<?php echo $home_path;?>/images/bootstrap.min.js"></script>
<link rel="stylesheet" href="../../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/tcal-picker/tcal.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $home_path;?>/tcal-picker/tcal.css" />
<script type="text/javascript" src="<?php echo $home_path;?>/js/shortcut.js"></script>

<style type="text/css">
/* ==========================================================================
   Banquet Billing - Standardized Unified Payroll (MyPay) Design System
   ========================================================================== */
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

/* Master Billing Form Card */
.mypay-card {
    width: 1080px !important;
    max-width: 98% !important;
    margin: 0 auto !important;
    background: #ffffff !important;
    border: 1px solid #0073B5 !important;
    border-radius: 6px !important;
    overflow: hidden !important;
    box-shadow: 0 2px 8px rgba(0, 115, 181, 0.08) !important;
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
    font-size: 14px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    margin: 0 !important;
    border: none !important;
    border-radius: 5px 5px 0 0 !important;
}

.mypay-card-body {
    padding: 20px 25px 25px 25px !important;
    background: #ffffff !important;
}

/* Header Info Grid */
.bqt-header-grid {
    display: flex !important;
    gap: 15px !important;
    margin-bottom: 15px !important;
    flex-wrap: wrap !important;
}

.bqt-col-left {
    flex: 1.1 1 340px !important;
}

.bqt-col-center {
    flex: 1.1 1 340px !important;
}

.bqt-col-right {
    flex: 0.8 1 240px !important;
}

/* Field Table */
.bqt-field-table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 6px !important;
    border: none !important;
}

.bqt-field-table td {
    padding: 2px 0 !important;
    border: none !important;
    vertical-align: middle !important;
}

.bqt-field-table td.label-col {
    width: 32% !important;
    font-size: 12.5px !important;
    font-weight: bold !important;
    color: #333333 !important;
    padding-right: 8px !important;
    text-align: left !important;
}

.bqt-field-table td.input-col {
    width: 68% !important;
}

/* Input Styles */
.bqt-input {
    width: 100% !important;
    height: 28px !important;
    line-height: 28px !important;
    padding: 0 8px !important;
    border: 1px solid #d0d7de !important;
    border-radius: 4px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12.5px !important;
    color: #333333 !important;
    background: #ffffff !important;
    box-sizing: border-box !important;
    outline: none !important;
    transition: border-color 0.15s ease-in-out !important;
}

.bqt-input:focus {
    border-color: #0084b4 !important;
    box-shadow: 0 0 3px rgba(0, 132, 180, 0.3) !important;
}

.bqt-input[readonly] {
    background-color: #f8fafc !important;
    color: #475569 !important;
    border-color: #cbd5e1 !important;
}

.bqt-select {
    width: 100% !important;
    height: 28px !important;
    line-height: 28px !important;
    padding: 0 6px !important;
    border: 1px solid #0073B5 !important;
    border-radius: 4px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12.5px !important;
    color: #1e293b !important;
    background: #ffffff !important;
    box-sizing: border-box !important;
    outline: none !important;
    cursor: pointer !important;
}

.bqt-select:focus {
    border-color: #005b8a !important;
    box-shadow: 0 0 3px rgba(0, 115, 181, 0.3) !important;
}

/* Voucher Link Table */
.bqt-link-table {
    width: 100% !important;
    border-collapse: collapse !important;
    border: 1px solid #0073B5 !important;
    background: #ffffff !important;
}

.bqt-link-table th {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    font-size: 12px !important;
    font-weight: bold !important;
    text-align: center !important;
    padding: 6px 4px !important;
    border: 1px solid #0073B5 !important;
}

.bqt-link-table td {
    padding: 4px !important;
    border: 1px solid #e2e8f0 !important;
    text-align: center !important;
}

/* Table Section Styling */
.bqt-section-title {
    background-color: #f1f5f9 !important;
    color: #0073B5 !important;
    font-weight: bold !important;
    font-size: 13px !important;
    padding: 6px 12px !important;
    margin: 15px 0 8px 0 !important;
    border-left: 4px solid #0073B5 !important;
    border-radius: 2px !important;
}

/* Data Table in Billing Form */
.bqt-items-table {
    width: 100% !important;
    border-collapse: collapse !important;
    border: 1px solid #cbd5e1 !important;
    background: #ffffff !important;
}

.bqt-items-table thead tr th {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    font-size: 12px !important;
    font-weight: bold !important;
    text-align: center !important;
    height: 30px !important;
    padding: 4px 6px !important;
    border: 1px solid #0073B5 !important;
    white-space: nowrap !important;
}

.bqt-items-table tbody td {
    padding: 4px !important;
    border: 1px solid #e2e8f0 !important;
    font-size: 12px !important;
    text-align: center !important;
    vertical-align: middle !important;
}

.bqt-items-table tbody tr:hover td {
    background-color: #f8fbfe !important;
}

.bqt-cell-input {
    width: 100% !important;
    height: 24px !important;
    line-height: 24px !important;
    padding: 0 4px !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 3px !important;
    font-size: 12px !important;
    box-sizing: border-box !important;
    color: #333333 !important;
    background: #ffffff !important;
    outline: none !important;
}

.bqt-cell-input[readonly] {
    background-color: #f8fafc !important;
    color: #334155 !important;
    border-color: #e2e8f0 !important;
}

.bqt-cell-input.text-right {
    text-align: right !important;
}

.bqt-cell-input.text-center {
    text-align: center !important;
}

/* Bottom Split Grids */
.bqt-bottom-grid {
    display: flex !important;
    gap: 20px !important;
    margin-top: 15px !important;
    flex-wrap: wrap !important;
}

.bqt-bottom-col {
    flex: 1 1 450px !important;
}

.bqt-subtable {
    width: 100% !important;
    border-collapse: collapse !important;
    border: 1px solid #cbd5e1 !important;
}

.bqt-subtable th {
    background-color: #f8fafc !important;
    color: #1e293b !important;
    font-size: 12px !important;
    font-weight: bold !important;
    text-align: center !important;
    padding: 6px !important;
    border: 1px solid #cbd5e1 !important;
}

.bqt-subtable td {
    padding: 4px 6px !important;
    border: 1px solid #e2e8f0 !important;
    text-align: center !important;
}

/* Card Bottom Action Bar */
.mypay-card-footer {
    background: #0073B5 !important;
    height: 46px !important;
    padding: 0 15px !important;
    box-sizing: border-box !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    gap: 10px !important;
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
    font-size: 12.5px !important;
    font-weight: bold !important;
    height: 30px !important;
    line-height: 28px !important;
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

.btn-mypay-action:disabled {
    background: #64748b !important;
    opacity: 0.65 !important;
    cursor: not-allowed !important;
}

.btn-mypay-action i {
    font-size: 13px !important;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
    $("#msgFo").fadeOut(5000);

    $('.tree-toggle').click(function () {
        $(this).parent().children('ul.tree').toggle(200);
    });

    $('input[name^=disc_flag]').live("click",function(){
        vl = ($(this).val()); 
        if(vl == 'N'){
            $(this).val('Y');
        } else {
            $(this).val('N');
        }
    });

    $('input[name^=disc_perc]').live("click",function(){
        vl = ($(this).val()); 
        if(vl == 'Perc'){
            $(this).val('Amt');
        } else {
            $(this).val('Perc');
        }
    });

    $('input[name^=disc_amount]').live("click",function(){
        $(this).val(''); 
    });	

    $('input[name^=disc_amount]').on("keyup",function(){
        rowid = ($(this).attr("id")).substr(11);
        $(this).parent().next().find('input').val('');
        vlu = ($(this).val()); 
        vl = ($(this).parent().prev().find('input').val());
        vlP = ($(this).parent().prev().prev().find('input').val());
        lnTot = parseFloat($(this).parent().prev().prev().prev().find('input').val());
        
        if(vl == 'Perc' && vlu >= 0){
            per = lnTot * vlu / 100;
            $(this).parent().prev().prev().find('input').val('Y');
            $(this).parent().next().find('input').val(per);
            pvl = $(this).parent().next().find('input').val();
            perc = $(this).parent().next().next().next().find('input').val();
            totvl = parseFloat(perc) - parseFloat(pvl);
            $(this).parent().next().next().next().find('input').val(totvl.toFixed(2));
            
            vucNo = $("#voucher_no").val();
            itCd = $(this).parent().prev().prev().prev().prev().prev().prev().prev().find('input').val();
            $.ajax({
                type: 'GET',
                url: '../../action/selBqtBilltaxCalc.php',
                data: { per: per, vucNo: vucNo, itCd: itCd },
                success: function(data){
                    $("#tax_amount" + rowid).val(data);
                    ln = $("#item_total" + rowid).val();
                    ds = $("#disc_val" + rowid).val();
                    tx = $("#tax_amount" + rowid).val();
                    tot = parseFloat(ln) - parseFloat(ds) + parseFloat(tx);
                    $("#net_amount" + rowid).val(tot);
                }
            });
        } else if(vl == 'Amt' && vlu >= 0){
            per = vlu;
            $(this).parent().prev().prev().find('input').val('Y');
            $(this).parent().next().find('input').val(per);
            pvl = $(this).parent().next().find('input').val();
            perc = $(this).parent().next().next().next().find('input').val();
            totvl = parseFloat(perc) - parseFloat(pvl);
            $(this).parent().next().next().next().find('input').val(totvl.toFixed(2));
            
            vucNo = $("#voucher_no").val();
            itCd = $(this).parent().prev().prev().prev().prev().prev().prev().prev().find('input').val();
            $.ajax({
                type: 'GET',
                url: '../../action/selBqtBilltaxCalc.php',
                data: { per: per, vucNo: vucNo, itCd: itCd },
                success: function(data){
                    $("#tax_amount" + rowid).val(data);
                    ln = $("#item_total" + rowid).val();
                    ds = $("#disc_val" + rowid).val();
                    tx = $("#tax_amount" + rowid).val();
                    tot = parseFloat(ln) - parseFloat(ds) + parseFloat(tx);
                    $("#net_amount" + rowid).val(tot);
                }
            });
        }
    });

    $('input[name^=spitem_amount]').live("click",function(){
        vl = ($(this).val()); 
        val = $('.ckPrint:checkbox:checked').val();
        newwindow = window.open('<?php echo $home_path;?>/transaction/frontdesk/itmBILLDiscount.php',"_blank",'scrollbars=1,menubar=0,resizable=1,left=500,width=450,height=300');
        newwindow.focus(); 
    });

    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+S", function() { 
            chkOutBillPrint();
        });
        shortcut.add("Ctrl+V", function() { 
            window.location.href = "view-bqtbill-details.php?fromdate=<?php echo $curDate;?>&todate=<?php echo $curDate;?>&val=";
        });
        shortcut.add("Ctrl+E", function() { 
            extBUtton();
        });
    }
});

function selBQTBillVCHrDet() {
    var vucNo = $("#voucher_no").val(); 
    if(vucNo == '') {
        document.location.href = "bqt_billing.php?vucNo=";
        return;
    }
    $.ajax({
        type: 'GET',
        url: '../../action/selBqtBlVCHRBill.php',
        data: { vucNo: vucNo },
        success: function(data){
            if(data == 1){
                var r = confirm("Bill already printed. Do you want to continue?"); 
                if(r == true){
                    document.location.href = "../../action/cancel_bqt_billing.php?vucNo=" + vucNo;
                }
            } else { 
                document.location.href = "bqt_billing.php?vucNo=" + vucNo;				
            }			  
        }
    });
}

function selDisBill(c){
    var vl = $('#disc_flag' + c).val();
    if(vl == 'N'){
        $('#disc_flag' + c).val('Y');
    } else {
        $('#disc_flag' + c).val('N');
    }
}

function chkOutBillPrint(){
    $("#billsbt").removeAttr('disabled'); 
    $("#hotelDefi").attr("action", "<?php echo $home_path; ?>/action/add_checkout_savesplit.php");
    $("#hotelDefi").submit(); 
}

function popupBillPrint() {
    var sptNo = $("#hid_menu").val(); 
    var vucNo = $("#voucher_no").val(); 
    $.ajax({
        type: 'GET',
        url: '../../action/selROUNDFOFF.php',
        data: { sptNo: sptNo, vucNo: vucNo },
        success: function(data){
            if(sptNo == ""){
                alert("Please check the split first!");
                $("#billsbt").attr('disabled', 'disabled');
            } else {  	
                $("#hotelDefi").attr("action", "<?php echo $home_path; ?>/action/add_bqt_billing.php");
                $("#hotelDefi").submit();
            }			  
        }
    });
}

function printFolio() {
    var sptNo = $("#hid_menu").val(); 
    var vucNo = $("#voucher_no").val(); 
    document.location.href = "<?php echo $home_path; ?>/transaction/view/folio-print-bqt-billing.php?vucNo=" + vucNo + "&sptNo=" + sptNo;
}

function setMenu() {
    var menuStr = "";
    $('.chk').each(function(i,v){
        if($(this).is(':checked')) {
            menuStr += $(this).val() + ',';
        }
    });
    menuStr = menuStr.slice(0, -1);
    $("#hid_menu").val(menuStr);
    $("#billsbt").removeAttr('disabled');	
    var hd = $("#hid_menu").val();
    var cT = hd ? hd.split(',').length : 0;
    $("#countT").val(cT);
    $("#countTt").val(cT);
}

function extBUtton(){
    document.location.href = "<?php echo $home_path; ?>/transaction/frontdesk/view-bqtbill-details.php?fromdate=<?php echo $curDate;?>&todate=<?php echo $curDate;?>&val=";
}

function sbtBtnN(){
    $("#guestt_name").val($("#bl_name").val());
    $("#add1").val($("#bl_addr").val());
    $("#add2").val($("#bl_addr1").val());
    $("#cty").val($("#bl_city").val());
    $("#pncd").val($("#bl_pin").val());
}

function selBadFeed(){
    var snt = $("#countTt").val();
    var bkN = $("#booking_no").val();
    var fpno = $("#fp_no").val();
    $.ajax({
        type: 'GET',
        url: '../../action/selpopupADdRpt.php',
        data: { snt: snt, bkN: bkN, fpno: fpno },
        success: function(data){
            $('#feedBk').html(data);
        }
    });	 
}
</script>

<body class="bgBODY">

<div class="mypay-container">

    <?php if(isset($_GET['msg'])){ ?>
        <p style="text-align:center;margin:10px 0;">
            <label id="msgFo" style="color:#7B0E0E;font-weight:bold;font-size:13px;"><?php echo htmlspecialchars($_GET['msg']); ?></label>
        </p>
    <?php } ?>

    <!-- Modal Popup for Guest Address Details -->
    <?php if(isset($_GET['vucNo']) && $_GET['vucNo'] != ''){ ?>
    <div id="myModal" class="modal fade" role="dialog" style="padding:20px 0 0 0;width:920px;margin:0 auto;">
        <div class="modal-dialog" style="width:900px;">
            <div class="modal-content">
                <div class="modal-header" style="background:#0073B5;color:#fff;padding:10px 15px;">
                    <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:0.9;">&times;</button>
                    <h4 class="modal-title" style="font-size:14px;font-weight:bold;margin:0;">Guest Address Details</h4>
                </div>
                <div class="modal-body" style="padding:15px;">
                    <table class="bqt-items-table" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:50px;">Title</th>
                                <th style="width:150px;">Name</th>
                                <th style="width:150px;">Address1</th>
                                <th style="width:150px;">Address2</th>
                                <th style="width:90px;">City</th>
                                <th style="width:80px;">Pincode</th>
                                <th style="width:140px;">GST NO</th>
                                <th style="width:60px;">Split</th>
                            </tr>
                        </thead>
                        <tbody id="feedBk" style="overflow:auto;max-height:220px;">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer" style="padding:8px 15px;background:#f1f5f9;">
                    <button type="button" class="btn-mypay-action" data-dismiss="modal" onclick="sbtBtnN();">Done</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php
    $vucNoParam = isset($_GET['vucNo']) ? trim($_GET['vucNo']) : '';
    $row = array();
    $rowb = array();
    $robV = array();
    $rob = array();
    $roS = array();
    $rov = array();

    if ($vucNoParam != '') {
        $sqlm = mysql_query("select * from bq_opvchrhdr where vouchrno='$vucNoParam'");
        if ($sqlm && mysql_num_rows($sqlm) > 0) {
            $row = mysql_fetch_array($sqlm);
            
            $sqlb = mysql_query("select * from bq_hallbooking where booking_no='".$row['bkno']."' and fpno='".$row['fpno']."'");
            if ($sqlb && mysql_num_rows($sqlb) > 0) {
                $rowb = mysql_fetch_array($sqlb);
                
                $sqb = mysql_query("select * from bq_billinstruc where bill_code='".$rowb['top_code']."'");
                if ($sqb && mysql_num_rows($sqb) > 0) {
                    $rob = mysql_fetch_array($sqb);
                }
                
                $sqS = mysql_query("select sess_name from bqt_session where sess_code='".$rowb['session']."'");
                if ($sqS && mysql_num_rows($sqS) > 0) {
                    $roS = mysql_fetch_array($sqS);
                }
                
                $sqlv = mysql_query("select * from bq_venue where venue_code='".$rowb['venue']."' AND status ='1'");
                if ($sqlv && mysql_num_rows($sqlv) > 0) {
                    $rov = mysql_fetch_array($sqlv);
                }
            }
            
            $sqbV = mysql_query("select * from bq_opvchrdtl where vouchrno='$vucNoParam'");
            if ($sqbV && mysql_num_rows($sqbV) > 0) {
                $robV = mysql_fetch_array($sqbV);
            }
        }
    }
    ?>

    <!-- Main Card Container Matching Master Style -->
    <div class="mypay-card">
        <div class="mypay-card-header">
            BANQUET BILLING
        </div>

        <form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="#" method="post">
            <input name="incLc" id="incLc" type="hidden" value=""/>
            <input type="hidden" name="rowVl" id="rowVl"/>
            <input type="hidden" name="rmomType" id="rmomType"/>
            <input type="hidden" name="hid_menu" id="hid_menu"/>
            <input type="hidden" name="countTt" id="countTt"/>
            <input type="hidden" name="adtDate" id="adtDate" value="<?php echo htmlspecialchars($curDate); ?>"/>

            <input name="guestt_name" id="guestt_name" type="hidden" value="" />
            <input name="add1" id="add1" type="hidden" value="" />
            <input name="add2" id="add2" type="hidden" value="" />
            <input name="cty" id="cty" type="hidden" value="" />
            <input name="pncd" id="pncd" type="hidden" value="" />

            <div class="mypay-card-body">

                <!-- Header Info Grid -->
                <div class="bqt-header-grid">

                    <!-- Column 1 -->
                    <div class="bqt-col-left">
                        <table class="bqt-field-table">
                            <tr>
                                <td class="label-col">Voucher # :</td>
                                <td class="input-col">
                                    <select name="voucher_no" id="voucher_no" onChange="selBQTBillVCHrDet();" class="bqt-select">
                                        <option value="">--Select Voucher--</option>
                                        <?php
                                        $sqle = mysql_query("select distinct vouchrno from bq_opvchrhdr where str_to_date(vouchrdate,'%d/%m/%Y')='$ctt' AND bill_status='1'");
                                        if ($sqle && mysql_num_rows($sqle) > 0) {
                                            while($res = mysql_fetch_array($sqle)){
                                                $selected = ($res['vouchrno'] == $vucNoParam) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo htmlspecialchars($res['vouchrno']); ?>" <?php echo $selected; ?>><?php echo htmlspecialchars(strtoupper($res['vouchrno'])); ?></option>
                                        <?php 
                                            } 
                                        } 
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-col">FP # :</td>
                                <td class="input-col">
                                    <input name="fp_no" id="fp_no" type="text" class="bqt-input" value="<?php echo isset($row['fpno']) ? htmlspecialchars($row['fpno']) : ''; ?>" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td class="label-col">Booking # :</td>
                                <td class="input-col">
                                    <input name="booking_no" id="booking_no" type="text" class="bqt-input" value="<?php echo isset($row['bkno']) ? htmlspecialchars($row['bkno']) : ''; ?>" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td class="label-col">Billing Instr :</td>
                                <td class="input-col">
                                    <input name="bill_inst" id="bill_inst" type="text" class="bqt-input" value="<?php echo isset($rob['bill_desc']) ? htmlspecialchars($rob['bill_desc']) : ''; ?>" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td class="label-col">No of Splits :</td>
                                <td class="input-col">
                                    <input name="no_split" id="no_split" type="text" class="bqt-input" readonly />
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Column 2 -->
                    <div class="bqt-col-center">
                        <table class="bqt-field-table">
                            <tr>
                                <td class="label-col">Guest Name :</td>
                                <td class="input-col">
                                    <input name="guest_name" id="guest_name" type="text" class="bqt-input" value="<?php echo isset($rowb['guest_name']) ? htmlspecialchars($rowb['guest_name']) : ''; ?>" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td class="label-col">Venue :</td>
                                <td class="input-col">
                                    <input name="venue" id="venue" type="text" class="bqt-input" value="<?php echo isset($rov['venue_desc']) ? htmlspecialchars($rov['venue_desc']) : (isset($rowb['venue']) ? htmlspecialchars($rowb['venue']) : ''); ?>" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td class="label-col">Date :</td>
                                <td class="input-col">
                                    <input name="book_date" id="book_date" type="text" class="bqt-input" value="<?php echo isset($rowb['book_date']) ? htmlspecialchars($rowb['book_date']) : ''; ?>" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td class="label-col">Session :</td>
                                <td class="input-col">
                                    <input name="session" id="session" type="text" class="bqt-input" value="<?php echo isset($roS['sess_name']) ? htmlspecialchars($roS['sess_name']) : (isset($rowb['session']) ? htmlspecialchars($rowb['session']) : ''); ?>" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td class="label-col">Total Pax :</td>
                                <td class="input-col">
                                    <input name="total_pax" id="total_pax" type="text" class="bqt-input" value="<?php echo isset($rowb['guaranted']) ? htmlspecialchars($rowb['guaranted']) : ''; ?>" readonly />
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Column 3: Voucher Link Table -->
                    <div class="bqt-col-right">
                        <table class="bqt-link-table" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:65%;">Voucher</th>
                                    <th style="width:35%;">Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($cc = 1; $cc <= 5; $cc++){ ?>
                                <tr>
                                    <td>
                                        <input name="spitem_group[]" id="item_group<?php echo $cc;?>" type="text" class="bqt-cell-input text-center" value="" readonly />
                                    </td>
                                    <td>
                                        <input name="spitem_split[]" id="item_split<?php echo $cc;?>" type="checkbox" style="cursor:pointer;" value="" />
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>

                <!-- Items Section -->
                <div class="bqt-section-title">Item Details</div>

                <div style="overflow-x:auto;">
                    <table class="bqt-items-table" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 35px;">S.No</th>
                                <th style="width: 140px;">Item Name</th>
                                <th style="width: 50px;">Qty</th>
                                <th style="width: 75px;">Rate</th>
                                <th style="width: 80px;">Total</th>
                                <th style="width: 50px;">D.Flag</th>
                                <th style="width: 50px;">Disc</th>
                                <th style="width: 55px;">D.Amt</th>
                                <th style="width: 55px;">D.Val</th>
                                <th style="width: 65px;">Tax</th>
                                <th style="width: 85px;">Net Amount</th>
                                <th style="width: 50px;">Split</th>
                            </tr>
                        </thead>
                        <tbody id="dispItmHde">
                        <?php 
                        $Tnetamt = 0;
                        $nmRs = 0;
                        $x = 0;

                        if ($vucNoParam != '') {
                            $sqD = mysql_query("select * from bq_opvchrdtl where vouchrno='$vucNoParam'");
                            if ($sqD && mysql_num_rows($sqD) > 0) {
                                $nmRs = mysql_num_rows($sqD);
                                while($roD = mysql_fetch_array($sqD)){
                                    $x++;
                                    $lnitmTot = $roD['item_qty'] * $roD['item_rate'];
                                    $itmTot = ($roD['item_qty'] * $roD['item_rate']) - $roD['discamt'];
                                    
                                    $sqI = mysql_query("select * from bq_itemmaster where item_name='".$roD['item_name']."'");
                                    $roI = ($sqI && mysql_num_rows($sqI) > 0) ? mysql_fetch_array($sqI) : array();

                                    $allow_disc = (isset($roI['allow_disc']) && $roI['allow_disc'] == 'yes') ? 'Y' : 'N';
                                    
                                    $sqT = mysql_query("select SUM(taxamt)AS txAmt, taxcode from bq_opvchrtaxdtl where item_name='".$roD['item_name']."' AND vouchrno='$vucNoParam'");
                                    $roT = ($sqT && mysql_num_rows($sqT) > 0) ? mysql_fetch_array($sqT) : array();
                                    $txAmt = isset($roT['txAmt']) ? (float)$roT['txAmt'] : 0.00;
                                    $netAmt = $itmTot + $txAmt;	
                                    $Tnetamt += $netAmt;
                        ?>
                            <tr>
                                <td>
                                    <input name="opvchrdtl_id[]" id="opvchrdtl_id<?php echo $x;?>" type="hidden" value="<?php echo htmlspecialchars($roD['opvchrdtl_id']); ?>" />
                                    <input name="s_no[]" id="s_no<?php echo $x;?>" type="text" class="bqt-cell-input text-center" value="<?php echo $x; ?>" readonly />
                                    <input name="taxcde[]" id="taxcde<?php echo $x;?>" type="hidden" value="<?php echo htmlspecialchars($roD['taxstruccode']); ?>" />
                                    <input name="item_code[]" id="item_code<?php echo $x;?>" type="hidden" value="<?php echo isset($roD['item_code']) ? htmlspecialchars($roD['item_code']) : ''; ?>" />
                                    <input name="sac[]" id="sac<?php echo $x;?>" type="hidden" value="<?php echo isset($roD['sac']) ? htmlspecialchars($roD['sac']) : ''; ?>" />
                                </td>
                                <td>
                                    <input name="item_name[]" id="item_name<?php echo $x;?>" type="text" class="bqt-cell-input" value="<?php echo isset($roD['item_name']) ? htmlspecialchars($roD['item_name']) : ''; ?>" readonly />
                                </td>
                                <td>
                                    <input name="item_qty[]" id="item_qty<?php echo $x;?>" type="text" class="bqt-cell-input text-center" value="<?php echo isset($roD['item_qty']) ? htmlspecialchars($roD['item_qty']) : ''; ?>" readonly />
                                </td>
                                <td>
                                    <input name="item_rate[]" id="item_rate<?php echo $x;?>" type="text" class="bqt-cell-input text-right" value="<?php echo isset($roD['item_rate']) ? htmlspecialchars($roD['item_rate']) : ''; ?>" readonly />
                                </td>
                                <td>
                                    <input name="item_total[]" id="item_total<?php echo $x;?>" type="text" class="bqt-cell-input text-right" value="<?php echo number_format($lnitmTot, 2); ?>" readonly />
                                </td>
                                <td>
                                    <?php if($roD['discamt'] > 0) { ?>
                                        <input name="disc_flag[]" id="disc_flag<?php echo $x;?>" class="bqt-cell-input text-center" value="Y" />
                                    <?php } else { ?>
                                        <input name="disc_flag[]" id="disc_flag<?php echo $x;?>" class="bqt-cell-input text-center" value="<?php echo htmlspecialchars($allow_disc); ?>" />
                                    <?php } ?>
                                </td>
                                <td>
                                    <input name="disc_perc[]" id="disc_perc<?php echo $x;?>" class="bqt-cell-input text-center" value="Amt" />
                                </td>
                                <td>
                                    <input name="disc_amount[]" id="disc_amount<?php echo $x;?>" type="text" class="bqt-cell-input text-right" value="<?php echo isset($roD['discperamt']) ? sprintf("%01.2f", $roD['discperamt']) : '0.00'; ?>" />
                                </td>
                                <td>
                                    <input name="disc_val[]" id="disc_val<?php echo $x;?>" type="text" class="bqt-cell-input text-right" value="<?php echo isset($roD['discamt']) ? sprintf("%01.2f", $roD['discamt']) : '0.00'; ?>" readonly />
                                </td>
                                <td>
                                    <input name="tax_code[]" id="tax_code<?php echo $x;?>" type="hidden" value="<?php echo isset($roT['taxcode']) ? htmlspecialchars($roT['taxcode']) : ''; ?>" />
                                    <input name="str_code[]" id="str_code<?php echo $x;?>" type="hidden" value="<?php echo isset($roD['taxstruccode']) ? htmlspecialchars($roD['taxstruccode']) : ''; ?>" />
                                    <input name="tax_amount[]" id="tax_amount<?php echo $x;?>" type="text" class="bqt-cell-input text-right" value="<?php echo sprintf("%01.2f", $txAmt); ?>" readonly />
                                </td>
                                <td>
                                    <input name="net_amount[]" id="net_amount<?php echo $x;?>" type="text" class="bqt-cell-input text-right" style="font-weight:bold;" value="<?php echo sprintf("%01.2f", $netAmt); ?>" readonly />
                                </td>
                                <td>
                                    <input name="split[]" id="split<?php echo $x;?>" type="text" class="bqt-cell-input text-center" value="<?php echo isset($roD['split']) ? htmlspecialchars($roD['split']) : ''; ?>" />
                                </td>
                            </tr>
                        <?php 
                                } 
                            } 
                        } 
                        ?>

                        <?php for($cc = $nmRs + 1; $cc <= 6; $cc++){ ?>
                            <tr>
                                <td><input name="s_no[]" id="s_no<?php echo $cc;?>" type="text" class="bqt-cell-input text-center" value="<?php echo $cc;?>" readonly /></td>
                                <td><input name="itemnamem[]" id="itemm_name<?php echo $cc;?>" type="text" class="bqt-cell-input" value="" readonly /></td>
                                <td><input name="itemm_qty[]" id="itemm_qty<?php echo $cc;?>" type="text" class="bqt-cell-input text-center" value="" readonly /></td>
                                <td><input name="itemm_rate[]" id="itemm_rate<?php echo $cc;?>" type="text" class="bqt-cell-input text-right" value="" readonly /></td>
                                <td><input name="itemm_total[]" id="itemm_total<?php echo $cc;?>" type="text" class="bqt-cell-input text-right" value="" readonly /></td>
                                <td><input name="discm_flag[]" id="discm_flag<?php echo $cc;?>" type="text" class="bqt-cell-input text-center" value="" readonly /></td>
                                <td><input name="discm_flag[]" id="discm_flag2_<?php echo $cc;?>" type="text" class="bqt-cell-input text-center" value="" readonly /></td>
                                <td><input name="discm_amount[]" id="discm_amount<?php echo $cc;?>" type="text" class="bqt-cell-input text-right" value="" readonly /></td>
                                <td><input name="discm_amount[]" id="discm_amount2_<?php echo $cc;?>" type="text" class="bqt-cell-input text-right" value="" readonly /></td>
                                <td><input name="taxm_amount[]" id="taxm_amount<?php echo $cc;?>" type="text" class="bqt-cell-input text-right" value="" readonly /></td>
                                <td><input name="netm_amount[]" id="netm_amount<?php echo $cc;?>" type="text" class="bqt-cell-input text-right" value="" readonly /></td>
                                <td><input name="splitm[]" id="splitm<?php echo $cc;?>" type="text" class="bqt-cell-input text-center" value="" readonly /></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Bottom Sections Grid -->
                <div class="bqt-bottom-grid">

                    <!-- Advance Receipts -->
                    <div class="bqt-bottom-col">
                        <div class="bqt-section-title">Advance Details</div>
                        <table class="bqt-subtable" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:35%;">Receipt</th>
                                    <th style="width:35%;">Date</th>
                                    <th style="width:30%;">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $nmrA = 0;
                            if ($vucNoParam != '' && isset($row['fpno']) && $row['fpno'] != '') {
                                $ssC_res = mysql_query("select hallbook_id from bq_opfpmenuhdr where fpno='".$row['fpno']."' AND bill_status!='3'");
                                if ($ssC_res && mysql_num_rows($ssC_res) > 0) {
                                    $ssC = mysql_fetch_array($ssC_res);
                                    $sqsC = mysql_query("select * from bq_hallresvadv where booking_no='".$row['bkno']."' AND status='1' AND hallbook_id='".$ssC['hallbook_id']."'");
                                    if ($sqsC && mysql_num_rows($sqsC) > 0) {
                                        $nmrA = mysql_num_rows($sqsC);
                                        while($rwsC = mysql_fetch_array($sqsC)){
                            ?>
                                <tr>
                                    <td><input name="receipt[]" type="text" class="bqt-cell-input text-center" value="<?php echo htmlspecialchars($rwsC['receipt_no']); ?>" readonly /></td>
                                    <td><input name="receipt_date[]" type="text" class="bqt-cell-input text-center" value="<?php echo htmlspecialchars($rwsC['cur_date']); ?>" readonly /></td>
                                    <td><input name="receipt_amount[]" type="text" class="bqt-cell-input text-right" value="<?php echo number_format($rwsC['amount'] + $rwsC['sgst'] + $rwsC['cgst'], 2); ?>" readonly /></td>
                                </tr>
                            <?php 
                                        } 
                                    } 
                                }
                            }
                            ?>
                            <?php for($cc = $nmrA; $cc < 3; $cc++){ ?>
                                <tr>
                                    <td><input name="receiptm[]" type="text" class="bqt-cell-input text-center" value="" readonly /></td>
                                    <td><input name="receiptm_date[]" type="text" class="bqt-cell-input text-center" value="" readonly /></td>
                                    <td><input name="receiptm_amount[]" type="text" class="bqt-cell-input text-right" value="" readonly /></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Split Bill Totals -->
                    <div class="bqt-bottom-col">
                        <div class="bqt-section-title">Bill Split Summary</div>
                        <table class="bqt-subtable" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:35%;">Bill #</th>
                                    <th style="width:45%;">Amount</th>
                                    <th style="width:20%;">Y/N</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $nmD = 0;
                            $xS = 0;
                            if ($vucNoParam != '') {
                                $sqD_s = mysql_query("select sum(net_amount)AS totV, sum(tax_amt)AS totA, split from bq_opvchrdtl where vouchrno='$vucNoParam' AND bill_status='1' group by split");
                                if ($sqD_s && mysql_num_rows($sqD_s) > 0) {
                                    $nmD = mysql_num_rows($sqD_s);
                                    while($rw = mysql_fetch_array($sqD_s)){
                                        $xS++;
                            ?>
                                <tr>
                                    <td><input name="billm_no[]" type="text" class="bqt-cell-input text-center" value="<?php echo $xS; ?>" readonly /></td>
                                    <td><input name="bill_amount[]" type="text" class="bqt-cell-input text-right" style="font-weight:bold;" value="<?php echo sprintf("%01.2f", $Tnetamt); ?>" readonly /></td>
                                    <td><input name="bill_sel[]" type="checkbox" class="chk" onclick="setMenu();" style="cursor:pointer;" value="<?php echo htmlspecialchars($rw['split']); ?>" /></td>
                                </tr>
                            <?php 
                                    } 
                                }
                            }
                            ?>
                            <?php for($cc = $nmD; $cc < 3; $cc++){ ?>
                                <tr>
                                    <td><input name="billm_no[]" type="text" class="bqt-cell-input text-center" value="" readonly /></td>
                                    <td><input name="billm_amount[]" type="text" class="bqt-cell-input text-right" value="" readonly /></td>
                                    <td><input name="billm_sel[]" type="checkbox" disabled /></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

            <!-- Card Bottom Action Bar Matching Master Standard -->
            <div class="mypay-card-footer">
                <button type="button" id="submit" class="btn-mypay-action" onclick="chkOutBillPrint();" title="Save Split (Ctrl+S)">
                    <i class="fa fa-floppy-o"></i> Save
                </button>
                <button type="button" id="billsbt" name="billsbt" class="btn-mypay-action" onClick="popupBillPrint();" title="Generate Bill">
                    <i class="fa fa-file-text-o"></i> Bill
                </button>
                <button type="button" id="printFlio" class="btn-mypay-action" data-toggle="modal" data-target="#myModal" onclick="selBadFeed();" title="View Guest Details">
                    <i class="fa fa-eye"></i> View Bill
                </button>
                <a href="view-bqtbill-details.php?fromdate=<?php echo $curDate;?>&todate=<?php echo $curDate;?>&val=" class="btn-mypay-action" title="View Bill Register (Ctrl+V)">
                    <i class="fa fa-list"></i> View Register
                </a>
                <button type="button" id="exit" name="exit" class="btn-mypay-action" onClick="extBUtton();" title="Exit (Ctrl+E)">
                    <i class="fa fa-times" style="color:#e74c3c;"></i> Exit
                </button>
            </div>

        </form>
    </div>

</div>

<?php include("../../footer.php"); ?>
</body>
</html>
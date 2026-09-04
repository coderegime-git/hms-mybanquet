<?php
error_reporting(0);
ob_start();
include("../../config.php");
include("../../header.php");
?>
<link rel="stylesheet" href="<?php echo $home_path;?>/css/mypay-master.css">
<link rel="stylesheet" href="../../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script type="text/javascript" src="<?php echo $home_path;?>/js/shortcut.js"></script>

<style type="text/css">
/* ==========================================================================
   Settlement Form - Standardized Unified Payroll (MyPay) Design System
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

/* Master Form Card */
.mypay-card {
    width: 980px !important;
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

/* Header Info Table */
.settle-header-table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 8px !important;
    border: none !important;
    margin-bottom: 15px !important;
}

.settle-header-table td {
    padding: 2px 4px !important;
    border: none !important;
    vertical-align: middle !important;
}

.settle-header-table td.label-col {
    font-size: 12.5px !important;
    font-weight: bold !important;
    color: #333333 !important;
    text-align: right !important;
    padding-right: 8px !important;
    white-space: nowrap !important;
}

.settle-header-table td.input-col {
    padding-right: 12px !important;
}

.settle-input {
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

.settle-input:focus {
    border-color: #0084b4 !important;
    box-shadow: 0 0 3px rgba(0, 132, 180, 0.3) !important;
}

.settle-input[readonly] {
    background-color: #f8fafc !important;
    color: #334155 !important;
    border-color: #cbd5e1 !important;
}

.settle-select {
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

.settle-select:focus {
    border-color: #005b8a !important;
    box-shadow: 0 0 3px rgba(0, 115, 181, 0.3) !important;
}

/* Payment Mode Container Layout */
.settle-payment-layout {
    display: flex !important;
    gap: 12px !important;
    margin-top: 10px !important;
    align-items: stretch !important;
}

/* Left Mode Buttons Column */
.settle-mode-column {
    width: 130px !important;
    flex-shrink: 0 !important;
}

.settle-mode-table {
    width: 100% !important;
    border-collapse: collapse !important;
    border: 1px solid #cbd5e1 !important;
    background: #ffffff !important;
}

.settle-mode-table th {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    font-size: 12px !important;
    font-weight: bold !important;
    text-align: center !important;
    height: 32px !important;
    padding: 4px 6px !important;
    border: 1px solid #0073B5 !important;
}

.settle-mode-table td {
    padding: 3px !important;
    border: 1px solid #e2e8f0 !important;
    text-align: center !important;
    background: #f8fafc !important;
}

.btn-settle-mode {
    width: 100% !important;
    height: 28px !important;
    line-height: 26px !important;
    background: #ffffff !important;
    color: #0073B5 !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 3px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    font-weight: bold !important;
    cursor: pointer !important;
    text-align: center !important;
    transition: all 0.15s ease !important;
    outline: none !important;
}

.btn-settle-mode:hover {
    background: #0073B5 !important;
    color: #ffffff !important;
    border-color: #0073B5 !important;
}

.btn-settle-mode:disabled {
    background: #f1f5f9 !important;
    color: #94a3b8 !important;
    border-color: #e2e8f0 !important;
    cursor: not-allowed !important;
}

.btnUndLine {
    text-decoration: underline !important;
}

/* Right Table of Payment Entries */
.settle-entries-column {
    flex-grow: 1 !important;
    overflow-x: auto !important;
}

.settle-entries-table {
    width: 100% !important;
    border-collapse: collapse !important;
    border: 1px solid #cbd5e1 !important;
    background: #ffffff !important;
}

.settle-entries-table thead tr th {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    font-size: 12px !important;
    font-weight: bold !important;
    text-align: center !important;
    height: 32px !important;
    padding: 4px 8px !important;
    border: 1px solid #0073B5 !important;
    white-space: nowrap !important;
}

.settle-entries-table tbody td {
    padding: 4px 6px !important;
    border: 1px solid #e2e8f0 !important;
    text-align: center !important;
    vertical-align: middle !important;
    background: #ffffff !important;
}

.settle-entries-table tbody tr:hover td {
    background-color: #f8fbfe !important;
}

.settle-cell-input {
    width: 100% !important;
    height: 26px !important;
    line-height: 26px !important;
    padding: 0 6px !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 3px !important;
    font-size: 12px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    color: #333333 !important;
    background: #ffffff !important;
    box-sizing: border-box !important;
    outline: none !important;
    transition: border-color 0.15s ease-in-out !important;
}

.settle-cell-input:focus {
    border-color: #0084b4 !important;
    box-shadow: 0 0 3px rgba(0, 132, 180, 0.3) !important;
}

.settle-cell-input[disabled] {
    background-color: #f8fafc !important;
    color: #94a3b8 !important;
    border-color: #e2e8f0 !important;
}

.settle-cell-input.text-right {
    text-align: right !important;
}

.settle-cell-select {
    width: 100% !important;
    height: 26px !important;
    line-height: 26px !important;
    padding: 0 4px !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 3px !important;
    font-size: 12px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    color: #333333 !important;
    background: #ffffff !important;
    box-sizing: border-box !important;
    outline: none !important;
    cursor: pointer !important;
}

.settle-cell-select[disabled] {
    background-color: #f8fafc !important;
    color: #94a3b8 !important;
    border-color: #e2e8f0 !important;
    cursor: not-allowed !important;
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

.btn-mypay-action:hover:not(:disabled) {
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

    $("#msgFo").fadeOut(5000);
    $("#msgFoprop").fadeOut(7000);
    jQuery("#hotelDefi").validationEngine();

    $("#comp_desc").keyup(function(){
        $.ajax({
            type: "POST",
            url: "../../action/selectCOMPNoCheckOut.php",
            data: 'keyword=' + $(this).val(),
            beforeSend: function(){
                $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data){
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#search-box").css("background", "#FFF");
            }
        });
    });

    $('input[name^=cashrcd_amt]').on('click', function() {
        var bal = $("#balance").val();
        var Bval = parseFloat($("#bill_amt").val());
        $("#cashrcd_amt").val(bal);
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        bal = $("#balance").val();
        if(bal == 0){
            $("#confirm").removeAttr('disabled'); 
        } else {
            $("#confirm").attr('disabled', 'disabled'); 
        }
        if(isNaN(bal)){
            $("#balance").val('');
        }
    }); 

    $('input[name^=cardrcd_amt]').on('click', function() {
        var bal = $("#balance").val();
        var Bval = parseFloat($("#bill_amt").val());
        $("#cardrcd_amt").val(bal);
        var cardRcd = parseFloat($("#cardrcd_amt").val() || 0);
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        bal = $("#balance").val();
        if(bal == 0){
            $("#confirm").removeAttr('disabled'); 
        } else {
            $("#confirm").attr('disabled', 'disabled'); 
        }
        if(isNaN(bal)){
            $("#balance").val('');
        }
        if(cardRcd != 0){
            $("#card_desc").removeAttr('disabled');
        } else {
            $("#card_desc").attr('disabled', 'disabled');
            $("#card_desc").val('');
        }
    }); 

    $('input[name^=upircd_amt]').on('click', function() {
        var bal = $("#balance").val();
        var Bval = parseFloat($("#bill_amt").val());
        $("#upircd_amt").val(bal);
        var upiRcd = parseFloat($("#upircd_amt").val() || 0);
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        bal = $("#balance").val();
        if(bal == 0){
            $("#confirm").removeAttr('disabled'); 
        } else {
            $("#confirm").attr('disabled', 'disabled'); 
        }
        if(isNaN(bal)){
            $("#balance").val('');
        }
        if(upiRcd != 0){
            $("#upi_desc").removeAttr('disabled');
        } else {
            $("#upi_desc").attr('disabled', 'disabled');
        }
    });

    $('input[name^=comprcd_amt]').on('click', function() {
        var bal = $("#balance").val();
        var Bval = parseFloat($("#bill_amt").val());
        $("#comprcd_amt").val(bal);
        var cardRcd = parseFloat($("#comprcd_amt").val() || 0);
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        bal = $("#balance").val();
        if(bal == 0){
            $("#confirm").removeAttr('disabled'); 
        } else {
            $("#confirm").attr('disabled', 'disabled'); 
        }
        if(isNaN(bal)){
            $("#balance").val('');
        }
        if(cardRcd != 0){
            $("#comp_desc").removeAttr('disabled');
        } else {
            $("#comp_desc").attr('disabled', 'disabled');
            $("#comp_desc").val('');
        }
    });

    $('input[name^=chequercd_amt]').on('click', function() {
        var bal = $("#balance").val();
        var Bval = parseFloat($("#bill_amt").val());
        $("#chequercd_amt").val(bal);
        var cardRcd = parseFloat($("#chequercd_amt").val() || 0);
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        bal = $("#balance").val();
        if(bal == 0){
            $("#confirm").removeAttr('disabled'); 
        } else {
            $("#confirm").attr('disabled', 'disabled'); 
        }
        if(cardRcd != 0){
            $("#cheq_desc").removeAttr('disabled');
        } else {
            $("#cheq_desc").attr('disabled', 'disabled');
            $("#cheq_desc").val('');
        }
        if(isNaN(bal)){
            $("#balance").val('');
        }
    });

    $('input[name^=neftrcd_amt]').on('click', function() {
        var bal = $("#balance").val();
        var Bval = parseFloat($("#bill_amt").val());
        $("#neftrcd_amt").val(bal);
        var cardRcd = parseFloat($("#neftrcd_amt").val() || 0);
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        bal = $("#balance").val();
        if(bal == 0){
            $("#confirm").removeAttr('disabled'); 
        } else {
            $("#confirm").attr('disabled', 'disabled'); 
        }
        if(isNaN(bal)){
            $("#balance").val('');
        }
        if(cardRcd != 0){
            $("#neft_desc").removeAttr('disabled');
        } else {
            $("#neft_desc").attr('disabled', 'disabled');
            $("#neft_desc").val('');
            $("#neft_rem").val('');
        }
    });

    $('input[name^=roomrcd_amt]').on('click', function() {
        var bal = $("#balance").val();
        var Bval = parseFloat($("#bill_amt").val());
        $("#roomrcd_amt").val(bal);
        var cardRcd = parseFloat($("#roomrcd_amt").val() || 0);
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        bal = $("#balance").val();
        if(bal == 0){
            $("#confirm").removeAttr('disabled'); 
        } else {
            $("#confirm").attr('disabled', 'disabled'); 
        }
        if(isNaN(bal)){
            $("#balance").val('');
        }
        if(cardRcd != 0){
            $("#room_desc").removeAttr('disabled');
        } else {
            $("#room_desc").attr('disabled', 'disabled');
            $("#room_desc").val('');
            $("#room_rem").val('');
        }
    });

    $('input[name^=refundrcd_amt]').on('click', function() {
        var bal = $("#balance").val();
        var Bval = parseFloat($("#bill_amt").val());
        $("#refundrcd_amt").val(bal);
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        if(isNaN($("#balance").val())){
            $("#balance").val('');
        }
    });

    $('input[name^=voidrcd_amt]').on('click', function() {
        var bal = $("#balance").val();
        var Bval = parseFloat($("#bill_amt").val());
        $("#voidrcd_amt").val(bal);
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        bal = $("#balance").val();
        if(bal == 0){
            $("#confirm").removeAttr('disabled'); 
        } else {
            $("#confirm").attr('disabled', 'disabled'); 
        }
        if(isNaN(bal)){
            $("#balance").val('');
        }
    });

    /* Keyup handlers */
    $('input[name^=cashrcd_amt]').live('keyup', function() {
        var Bval = parseFloat($("#bill_amt").val());
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        var bal = $("#balance").val();
        if(bal == 0){
            $("#confirm").removeAttr('disabled'); 
        } else {
            $("#confirm").attr('disabled', 'disabled'); 
        }
        if(isNaN(bal)){
            $("#balance").val('');
        }
    });

    $('input[name^=cardrcd_amt]').live('keyup', function() {
        var cardRcd = parseFloat($("#cardrcd_amt").val() || 0);
        var Bval = parseFloat($("#bill_amt").val());
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        var bal = $("#balance").val();
        if(bal == 0){
            $("#confirm").removeAttr('disabled'); 
        } else {
            $("#confirm").attr('disabled', 'disabled'); 
        }
        if(isNaN(bal)){
            $("#balance").val('');
        }
        if(cardRcd != 0){
            $("#card_desc").removeAttr('disabled');
        } else {
            $("#card_desc").attr('disabled', 'disabled');
        }
    });

    $('input[name^=comprcd_amt]').live('keyup', function() {
        var cardRcd = parseFloat($("#comprcd_amt").val() || 0);
        var Bval = parseFloat($("#bill_amt").val());
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        var bal = $("#balance").val();
        if(bal == 0){
            $("#confirm").removeAttr('disabled'); 
        } else {
            $("#confirm").attr('disabled', 'disabled'); 
        }
        if(isNaN(bal)){
            $("#balance").val('');
        }
        if(cardRcd != 0){
            $("#comp_desc").removeAttr('disabled');
        } else {
            $("#comp_desc").attr('disabled', 'disabled');
        }
    });

    $('input[name^=chequercd_amt]').live('keyup', function() {
        var Bval = parseFloat($("#bill_amt").val());
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        var bal = $("#balance").val();
        if(bal == 0){
            $("#confirm").removeAttr('disabled'); 
        } else {
            $("#confirm").attr('disabled', 'disabled'); 
        }
        if(isNaN(bal)){
            $("#balance").val('');
        }
    });

    $('input[name^=neftrcd_amt]').live('keyup', function() {
        var Bval = parseFloat($("#bill_amt").val());
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        var bal = $("#balance").val();
        if(bal == 0){
            $("#confirm").removeAttr('disabled'); 
        } else {
            $("#confirm").attr('disabled', 'disabled'); 
        }
        if(isNaN(bal)){
            $("#balance").val('');
        }
    });

    $('input[name^=roomrcd_amt]').live('keyup', function() {
        var cardRcd = parseFloat($("#roomrcd_amt").val() || 0);
        var Bval = parseFloat($("#bill_amt").val());
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        var bal = $("#balance").val();
        if(bal == 0){
            $("#confirm").removeAttr('disabled'); 
        } else {
            $("#confirm").attr('disabled', 'disabled'); 
        }
        if(isNaN(bal)){
            $("#balance").val('');
        }
        if(cardRcd != 0){
            $("#room_desc").removeAttr('disabled');
        } else {
            $("#room_desc").attr('disabled', 'disabled');
        }
    });

    $('input[name^=refundrcd_amt]').live('keyup', function() {
        var Bval = parseFloat($("#bill_amt").val());
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        if(isNaN($("#balance").val())){
            $("#balance").val('');
        }
    });

    $('input[name^=voidrcd_amt]').live('keyup', function() {
        var Bval = parseFloat($("#bill_amt").val());
        var totTt = 0;
        $(".amtBal").each(function(){
            totTt += parseFloat($(this).val() || 0);
        });
        var csBlAmt = parseFloat(Bval - totTt);
        $("#balance").val(csBlAmt.toFixed(2));
        if(isNaN($("#balance").val())){
            $("#balance").val('');
        }
    });

    $('.inputs').keydown(function (e){
        if(e.keyCode == 13){
            $(this).next('.inputs').focus();
        }
    });

    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+S", function() { 
            if(!$("#confirm").is(':disabled')) {
                $("#confirm").click();
            }
        });
        shortcut.add("Ctrl+E", function() { 
            window.location.href = "<?php echo $home_path; ?>/dashboard.php";
        });
    }
});

function formSubmit() {
    $("#refundrcd_amt").removeAttr('disabled'); 
    var menuStr = "";
    $('.remSum').each(function(i,v){
        if($(this).val() != '') { 
            menuStr += $(this).val() + ',';
        }
    });
    menuStr = menuStr.slice(0, -1);
    $("#hid_menu").val(menuStr);
    
    var menuTp = "";
    $('.remTIps').each(function(i,v){
        if($(this).val() != '') { 
            menuTp += $(this).val() + ',';
        }
    });
    menuTp = menuTp.slice(0, -1);
    $("#hid_tips").val(menuTp);

    var csh = $("#cashrcd_amt").val();
    var cshRe = $("#cash_rem").val();
    var crd = $("#cardrcd_amt").val();
    var crdSc = $("#card_desc").val() ? $("#card_desc").val().trim() : '';
    var crdRm = $("#card_rem").val() ? $("#card_rem").val().trim() : '';
    var cheqAmt = $("#chequercd_amt").val();
    var cheqDsc = $("#cheq_desc").val();
    var cheqRem = $("#cheq_rem").val();
    var roomAmt = $("#roomrcd_amt").val();
    var roomDsc = $("#room_desc").val();
    var roomRem = $("#room_rem").val();
    var voidAmt = $("#voidrcd_amt").val();
    var voidRem = $("#void_rem").val();

    if(csh > 0 && csh >= 50000 && cshRe == ""){
        alert("Please enter Pan Card Details.");
        return false; 
    } else if(crd > 0 && crdSc == ""){
        alert("Please select card type.");
        return false; 
    } else if(crd > 0 && crdRm == ""){
        alert("Please enter card no & details.");
        return false; 
    } else if(cheqAmt > 0 && cheqDsc == ""){
        alert("Please select cheque type.");
        return false; 
    } else if(cheqAmt > 0 && cheqRem == ""){
        alert("Please enter cheque no & details.");
        return false; 
    } else if(roomAmt > 0 && roomDsc == ""){
        alert("Please select room no.");
        return false; 
    } else if(roomAmt > 0 && roomRem == ""){
        alert("Please enter room details.");
        return false; 
    } else if(voidAmt > 0 && voidRem == ""){
        alert("Please enter void details.");
        return false; 
    } else {
        return true;
    }
}

function selBkNo() {
    var blno = $("#blno").val();
    $("#room_desc").val('');
    $("#comp_desc").val('');
    $("#card_desc").val('');
    $(".amtBal").each(function(){
        $(this).val('0');
    });
    $('.remSum').each(function(){
        $(this).val('');
    });	

    if(blno == '') {
        $("#fp_no").val('');
        $("#bill_amt").val('');
        $("#guest_name").val('');
        $("#balance").val('');
        $("#comp_name").val('');
        $("#pay_mode").val('');
        $("#bk_no").val(''); 
        $("#bill_date").val('');
        $("#confirm").attr('disabled', 'disabled');
        return;
    }

    $.ajax({
        type: 'GET',
        url: '../../action/selectBILLAmt.php',
        data: { blno: blno },
        success: function(data){
            var opt = data.split(',');
            $("#fp_no").val(opt[0]);
            $("#bill_amt").val(opt[1]);
            $("#guest_name").val(opt[2]);
            $("#balance").val(opt[1]);
            $("#comp_name").val(opt[3]);
            $("#pay_mode").val(opt[4]);
            $("#bk_no").val(opt[5]); 
            $("#bill_date").val(opt[6]); 
            if(opt[1] < 0){
                $("#refundrcd_amt").val(opt[1]); 
                $("#balance").val(0);
                $("#confirm").removeAttr('disabled');
            } else {
                $("#confirm").attr('disabled', 'disabled');
            }
        }
    });	
} 

function selRoomNo() {
    var rmNo = $("#room_desc").val();
    var blAmt = $("#bill_amt").val();
    $.ajax({
        type: 'GET',
        url: '../../action/selectROomNOStatsPOS.php',
        data: { rmNo: rmNo, blAmt: blAmt },
        success: function(data){
            var opt = data.split(',');
            if(opt[0] == 1){
                alert('FO Bill already generated.');
                $("#room_desc").val('');
                $("#balance").val(opt[1]);
                $("#roomrcd_amt").val('');
            } else {
                $("#room_rem").val(data);
            }
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
    <p style="text-align:center;margin:0;">
        <span id="msgFoprop" style="color:#28a745;font-weight:bold;font-size:13px;"></span>
    </p>

    <!-- Master Form Card Container -->
    <div class="mypay-card">
        <div class="mypay-card-header">
            SETTLEMENT
        </div>

        <form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_bqtsettlement.php" method="post">
            <input type="hidden" name="tariff_rt" id="tariff_rt" />
            <input type="hidden" name="taxCodee" id="taxCodee" class="txCde"/>
            <input type="hidden" name="departure_time" id="departure_time"/>
            <input type="hidden" name="fp_no" id="fp_no" />
            <textarea id="hid_menu" name="hid_menu" style="display:none;"></textarea>
            <textarea id="hid_tips" name="hid_tips" style="display:none;"></textarea>

            <div class="mypay-card-body">

                <!-- Header Fields Table -->
                <table class="settle-header-table">
                    <tr>
                        <td class="label-col" style="width:10%;">Bill # :</td>
                        <td class="input-col" style="width:23%;">
                            <select name="blno" id="blno" onChange="selBkNo();" class="settle-select">
                                <option value="">--Select Bill--</option>
                                <?php
                                $sqle = mysql_query("select distinct bill_no from bq_opbillhdr where bill_status='1' order by opbillhdr_id desc");
                                if($sqle && mysql_num_rows($sqle) > 0) {
                                    while($res = mysql_fetch_array($sqle)){
                                ?>
                                    <option value="<?php echo htmlspecialchars($res['bill_no']); ?>"><?php echo htmlspecialchars(strtoupper($res['bill_no'])); ?></option>
                                <?php 
                                    } 
                                } 
                                ?>
                            </select>
                        </td>

                        <td class="label-col" style="width:10%;">Bill Date :</td>
                        <td class="input-col" style="width:18%;">
                            <input name="bill_date" id="bill_date" type="text" class="settle-input" readonly />
                        </td>

                        <td class="label-col" style="width:11%;">Bill Amount :</td>
                        <td class="input-col" style="width:14%;">
                            <input name="bill_amt" id="bill_amt" type="text" class="settle-input text-right" style="font-weight:bold;" readonly />
                        </td>

                        <td class="label-col" style="width:9%;">Balance :</td>
                        <td class="input-col" style="width:14%;">
                            <input name="balance" id="balance" type="text" class="settle-input text-right" style="font-weight:bold;color:#c0392b;" readonly />
                        </td>
                    </tr>

                    <tr>
                        <td class="label-col">Guest Name :</td>
                        <td class="input-col">
                            <input name="guest_name" id="guest_name" type="text" class="settle-input" readonly />
                        </td>

                        <td class="label-col">Company :</td>
                        <td class="input-col">
                            <input name="comp_name" id="comp_name" type="text" class="settle-input" readonly />
                        </td>

                        <td class="label-col">Book # :</td>
                        <td class="input-col">
                            <input name="bk_no" id="bk_no" type="text" class="settle-input" readonly />
                        </td>

                        <td class="label-col">Mode :</td>
                        <td class="input-col">
                            <input name="pay_mode" id="pay_mode" type="text" class="settle-input" readonly />
                        </td>
                    </tr>
                </table>

                <!-- Payment Modes & Amounts Layout -->
                <div class="settle-payment-layout">

                    <!-- Mode Selection Column -->
                    <div class="settle-mode-column">
                        <table class="settle-mode-table">
                            <thead>
                                <tr>
                                    <th>Mode</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td><button type="button" id="cash" name="pay_mode" value="cash" class="btn-settle-mode" onclick="$('input[name^=cashrcd_amt]').click();">&nbsp;<span class="btnUndLine">C</span>ash</button></td></tr>
                                <tr><td><button type="button" id="card" name="pay_mode" value="card" class="btn-settle-mode" onclick="$('input[name^=cardrcd_amt]').click();">&nbsp;<span class="btnUndLine">C</span>ard</button></td></tr>
                                <tr><td><button type="button" id="upi" name="pay_mode" value="upi" class="btn-settle-mode" onclick="$('input[name^=upircd_amt]').click();">&nbsp;<span class="btnUndLine">U</span>PI</button></td></tr>
                                <tr><td><button type="button" id="company" name="pay_mode" value="company" class="btn-settle-mode" onclick="$('input[name^=comprcd_amt]').click();">&nbsp;<span class="btnUndLine">C</span>ompany</button></td></tr>
                                <tr><td><button type="button" id="cheque" name="pay_mode" value="cheque" class="btn-settle-mode" onclick="$('input[name^=chequercd_amt]').click();">&nbsp;<span class="btnUndLine">C</span>heque</button></td></tr>
                                <tr><td><button type="button" id="neft" name="pay_mode" value="neft" class="btn-settle-mode" onclick="$('input[name^=neftrcd_amt]').click();">&nbsp;<span class="btnUndLine">N</span>eft</button></td></tr>
                                <tr><td><button type="button" id="room" name="pay_mode" value="room" class="btn-settle-mode" onclick="$('input[name^=roomrcd_amt]').click();">&nbsp;<span class="btnUndLine">R</span>oom</button></td></tr>
                                <tr><td><button type="button" id="refund" name="pay_mode" value="refund" class="btn-settle-mode" onclick="$('input[name^=refundrcd_amt]').click();">&nbsp;<span class="btnUndLine">R</span>efund</button></td></tr>
                                <tr><td><button type="button" id="void" name="pay_mode" value="void" class="btn-settle-mode" onclick="$('input[name^=voidrcd_amt]').click();">&nbsp;<span class="btnUndLine">V</span>oid</button></td></tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Payment Entries Column -->
                    <div class="settle-entries-column">
                        <table class="settle-entries-table" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 18%;">Amount</th>
                                    <th style="width: 25%;">Description</th>
                                    <th style="width: 17%;">Tips</th>
                                    <th style="width: 40%;">Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Cash -->
                                <tr>
                                    <td><input name="cashrcd_amt" id="cashrcd_amt" type="text" value="0" class="settle-cell-input amtBal text-right" /></td>
                                    <td><input name="cash_desc" id="cash_desc" type="text" value="" class="settle-cell-input" placeholder="Cash" /></td>
                                    <td><input name="cash_tips" id="cash_tips" type="text" value="" class="settle-cell-input remTIps text-right" /></td>
                                    <td><input name="cash_rem" id="cash_rem" type="text" value="" class="settle-cell-input remSum" placeholder="PAN Card Details (if >= 50,000)" /></td>
                                </tr>

                                <!-- Card -->
                                <tr>
                                    <td><input name="cardrcd_amt" id="cardrcd_amt" type="text" value="0" class="settle-cell-input amtBal text-right" /></td>
                                    <td>
                                        <select name="card_desc" id="card_desc" class="settle-cell-select" disabled>
                                            <option value="">--Select Card--</option>
                                            <?php 
                                            $sqlF = mysql_query("select * from company_master where classf='creditcard' AND status='1'");
                                            if($sqlF && mysql_num_rows($sqlF) > 0) {
                                                while($rowF = mysql_fetch_array($sqlF)) { ?>
                                                    <option value="<?php echo htmlspecialchars($rowF['comp_name']); ?>"><?php echo htmlspecialchars(strtoupper($rowF['comp_name'])); ?></option>
                                            <?php } } ?>
                                        </select>
                                    </td>
                                    <td><input name="card_tips" id="card_tips" type="text" value="" class="settle-cell-input remTIps text-right"/></td>
                                    <td><input name="card_rem" id="card_rem" type="text" value="" class="settle-cell-input remSum" placeholder="Card No & Details" /></td>
                                </tr>

                                <!-- UPI -->
                                <tr>
                                    <td><input name="upircd_amt" id="upircd_amt" type="text" value="0" class="settle-cell-input amtBal text-right" /></td>
                                    <td>
                                        <select name="upi_desc" id="upi_desc" class="settle-cell-select" disabled>
                                            <option value="">--Select UPI--</option>
                                            <?php 
                                            $sqlF = mysql_query("select * from company_master where classf='upi'");
                                            if($sqlF && mysql_num_rows($sqlF) > 0) {
                                                while($rowF = mysql_fetch_array($sqlF)) { ?>
                                                    <option value="<?php echo htmlspecialchars($rowF['comp_name']); ?>"><?php echo htmlspecialchars($rowF['comp_name']); ?></option>
                                            <?php } } ?>
                                        </select>
                                    </td>
                                    <td><input name="upi_tips" id="upi_tips" type="text" value="" class="settle-cell-input remTIps text-right" /></td>
                                    <td><input name="upi_rem" id="upi_rem" type="text" value="" class="settle-cell-input remSum" placeholder="UPI Ref / Transaction ID" /></td>
                                </tr>

                                <!-- Company -->
                                <tr>
                                    <td><input name="comprcd_amt" id="comprcd_amt" type="text" value="0" class="settle-cell-input amtBal text-right" /></td>
                                    <td>
                                        <select name="comp_desc" id="comp_desc" class="settle-cell-select" disabled>
                                            <option value="">--Select Company--</option>
                                            <?php 
                                            $sqlBS = mysql_query("select distinct comp_code,comp_name from company_master where classf='company' order by comp_name ASC");
                                            if($sqlBS && mysql_num_rows($sqlBS) > 0) {
                                                while($rowBS = mysql_fetch_array($sqlBS)) { ?>
                                                    <option value="<?php echo htmlspecialchars($rowBS['comp_code']); ?>"><?php echo htmlspecialchars(strtoupper($rowBS['comp_name'])); ?></option>
                                            <?php } } ?>
                                        </select>
                                    </td>
                                    <td><input name="comp_tips" id="comp_tips" type="text" value="" class="settle-cell-input remTIps text-right" /></td>
                                    <td><input name="comp_rem" id="comp_rem" type="text" value="" class="settle-cell-input remSum" placeholder="Company Ref / Details" /></td>
                                </tr>

                                <!-- Cheque -->
                                <tr>
                                    <td><input name="chequercd_amt" id="chequercd_amt" type="text" value="0" class="settle-cell-input amtBal text-right" /></td>
                                    <td><input name="cheq_desc" id="cheq_desc" type="text" value="" class="settle-cell-input datepicker" placeholder="Cheque Date" /></td>
                                    <td><input name="cheq_tips" id="cheq_tips" type="text" value="" class="settle-cell-input remTIps text-right" /></td>
                                    <td><input name="cheq_rem" id="cheq_rem" type="text" value="" class="settle-cell-input remSum" placeholder="Cheque No & Bank Details" /></td>
                                </tr>

                                <!-- NEFT -->
                                <tr>
                                    <td><input name="neftrcd_amt" id="neftrcd_amt" type="text" value="0" class="settle-cell-input amtBal text-right" /></td>
                                    <td><input name="neft_desc" id="neft_desc" type="text" value="" class="settle-cell-input" placeholder="Bank Name" /></td>
                                    <td><input name="neft_tips" id="neft_tips" type="text" value="" class="settle-cell-input remTIps text-right" /></td>
                                    <td><input name="neft_rem" id="neft_rem" type="text" value="" class="settle-cell-input remSum" placeholder="NEFT / UTR Details" /></td>
                                </tr>

                                <!-- Room -->
                                <tr>
                                    <td><input name="roomrcd_amt" id="roomrcd_amt" type="text" value="0" class="settle-cell-input amtBal text-right" /></td>
                                    <td>
                                        <select name="room_desc" id="room_desc" class="settle-cell-select" onChange="selRoomNo();" disabled>
                                            <option value="">--Select Room--</option>
                                        </select>
                                    </td>
                                    <td><input name="room_tips" id="room_tips" type="text" value="" class="settle-cell-input remTIps text-right" /></td>
                                    <td><input name="room_rem" id="room_rem" type="text" value="" class="settle-cell-input remSum" placeholder="Room Guest Details" /></td>
                                </tr>

                                <!-- Refund -->
                                <tr>
                                    <td><input name="refundrcd_amt" id="refundrcd_amt" type="text" value="<?php echo isset($refund) ? htmlspecialchars($refund) : '0'; ?>" class="settle-cell-input amtBal text-right" disabled /></td>
                                    <td><input name="refund_desc" id="refund_desc" type="text" value="" class="settle-cell-input" placeholder="Refund Details" /></td>
                                    <td><input name="refund_tips" id="refund_tips" type="text" value="" class="settle-cell-input remTIps text-right" disabled /></td>
                                    <td><input name="refund_rem" id="refund_rem" type="text" value="" class="settle-cell-input remSum" placeholder="Refund Remarks" /></td>
                                </tr>

                                <!-- Void -->
                                <tr>
                                    <td><input name="voidrcd_amt" id="voidrcd_amt" type="text" value="<?php echo isset($refund) ? htmlspecialchars($refund) : '0'; ?>" class="settle-cell-input amtBal text-right" /></td>
                                    <td><input name="void_desc" id="void_desc" type="text" value="" class="settle-cell-input" placeholder="Void Reason" /></td>
                                    <td><input name="void_tips" id="void_tips" type="text" value="" class="settle-cell-input remTIps text-right" /></td>
                                    <td><input name="void_rem" id="void_rem" type="text" value="" class="settle-cell-input remSum" placeholder="Void Remarks" /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

            <!-- Card Bottom Action Bar Matching Master Standard -->
            <div class="mypay-card-footer">
                <button type="submit" id="confirm" class="btn-mypay-action" onclick="return formSubmit();" disabled title="Submit Settlement (Ctrl+S)">
                    <i class="fa fa-floppy-o"></i> Submit
                </button>
                <a href="<?php echo $home_path; ?>/transaction/frontdesk/view-resettlement.php" class="btn-mypay-action" title="View Re-settlement">
                    <i class="fa fa-refresh"></i> Re-settle
                </a>
                <button type="reset" id="rest" class="btn-mypay-action" title="Clear Form">
                    <i class="fa fa-paint-brush"></i> Clear
                </button>
                <a href="<?php echo $home_path; ?>/dashboard.php" class="btn-mypay-action" title="Exit to Dashboard (Ctrl+E)">
                    <i class="fa fa-times" style="color:#e74c3c;"></i> Exit
                </a>
            </div>

        </form>
    </div>

</div>

<?php include("../../footer.php"); ?>
</body>
</html>
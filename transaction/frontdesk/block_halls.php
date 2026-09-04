<?php
error_reporting(0);
ob_start();
include("../../config.php");
include("../../header.php");
include("../../util.php");

$sqle = mysql_query("SELECT * FROM audt_control where audtcontrol_id='1'");
$rowe = ($sqle && mysql_num_rows($sqle) > 0) ? mysql_fetch_array($sqle) : array();
$audDte = isset($rowe['cur_date']) ? $rowe['cur_date'] : date('d/m/Y');
$cr = explode('/', $audDte);
$crd = (count($cr) == 3) ? ($cr[0].'-'.$cr[1].'-'.$cr[2]) : date('d-m-Y');
?>
<link rel="stylesheet" href="<?php echo $home_path;?>/css/mypay-master.css">
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/js/shortcut.js"></script>

<style type="text/css">
/* Master Form Card Styling for Hall Block */
body, body.bgBODY {
    background-color: #ffffff !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    margin: 0 !important;
    padding: 0 !important;
}

.mypay-container {
    width: 860px !important;
    max-width: 96% !important;
    margin: 20px auto 40px auto !important;
    padding: 0 10px !important;
    box-sizing: border-box !important;
}

/* Master Form Card */
.mypay-card {
    width: 100% !important;
    background: #ffffff !important;
    border: 1px solid #0073B5 !important;
    border-radius: 6px !important;
    overflow: hidden !important;
    box-shadow: 0 2px 8px rgba(0, 115, 181, 0.08) !important;
    margin-bottom: 25px !important;
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
    padding: 25px 35px !important;
    background: #ffffff !important;
}

.mypay-form-table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 12px !important;
    border: none !important;
}

.mypay-form-table td {
    padding: 0 !important;
    border: none !important;
    vertical-align: middle !important;
}

.mypay-label-col {
    width: 30% !important;
    text-align: right !important;
    padding-right: 15px !important;
    font-size: 13px !important;
    font-weight: bold !important;
    color: #333333 !important;
    white-space: nowrap !important;
}

.mypay-label-col em {
    color: #dc3545 !important;
    font-style: normal !important;
    margin-left: 3px !important;
}

.mypay-input-col {
    width: 70% !important;
}

.mypay-input, .mypay-select {
    width: 340px !important;
    max-width: 100% !important;
    height: 30px !important;
    line-height: 30px !important;
    padding: 0 10px !important;
    border: 1px solid #c0c8d0 !important;
    border-radius: 4px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #333333 !important;
    background: #ffffff !important;
    box-sizing: border-box !important;
    outline: none !important;
    transition: border-color 0.15s ease-in-out !important;
}

.mypay-input:focus, .mypay-select:focus {
    border-color: #0073B5 !important;
    box-shadow: 0 0 3px rgba(0, 115, 181, 0.4) !important;
}

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
    padding: 0 16px !important;
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
}

.btn-mypay-action:hover {
    background: #00496e !important;
    color: #ffffff !important;
    text-decoration: none !important;
}

/* Timeline & Schedule Matrix */
.schedule-card {
    width: 100% !important;
    border: 1px solid #c0c8d0 !important;
    border-radius: 6px !important;
    overflow: hidden !important;
    background: #ffffff !important;
    margin-top: 15px !important;
}

.schedule-header {
    background: #f8fafc !important;
    color: #0073B5 !important;
    font-size: 12.5px !important;
    font-weight: bold !important;
    padding: 8px 12px !important;
    border-bottom: 1px solid #e2e8f0 !important;
    text-transform: uppercase !important;
}

.schedule-table {
    width: 100% !important;
    border-collapse: collapse !important;
    font-size: 11.5px !important;
    text-align: center !important;
}

.schedule-table th {
    background-color: #f1f5f9 !important;
    color: #334155 !important;
    border: 1px solid #cbd5e1 !important;
    padding: 6px 2px !important;
    font-size: 11px !important;
    font-weight: bold !important;
}

.schedule-table td {
    border: 1px solid #cbd5e1 !important;
    padding: 4px 2px !important;
    height: 24px !important;
}

.legend-bar {
    display: flex !important;
    flex-wrap: wrap !important;
    gap: 8px !important;
    justify-content: center !important;
    margin-top: 12px !important;
    padding: 8px !important;
    background: #f8fafc !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 4px !important;
}

.legend-item {
    display: inline-flex !important;
    align-items: center !important;
    gap: 5px !important;
    font-size: 11.5px !important;
    font-weight: bold !important;
    color: #333333 !important;
}

.legend-color {
    width: 14px !important;
    height: 14px !important;
    border-radius: 3px !important;
    display: inline-block !important;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+5",
        dateFormat: "dd/mm/yy"
    });

    $("#msgFo").fadeOut(5000);

    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+S", function() { 
            $('#taxTypes').attr('action', '<?php echo $home_path;?>/action/add_block_halls.php');  
            $('#taxTypes').submit(); 
        }); 
        shortcut.add("Ctrl+V", function() { 
            window.location.href = "view-block-hall.php";
        });
        shortcut.add("Ctrl+C", function() { 
            $('#taxTypes').find("input[type=text], select").val("");
        });
        shortcut.add("Ctrl+E", function() { 
            window.location.href = "view-block-hall.php";
        });
    }
});

function selVenueName(){
    var venu = $("#venue").val();
    var bkDt = $("#book_date").val();
    $.ajax({
        type: 'GET',
        url: '../../action/selVeniePROGRESSBar.php',
        data: {
            venu: venu,
            bkDt: bkDt
        },
        success: function(data){
            if(data != 1){
                $("#venPRODef").hide(); 
                $(".venPROShw").show();
                $(".venPROShw1").show();
                $(".venPROShw1").html(data);
            }
        }
    });
}

function selSessionName(){
    var sess = $("#session").val();
    var venu = $("#venue").val();
    var bkDt = $("#book_date").val();

    $.ajax({
        type: 'GET',
        url: '../../action/selSessionblockDet.php',
        data: {
            sess: sess,
            venu: venu,
            bkDt: bkDt
        },
        success: function(data){
            var opt = data.split(',');
            $('#from_time').val(opt[0]);
            $('#to_time').val(opt[1]);
            
            if(opt[0] == 2){
                alert(opt[1]);
                $("#session").val('');
                $("#venue").val('');
                $("#book_date").val('');
                $("#from_time").val('');
                $("#to_time").val('');
                $("#confirm_status").val('');
                $(".venPROShw1").hide();
                $(".venPROShw").hide();
                $("#venPRODef").show(); 
            } else if(opt[0] == 1){
                alert(opt[1]);
                $("#from_time").val(opt[2]);
                $("#to_time").val(opt[3]);
                $("#addBtn").hide();
                $("#releaseBtn").show(); 
            }	
        }
    });
}

function selTOtme(){
    var frT = $("#from_time").val(); 
    var toT = $("#to_time").val(); 
    if(frT && toT) {
        var spF = frT.split(':');
        var sp  = toT.split(':');
        if(parseFloat(spF[0]) > parseFloat(sp[0])){
            alert("To time should not be less than from time.");
            $("#to_time").val('');
        }
    }
}

function validateForm() {
    if($('#book_date').val().trim() == '') {
        alert('Please enter Book Date');
        $('#book_date').focus();
        return false;
    }
    if($('#venue').val() == '') {
        alert('Please select Venue');
        $('#venue').focus();
        return false;
    }
    if($('#session').val() == '') {
        alert('Please select Session');
        $('#session').focus();
        return false;
    }
    if($('#from_time').val().trim() == '') {
        alert('Please enter From Time');
        $('#from_time').focus();
        return false;
    }
    if($('#to_time').val().trim() == '') {
        alert('Please enter To Time');
        $('#to_time').focus();
        return false;
    }
    return true;
}
</script>

<body class="bgBODY">

<div class="mypay-container">

    <?php if(isset($_GET['msg'])){ ?>
        <p style="text-align:center;margin:10px 0;">
            <label id="msgFo" style="color:#28a745;font-weight:bold;font-size:13px;"><?php echo htmlspecialchars($_GET['msg']); ?></label>
        </p>
    <?php } ?>

    <!-- Master Form Card -->
    <div class="mypay-card">
        <div class="mypay-card-header">
            HALL BLOCK
        </div>

        <form id="taxTypes" name="taxTypes" action="<?php echo $home_path;?>/action/add_block_halls.php" method="post" onsubmit="return validateForm();">
            <input type="hidden" name="audDte" id="audDte" value="<?php echo htmlspecialchars($crd); ?>"/>
            <input type="hidden" name="audDteE" id="audDteE" value="<?php echo htmlspecialchars($audDte); ?>"/>
            <input type="hidden" name="confirm_status" value="6" id="confirm_status" />

            <div class="mypay-card-body">
                <table class="mypay-form-table">
                    <tr>
                        <td class="mypay-label-col">Blocked Date<em>*</em> :</td>
                        <td class="mypay-input-col">
                            <input name="book_date" id="book_date" type="text" class="mypay-input datepicker" placeholder="dd/mm/yyyy" autocomplete="off" />
                        </td>
                    </tr>

                    <tr>
                        <td class="mypay-label-col">Venue<em>*</em> :</td>
                        <td class="mypay-input-col">
                            <?php $sqlBS = mysql_query("select distinct venue_code, venue_desc from bq_venue where status='1' order by venue_desc ASC"); ?>
                            <select name="venue" id="venue" class="mypay-select" onChange="selVenueName();">
                                <option value="">--Select Venue--</option>
                                <?php while($rowBS = mysql_fetch_array($sqlBS)) { ?>
                                    <option value="<?php echo htmlspecialchars($rowBS['venue_code']); ?>"><?php echo htmlspecialchars(strtoupper($rowBS['venue_desc'])); ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td class="mypay-label-col">Session<em>*</em> :</td>
                        <td class="mypay-input-col">
                            <?php $sqlSess = mysql_query("select distinct sess_code, sess_name from bqt_session where status='1' order by sess_name ASC"); ?>
                            <select name="session" id="session" class="mypay-select" onChange="selSessionName();">
                                <option value="">--Select Session--</option>
                                <?php while($rowSess = mysql_fetch_array($sqlSess)) { ?>
                                    <option value="<?php echo htmlspecialchars($rowSess['sess_code']); ?>"><?php echo htmlspecialchars(strtoupper($rowSess['sess_name'])); ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td class="mypay-label-col">From Time<em>*</em> :</td>
                        <td class="mypay-input-col">
                            <input name="from_time" id="from_time" type="text" class="mypay-input" placeholder="HH:MM:SS" />
                        </td>
                    </tr>

                    <tr>
                        <td class="mypay-label-col">To Time<em>*</em> :</td>
                        <td class="mypay-input-col">
                            <input name="to_time" id="to_time" type="text" class="mypay-input" placeholder="HH:MM:SS" onblur="selTOtme();" />
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Card Bottom Action Bar -->
            <div class="mypay-card-footer">
                <button type="submit" id="addBtn" name="add" class="btn-mypay-action" title="Submit Block Hall (Ctrl+S)">
                    <i class="fa fa-floppy-o"></i> Submit
                </button>
                <button type="submit" id="releaseBtn" name="release" class="btn-mypay-action" style="display:none;background:#e74c3c;" title="Release Hall">
                    <i class="fa fa-unlock"></i> Release
                </button>
                <a href="view-block-hall.php" class="btn-mypay-action" title="View Block Halls (Ctrl+V)">
                    <i class="fa fa-list"></i> View
                </a>
                <button type="reset" id="rest" class="btn-mypay-action" title="Clear Form (Ctrl+C)">
                    <i class="fa fa-paint-brush"></i> Clear
                </button>
                <a href="view-block-hall.php" class="btn-mypay-action" title="Exit (Ctrl+E)">
                    <i class="fa fa-times" style="color:#e74c3c;"></i> Exit
                </a>
            </div>
        </form>
    </div>

    <!-- Timeline & Availability Grid -->
    <div class="schedule-card">
        <div class="schedule-header">
            <i class="fa fa-calendar"></i> Venue Schedule Matrix (Hours 06:00 - 24:00)
        </div>
        <div style="overflow-x:auto;">
            <table class="schedule-table">
                <tbody id="venPRODef">
                    <tr>
                        <th style="width:120px;">Venue</th>
                        <?php for($cc=6; $cc<=24; $cc++){ ?>
                            <th><?php echo sprintf("%02d", $cc); ?></th>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td style="color:#777;">-</td>
                        <?php for($cc=6; $cc<=24; $cc++){ ?>
                            <td>&nbsp;</td>
                        <?php } ?>
                    </tr>
                </tbody>
                <tbody class="venPROShw" style="display:none;">
                    <tr>
                        <th style="width:120px;">Venue</th>
                        <?php for($cc=6; $cc<=24; $cc++){ ?>
                            <th><?php echo sprintf("%02d", $cc); ?></th>
                        <?php } ?>
                    </tr>
                </tbody>
                <tbody class="venPROShw1" style="display:none;">
                </tbody>
            </table>
        </div>
    </div>

    <!-- Color Legend -->
    <?php
    $rowRv = mysql_fetch_array(mysql_query("select * from bq_stscolor where roomoccupy_id='1'")); 
    $rowRd = mysql_fetch_array(mysql_query("select * from bq_stscolor where roomoccupy_id='2'")); 
    $rowRo = mysql_fetch_array(mysql_query("select * from bq_stscolor where roomoccupy_id='3'")); 
    $rowRg = mysql_fetch_array(mysql_query("select * from bq_stscolor where roomoccupy_id='4'")); 
    $rowRm = mysql_fetch_array(mysql_query("select * from bq_stscolor where roomoccupy_id='5'")); 
    $rowRe = mysql_fetch_array(mysql_query("select * from bq_stscolor where roomoccupy_id='6'")); 
    ?>
    <div class="legend-bar">
        <span class="legend-item"><span class="legend-color" style="background-color:#<?php echo isset($rowRv['room_color']) ? $rowRv['room_color'] : '28a745'; ?>;"></span> Available</span>
        <span class="legend-item"><span class="legend-color" style="background-color:#<?php echo isset($rowRd['room_color']) ? $rowRd['room_color'] : '0073B5'; ?>;"></span> Reserved</span>
        <span class="legend-item"><span class="legend-color" style="background-color:#<?php echo isset($rowRo['room_color']) ? $rowRo['room_color'] : 'ffc107'; ?>;"></span> Wait Listed</span>
        <span class="legend-item"><span class="legend-color" style="background-color:#<?php echo isset($rowRg['room_color']) ? $rowRg['room_color'] : '17a2b8'; ?>;"></span> Enquiry</span>
        <span class="legend-item"><span class="legend-color" style="background-color:#<?php echo isset($rowRm['room_color']) ? $rowRm['room_color'] : '6c757d'; ?>;"></span> Tentative</span>
        <span class="legend-item"><span class="legend-color" style="background-color:#<?php echo isset($rowRe['room_color']) ? $rowRe['room_color'] : 'dc3545'; ?>;"></span> Blocked</span>
    </div>

</div>

<?php include("../../footer.php"); ?>
</body>
</html>
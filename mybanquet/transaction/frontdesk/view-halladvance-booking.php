<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>

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

.btn-mypay-cancel-adv {
    background-color: #d9534f !important;
    color: #ffffff !important;
    border: 1px solid #d43f3a !important;
    border-radius: 3px !important;
    padding: 4px 14px !important;
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
}

.btn-mypay-cancel-adv:hover {
    background-color: #c9302c !important;
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
    min-width: 1450px !important;
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

/* Status Badges */
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

.badge-paid {
    background-color: #e6f9ed !important;
    color: #1a7f37 !important;
    border: 1px solid #abefc6 !important;
}

.badge-settled {
    background-color: #e7f3ff !important;
    color: #0969da !important;
    border: 1px solid #b6d3f2 !important;
}

.badge-cancelled {
    background-color: #fbeae9 !important;
    color: #cf222e !important;
    border: 1px solid #f7c3c0 !important;
}
</style>

<script>
jQuery(document).ready(function(){
    $("#msgFo").fadeOut(5000);

    $(':checkbox').click(function(e){
        if($("input:checked").length > 0){
            $('#approveBtn').show();
        } else {
            $('#approveBtn').hide();
        }
    });	

    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+E", function() { 
            window.location.href = "<?php echo $home_path; ?>/dashboard.php";
        }); 
    }
});

function cancelHallAdvance() {
    if($(".ckPrint:checked").length > 1){
        alert("Please select only one row");
        return;
    }
    if($(".ckPrint:checked").length == 0){
        alert("Please select a record to cancel");
        return;
    }
    var r = confirm("Do you want to cancel Hall Advance?");
    if(r == true){
        var bookN = $('#bookN').val();
        var rcptN = $('#rcptN').val();
        document.location.href = "../../action/update-halladv-approve.php?bookN=" + encodeURIComponent(bookN) + '&rcptN=' + encodeURIComponent(rcptN);
    }
}

function setPrint(id, val, c, d) {	
    $('#bookN').val(c);
    $('#rcptN').val(d);
    
    if($("#" + id).is(":checked")) {  
        $('.ckPrint').each(function(){
            if($(this).attr('id') != id) {
                $(this).attr("disabled", true);
            }
        });
        $('#approveBtn').show();
    } else {
        $('.ckPrint').each(function(){
            $(this).removeAttr("disabled");
        });
        $('#approveBtn').hide();
    }
}
</script>

<body class="bgBODY">

<div class="mypay-container">

    <input type="hidden" id="bookN" name="bookN" />
    <input type="hidden" id="rcptN" name="rcptN" />

    <!-- Top Action Bar -->
    <div class="mypay-actions-bar">
        <div>
            <button type="button" id="approveBtn" class="btn-mypay-cancel-adv" style="display:none;" onclick="cancelHallAdvance();">
                <i class="fa fa-times-circle"></i> Cancel Advance
            </button>
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
                    <th colspan="15">VIEW HALL ADVANCE</th>
                </tr>
                <tr class="header-row">
                    <th style="width: 3%;">Sl.No</th>
                    <th style="width: 3%;">Select</th>
                    <th style="width: 6%;">Receipt Date</th>
                    <th style="width: 6%;">Receipt No</th>
                    <th style="width: 6%;">Booking No</th>
                    <th style="width: 6%;">Function Date</th>
                    <th style="width: 8%;">Venue</th>
                    <th style="width: 6%;">Session</th>
                    <th style="width: 5%;">From Time</th>
                    <th style="width: 5%;">To Time</th>
                    <th style="width: 7%;">Function</th>
                    <th style="width: 10%;">Guest Name</th>
                    <th style="width: 6%;">Amount</th>
                    <th style="width: 5%;">Pay Mode</th>
                    <th style="width: 6%;">Status</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $sqlAC = mysql_query("select * from audt_control where audtcontrol_id='1'");
            $rowAC = mysql_fetch_array($sqlAC);
            $adtCurDt = $rowAC['cur_date'];
            $ad = array_map('trim', explode('/', $adtCurDt));
            $cur = $ad[2] . '-' . $ad[1] . '-' . $ad[0];

            $sql = mysql_query("select * from bq_hallresvadv where status!='3' order by status ASC");
            $x = 0;
            if($sql && is_resource($sql) && mysql_num_rows($sql) > 0) {
                while($row = mysql_fetch_array($sql)) {
                    $x++;
                    $sqB = mysql_query("select * from bq_hallbooking where booking_no='".$row['booking_no']."' AND confirm_status='2'");
                    $roB = ($sqB && mysql_num_rows($sqB) > 0) ? mysql_fetch_array($sqB) : array();

                    $status = ($row['status'] == '1') ? 'Paid' : (($row['status'] == '2') ? 'Settled' : 'Cancelled');
                    $badgeClass = ($row['status'] == '1') ? 'badge-paid' : (($row['status'] == '2') ? 'badge-settled' : 'badge-cancelled');

                    $fn = isset($roB['book_date']) ? array_map('trim', explode('/', $roB['book_date'])) : array('','','');
                    $fnC = (count($fn) == 3) ? $fn[2] . '-' . $fn[1] . '-' . $fn[0] : '';
                    $canCancel = ($row['status'] != '2' && strtotime($fnC) >= strtotime($cur));
            ?>
                <tr>
                    <td><?php echo $x; ?></td>
                    <td>
                        <?php if($canCancel) { ?>
                            <input name="chk[]" type="checkbox" id="c_<?php echo $row['reservadv_id']?>" class="ckPrint" value="<?php echo $row['reservadv_id']?>" onclick="setPrint(this.id, this.value, '<?php echo htmlspecialchars($row['booking_no']); ?>', '<?php echo htmlspecialchars($row['receipt_no']); ?>');" />
                        <?php } else { ?>
                            <input name="chk[]" type="checkbox" disabled />
                        <?php } ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['cur_date']); ?></td>
                    <td><b><?php echo htmlspecialchars(strtoupper($row['receipt_no'])); ?></b></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['booking_no'])); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['function_date'])); ?></td>
                    <td style="text-align:left;"><?php echo isset($roB['venue']) ? htmlspecialchars(strtoupper($roB['venue'])) : ''; ?></td>
                    <td style="text-align:left;"><?php echo isset($roB['session']) ? htmlspecialchars(strtoupper($roB['session'])) : ''; ?></td>
                    <td><?php echo isset($roB['from_time']) ? htmlspecialchars(strtoupper($roB['from_time'])) : ''; ?></td>
                    <td><?php echo isset($roB['to_time']) ? htmlspecialchars(strtoupper($roB['to_time'])) : ''; ?></td>
                    <td style="text-align:left;"><?php echo isset($roB['funct']) ? htmlspecialchars(strtoupper($roB['funct'])) : ''; ?></td>
                    <td style="text-align:left;"><?php echo htmlspecialchars(strtoupper($row['guest_name'])); ?></td>
                    <td><?php echo sprintf("%01.2f", $row['amount']); ?></td>
                    <td><?php echo htmlspecialchars(ucfirst($row['pay_mode'])); ?></td>
                    <td>
                        <span class="badge-status <?php echo $badgeClass; ?>"><?php echo strtoupper($status); ?></span>
                    </td>
                </tr>
            <?php 
                } 
            } else { 
            ?>
                <tr>
                    <td colspan="15" style="padding: 20px; color: #777; text-align: center; font-size: 13px;">
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
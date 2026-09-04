<?php
error_reporting(0);
ob_start();
include("../../config.php");
include("../../header.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id <= 0 && isset($_GET['hallbook_id'])) {
    $id = (int)$_GET['hallbook_id'];
}

$sql = mysql_query("select * from bq_hallbooking where hallbook_id='$id'");
$row = ($sql && mysql_num_rows($sql) > 0) ? mysql_fetch_array($sql) : array();
?>
<link rel="stylesheet" href="<?php echo $home_path;?>/css/mypay-master.css">
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/js/shortcut.js"></script>

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

.mypay-card {
    width: 760px !important;
    max-width: 95% !important;
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
    width: 28% !important;
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
    width: 72% !important;
}

.mypay-input, .mypay-select {
    width: 320px !important;
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
</style>

<script type="text/javascript">
$(document).ready(function(){
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-5:+5",
        dateFormat: "dd/mm/yy"
    });

    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+S", function() { 
            $('#editForm').submit(); 
        }); 
        shortcut.add("Ctrl+V", function() { 
            window.location.href = "view-block-hall.php";
        });
        shortcut.add("Ctrl+E", function() { 
            window.location.href = "view-block-hall.php";
        });
    }
});

function validateEdit() {
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

    <div class="mypay-card">
        <div class="mypay-card-header">
            EDIT BLOCK HALL
        </div>

        <form id="editForm" name="editForm" action="<?php echo $home_path;?>/action/edit_block_halls.php" method="post" onsubmit="return validateEdit();">
            <input type="hidden" name="hallbook_id" value="<?php echo $id; ?>" />

            <div class="mypay-card-body">
                <table class="mypay-form-table">
                    <tr>
                        <td class="mypay-label-col">Booking No :</td>
                        <td class="mypay-input-col">
                            <input type="text" class="mypay-input" value="<?php echo isset($row['booking_no']) ? htmlspecialchars($row['booking_no']) : ''; ?>" readonly style="background-color:#f8fafc;font-weight:bold;" />
                        </td>
                    </tr>

                    <tr>
                        <td class="mypay-label-col">Blocked Date<em>*</em> :</td>
                        <td class="mypay-input-col">
                            <input type="text" name="book_date" id="book_date" class="mypay-input datepicker" value="<?php echo isset($row['book_date']) ? htmlspecialchars($row['book_date']) : ''; ?>" placeholder="dd/mm/yyyy" autocomplete="off" />
                        </td>
                    </tr>

                    <tr>
                        <td class="mypay-label-col">Venue<em>*</em> :</td>
                        <td class="mypay-input-col">
                            <select name="venue" id="venue" class="mypay-select">
                                <option value="">--Select Venue--</option>
                                <?php 
                                $sqlBS = mysql_query("select distinct venue_code, venue_desc from bq_venue where status='1' order by venue_desc ASC"); 
                                if($sqlBS && mysql_num_rows($sqlBS) > 0) {
                                    while($rowBS = mysql_fetch_array($sqlBS)) { 
                                        $sel = (isset($row['venue']) && ($row['venue'] == $rowBS['venue_code'] || $row['venue'] == $rowBS['venue_desc'])) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo htmlspecialchars($rowBS['venue_code']); ?>" <?php echo $sel; ?>><?php echo htmlspecialchars(strtoupper($rowBS['venue_desc'])); ?></option>
                                <?php 
                                    } 
                                } 
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td class="mypay-label-col">Session<em>*</em> :</td>
                        <td class="mypay-input-col">
                            <select name="session" id="session" class="mypay-select">
                                <option value="">--Select Session--</option>
                                <?php 
                                $sqlSess = mysql_query("select distinct sess_code, sess_name from bqt_session where status='1' order by sess_name ASC"); 
                                if($sqlSess && mysql_num_rows($sqlSess) > 0) {
                                    while($rowSess = mysql_fetch_array($sqlSess)) { 
                                        $sel = (isset($row['session']) && ($row['session'] == $rowSess['sess_code'] || $row['session'] == $rowSess['sess_name'])) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo htmlspecialchars($rowSess['sess_code']); ?>" <?php echo $sel; ?>><?php echo htmlspecialchars(strtoupper($rowSess['sess_name'])); ?></option>
                                <?php 
                                    } 
                                } 
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td class="mypay-label-col">From Time<em>*</em> :</td>
                        <td class="mypay-input-col">
                            <input type="text" name="from_time" id="from_time" class="mypay-input" value="<?php echo isset($row['from_time']) ? htmlspecialchars($row['from_time']) : ''; ?>" placeholder="HH:MM:SS" />
                        </td>
                    </tr>

                    <tr>
                        <td class="mypay-label-col">To Time<em>*</em> :</td>
                        <td class="mypay-input-col">
                            <input type="text" name="to_time" id="to_time" class="mypay-input" value="<?php echo isset($row['to_time']) ? htmlspecialchars($row['to_time']) : ''; ?>" placeholder="HH:MM:SS" />
                        </td>
                    </tr>

                    <tr>
                        <td class="mypay-label-col">Remarks :</td>
                        <td class="mypay-input-col">
                            <input type="text" name="remarks" id="remarks" class="mypay-input" value="<?php echo isset($row['remarks']) ? htmlspecialchars($row['remarks']) : ''; ?>" placeholder="Remarks" />
                        </td>
                    </tr>
                </table>
            </div>

            <div class="mypay-card-footer">
                <button type="submit" class="btn-mypay-action" title="Update (Ctrl+S)">
                    <i class="fa fa-floppy-o"></i> Update
                </button>
                <a href="view-block-hall.php" class="btn-mypay-action" title="View (Ctrl+V)">
                    <i class="fa fa-list"></i> View
                </a>
                <button type="reset" class="btn-mypay-action" title="Clear">
                    <i class="fa fa-paint-brush"></i> Clear
                </button>
                <a href="view-block-hall.php" class="btn-mypay-action" title="Exit (Ctrl+E)">
                    <i class="fa fa-times" style="color:#e74c3c;"></i> Exit
                </a>
            </div>

        </form>
    </div>

</div>

<?php include("../../footer.php"); ?>
</body>
</html>

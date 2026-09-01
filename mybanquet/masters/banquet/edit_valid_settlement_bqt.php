<?php
ob_start();
include("../../config.php");
include("../../header.php");

$valid_id = isset($_GET['valid_id']) ? mysql_real_escape_string($_GET['valid_id']) : '';
$sql = mysql_query("select * from pos_validsettle where valid_id='$valid_id'");
$row = ($sql && mysql_num_rows($sql) > 0) ? mysql_fetch_array($sql) : array();
$outlets_arr = isset($row['outlets']) ? explode(',', $row['outlets']) : array();
?>
<!-- Form validation -->
<link rel="stylesheet" href="../../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo $home_path; ?>/js/shortcut.js"></script>

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

/* Centered Edit Form Card Matching Standard Master Design */
.mypay-card {
    width: 820px !important;
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

form#editValidSettleForm {
    margin: 0 !important;
    padding: 0 !important;
    display: block !important;
}

.mypay-card-body {
    padding: 25px 45px 25px 45px !important;
    background: #ffffff !important;
    margin: 0 !important;
}

.mypay-form-table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 16px !important;
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

.mypay-label-cell {
    width: 28% !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #222222 !important;
    font-weight: normal !important;
    padding-right: 15px !important;
    text-align: left !important;
    line-height: 1.2 !important;
    vertical-align: top !important;
    padding-top: 6px !important;
}

.mypay-label-cell label {
    margin: 0 !important;
    padding: 0 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #222222 !important;
    font-weight: normal !important;
    display: inline-block !important;
}

.mypay-label-cell label .req-star {
    color: #d9534f !important;
    font-style: normal !important;
    margin-left: 1px !important;
    font-weight: bold !important;
}

.mypay-input-cell {
    width: 72% !important;
}

.mypay-input, select.mypay-input {
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

.mypay-input:focus, select.mypay-input:focus {
    border-color: #0084b4 !important;
    box-shadow: 0 0 3px rgba(0, 132, 180, 0.3) !important;
}

.mypay-input[readonly] {
    background-color: #f5f5f5 !important;
    color: #555555 !important;
    cursor: default !important;
}

/* Multiselect Checkbox Box */
.mypay-checkbox-grid {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 10px !important;
    background: #fdfdfd !important;
    border: 1px solid #d0d7de !important;
    border-radius: 4px !important;
    padding: 12px 16px !important;
}

.mypay-checkbox-label {
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #333333 !important;
    cursor: pointer !important;
    font-weight: normal !important;
    margin: 0 !important;
}

.mypay-checkbox-label input[type="checkbox"] {
    margin: 0 !important;
    cursor: pointer !important;
    width: 15px !important;
    height: 15px !important;
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
</style>

<script type="text/javascript">
$(document).ready(function(){
    if(typeof jQuery.fn.validationEngine !== 'undefined') {
        $("#editValidSettleForm").validationEngine();
    }
    $("#msgFo").fadeOut(5000);
    $("#outlet_name").focus();
    
    $('#selecctall').click(function(event) { 
        if(this.checked) { 
            $('.chk').each(function() { 
                this.checked = true;               
            });
        } else {
            $('.chk').each(function() { 
                this.checked = false;                       
            });         
        }
    });

    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+S", function() { 
            $('#editValidSettleForm').attr('action', '<?php echo $home_path;?>/action/update_valid_settle.php');  
            $('#editValidSettleForm').submit(); 
        }); 

        shortcut.add("Ctrl+V", function() { 
            window.location.href = "view_valid_settlement_bqt.php";
        });

        shortcut.add("Ctrl+E", function() { 
            window.location.href = "view_valid_settlement_bqt.php";
        });
    }
});
</script>

<body class="bgBODY">

<div class="mypay-container">

    <?php if(isset($_GET['msg'])){ ?>
        <p style="text-align:center;margin:10px 0;">
            <label id="msgFo" style="color:#7B0E0E;font-weight:bold;font-size:13px;"><?php echo htmlspecialchars($_GET['msg']); ?></label>
        </p>
    <?php } ?>

    <!-- Edit Form Card Matching Standard Master Design -->
    <div class="mypay-card">
        <div class="mypay-card-header">
            UPDATE VALID SETTLEMENTS
        </div>

        <form id="editValidSettleForm" name="editValidSettleForm" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/update_valid_settle.php" method="post">
            <input type="hidden" name="valid_id" id="valid_id" value="<?php echo htmlspecialchars($valid_id); ?>" />
            
            <div class="mypay-card-body">
                <table class="mypay-form-table" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="outlet_code">Outlet Code :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="outlet_code" id="outlet_code" class="mypay-input" style="text-transform:uppercase;" value="<?php echo isset($row['outlet_code']) ? htmlspecialchars($row['outlet_code']) : ''; ?>" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="outlet_name">Outlet Name<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="outlet_name" id="outlet_name" data-validation-engine="validate[required]" class="mypay-input validate[required]" value="<?php echo isset($row['outlet_name']) ? htmlspecialchars(ucwords($row['outlet_name'])) : ''; ?>" required />
                            </td>
                        </tr>
                        <tr>
                            <td class="mypay-label-cell">
                                <label>Applicable Outlets :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <div class="mypay-checkbox-grid">
                                    <label class="mypay-checkbox-label">
                                        <input type="checkbox" id="selecctall" /> <b>Select All</b>
                                    </label>
                                    <label class="mypay-checkbox-label">
                                        <input type="checkbox" name="option[]" value="staff" class="chk" <?php if(in_array('staff', $outlets_arr) || in_array('all', $outlets_arr)) echo 'checked'; ?> /> Staff
                                    </label>
                                    <label class="mypay-checkbox-label">
                                        <input type="checkbox" name="option[]" value="credit_card" class="chk" <?php if(in_array('credit_card', $outlets_arr)) echo 'checked'; ?> /> Credit Card
                                    </label>
                                    <label class="mypay-checkbox-label">
                                        <input type="checkbox" name="option[]" value="cash" class="chk" <?php if(in_array('cash', $outlets_arr)) echo 'checked'; ?> /> Cash
                                    </label>
                                    <label class="mypay-checkbox-label">
                                        <input type="checkbox" name="option[]" value="plan" class="chk" <?php if(in_array('plan', $outlets_arr)) echo 'checked'; ?> /> Plan
                                    </label>
                                    <label class="mypay-checkbox-label">
                                        <input type="checkbox" name="option[]" value="company" class="chk" <?php if(in_array('company', $outlets_arr)) echo 'checked'; ?> /> Company
                                    </label>
                                    <label class="mypay-checkbox-label">
                                        <input type="checkbox" name="option[]" value="void" class="chk" <?php if(in_array('void', $outlets_arr)) echo 'checked'; ?> /> Void
                                    </label>
                                    <label class="mypay-checkbox-label">
                                        <input type="checkbox" name="option[]" value="compli" class="chk" <?php if(in_array('compli', $outlets_arr)) echo 'checked'; ?> /> Complimentary
                                    </label>
                                    <label class="mypay-checkbox-label">
                                        <input type="checkbox" name="option[]" value="billhold" class="chk" <?php if(in_array('billhold', $outlets_arr)) echo 'checked'; ?> /> Bill on Hold
                                    </label>
                                    <label class="mypay-checkbox-label">
                                        <input type="checkbox" name="option[]" value="room" class="chk" <?php if(in_array('room', $outlets_arr)) echo 'checked'; ?> /> Room
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Card Bottom Action Bar -->
            <div class="mypay-card-footer">
                <button type="submit" id="update" class="btn-mypay-action" title="Update (Ctrl+S)">
                    <i class="fa fa-floppy-o"></i> Update
                </button>
                <a href="view_valid_settlement_bqt.php" class="btn-mypay-action" title="View (Ctrl+V)">
                    <i class="fa fa-eye"></i> View
                </a>
                <a href="<?php echo $home_path; ?>/masters/banquet/view_valid_settlement_bqt.php" class="btn-mypay-action" title="Exit (Ctrl+E)">
                    <i class="fa fa-times" style="color:#e74c3c;"></i> Exit
                </a>
            </div>
        </form>
    </div>

</div>

<?php include("../../footer.php"); ?>
</body>
</html>

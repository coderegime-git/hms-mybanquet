<?php
ob_start();
include("../../config.php");
include("../../header.php");

$selected_outlet = isset($_GET['outlet']) ? mysql_real_escape_string($_GET['outlet']) : '';
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

/* Centered Form Card Matching Standard Design */
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

form#paymodeRestForm {
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

.mypay-form-table td.mypay-label-cell {
    width: 25% !important;
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
    width: 75% !important;
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

.mypay-input[readonly] {
    background-color: #f5f5f5 !important;
    color: #555555 !important;
    cursor: not-allowed !important;
}

/* Paymode Restriction Inner Table */
.mypay-subtable {
    width: 100% !important;
    border-collapse: collapse !important;
    border: 1px solid #d0d7de !important;
    margin-top: 15px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
}

.mypay-subtable th {
    background-color: #f5f5f5 !important;
    color: #222222 !important;
    font-weight: bold !important;
    text-align: center !important;
    padding: 8px 10px !important;
    border: 1px solid #e0e0e0 !important;
    height: 30px !important;
    font-size: 12px !important;
}

.mypay-subtable td {
    padding: 6px 10px !important;
    border: 1px solid #e0e0e0 !important;
    text-align: center !important;
    vertical-align: middle !important;
    height: 32px !important;
    font-size: 13px !important;
}

.mypay-subtable tr:hover td {
    background-color: #f8fbfe !important;
}

.mypay-subtable select {
    height: 28px !important;
    padding: 0 8px !important;
    border: 1px solid #d0d7de !important;
    border-radius: 3px !important;
    font-size: 12px !important;
    outline: none !important;
    background: #ffffff !important;
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
        $("#paymodeRestForm").validationEngine();
    }
    $("#msgFo").fadeOut(5000);
    
    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+S", function() { 
            $('#paymodeRestForm').attr('action', '../../action/add_paymode_rest.php');  
            $('#paymodeRestForm').submit(); 
        }); 

        shortcut.add("Ctrl+V", function() { 
            window.location.href = "view_paymode_restriction.php";
        });

        shortcut.add("Ctrl+C", function() { 
            clearForm();
        });

        shortcut.add("Ctrl+E", function() { 
            window.location.href = "<?php echo $home_path; ?>/dashboard.php";
        });
    }
});

function outLetCode(){
    var outCde = $('#outlet_code').val();
    if(outCde != ''){
        window.location.href = "paymode_restriction.php?outlet=" + encodeURIComponent(outCde);
    }
}

function clearForm() {
    window.location.href = "paymode_restriction.php";
}
</script>

<body class="bgBODY">

<div class="mypay-container">

    <?php if(isset($_GET['msg'])){ ?>
        <p style="text-align:center;margin:10px 0;">
            <label id="msgFo" style="color:#7B0E0E;font-weight:bold;font-size:13px;"><?php echo htmlspecialchars($_GET['msg']); ?></label>
        </p>
    <?php } ?>

    <!-- Form Card Matching Standard Design -->
    <div class="mypay-card">
        <div class="mypay-card-header">
            PAYMODE RESTRICTION (BQT)
        </div>

        <form id="paymodeRestForm" name="paymodeRestForm" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_paymode_rest.php" method="post">
            <div class="mypay-card-body">
                <?php
                $sqlu = mysql_query("select prop_code,prop_name from property_definition");
                $resultu = ($sqlu && is_resource($sqlu)) ? mysql_fetch_array($sqlu) : null;
                ?>
                <table class="mypay-form-table" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="user_code">User Code<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input name="user_code" id="user_code" type="text" class="mypay-input" value="<?php echo htmlspecialchars($resultu['prop_name']); ?>" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="outlet_code">Outlet Code<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <select name="outlet_code" id="outlet_code" class="mypay-input" onchange="outLetCode();" required>
                                    <option value="">--Select Outlet--</option>
                                    <?php
                                    $sql_out = mysql_query("select outlet_code,outlet_name from pos_outlet");
                                    if($sql_out && is_resource($sql_out)) {
                                        while($res_out = mysql_fetch_array($sql_out)) {
                                            $sel = ($res_out['outlet_code'] == $selected_outlet) ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo htmlspecialchars($res_out['outlet_code']);?>" <?php echo $sel;?>><?php echo htmlspecialchars($res_out['outlet_name']);?></option>
                                    <?php 
                                        } 
                                    } 
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <?php 
                $payment_list = array('Cash', 'Creditcard', 'Company', 'Void', 'Room', 'Compliment', 'Staff');
                $pay_access = array();

                if(!empty($selected_outlet)) {
                    $sql_acc = mysql_query("select payment_type, access from pos_paymode where outlet_code='$selected_outlet'");
                    if($sql_acc && is_resource($sql_acc)) {
                        while($row_acc = mysql_fetch_array($sql_acc)) {
                            $pay_access[$row_acc['payment_type']] = strtolower($row_acc['access']);
                        }
                    }
                }
                ?>

                <table class="mypay-subtable" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Sr. No.</th>
                            <th style="width: 50%;">Payment Type</th>
                            <th style="width: 35%;">Access</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sr = 0;
                        foreach($payment_list as $ptype){
                            $sr++;
                            $current_acc = isset($pay_access[$ptype]) ? $pay_access[$ptype] : 'yes';
                        ?>
                        <tr>
                            <td>
                                <?php echo $sr; ?>
                                <input type="hidden" name="srno[]" value="<?php echo $sr; ?>" />
                            </td>
                            <td style="font-weight: bold; color: #333;">
                                <?php echo $ptype; ?>
                                <input type="hidden" name="payment_type[]" value="<?php echo $ptype; ?>" />
                            </td>
                            <td>
                                <select name="access[]" style="width: 100px;">
                                    <option value="yes" <?php echo ($current_acc == 'yes') ? 'selected' : ''; ?>>Yes</option>
                                    <option value="no" <?php echo ($current_acc == 'no') ? 'selected' : ''; ?>>No</option>
                                </select>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Card Bottom Action Bar -->
            <div class="mypay-card-footer">
                <button type="submit" id="add" class="btn-mypay-action" title="Submit (Ctrl+S)">
                    <i class="fa fa-floppy-o"></i> Submit
                </button>
                <a href="view_paymode_restriction.php" class="btn-mypay-action" title="View (Ctrl+V)">
                    <i class="fa fa-eye"></i> View
                </a>
                <button type="button" id="clearBtn" class="btn-mypay-action" onclick="clearForm();" title="Clear (Ctrl+C)">
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
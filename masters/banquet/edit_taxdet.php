<?php
ob_start();
include("../../config.php");
include("../../header.php");

$taxdtId = isset($_GET['taxdtId']) ? mysql_real_escape_string($_GET['taxdtId']) : '1';
$sqlTx = mysql_query("select * from bq_taxdetail where taxdet_id='$taxdtId'");
$rowTx = ($sqlTx && is_resource($sqlTx)) ? mysql_fetch_array($sqlTx) : null;
$hall_tax = isset($rowTx['hall_tax']) ? $rowTx['hall_tax'] : '';
$food_tax = isset($rowTx['food_tax']) ? $rowTx['food_tax'] : '';
$adv_tax = isset($rowTx['adv_tax']) ? $rowTx['adv_tax'] : '';
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

/* Centered Form Card Matching Standard Master Design */
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

form#taxDetailsForm {
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
    width: 22% !important;
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
    width: 78% !important;
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
        $("#taxDetailsForm").validationEngine();
    }
    $("#msgFo").fadeOut(5000);
    $("#hall_tax").focus();
    
    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+S", function() { 
            $('#taxDetailsForm').attr('action', '../../action/update_tax_details.php');  
            $('#taxDetailsForm').submit(); 
        }); 

        shortcut.add("Ctrl+V", function() { 
            window.location.href = "view_tax_det.php";
        });

        shortcut.add("Ctrl+E", function() { 
            window.location.href = "<?php echo $home_path; ?>/dashboard.php";
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

    <!-- Update Form Card Matching Standard Master Design -->
    <div class="mypay-card">
        <div class="mypay-card-header">
            UPDATE TAX DETAILS
        </div>

        <form id="taxDetailsForm" name="taxDetailsForm" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/update_tax_details.php" method="post">
            <input type="hidden" name="taxdet_id" id="taxdet_id" value="<?php echo htmlspecialchars($taxdtId); ?>"/>
            
            <div class="mypay-card-body">
                <table class="mypay-form-table" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="hall_tax">Hall Tax<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <?php $sqlPm = mysql_query("select distinct str_code, description from bq_taxstruct"); ?>
                                <select name="hall_tax" id="hall_tax" data-validation-engine="validate[required]" class="mypay-input validate[required]" required>
                                    <option value="">--Select Hall Tax--</option>
                                    <?php 
                                    if($sqlPm && mysql_num_rows($sqlPm) > 0) {
                                        while($rowPm = mysql_fetch_array($sqlPm)) { 
                                    ?>
                                        <option value="<?php echo htmlspecialchars($rowPm['str_code']); ?>" <?php echo ($hall_tax == $rowPm['str_code']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($rowPm['description']); ?>
                                        </option>
                                    <?php 
                                        } 
                                    } 
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="food_tax">Food Tax<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <?php $sqlPm2 = mysql_query("select distinct str_code, description from bq_taxstruct"); ?>
                                <select name="food_tax" id="food_tax" data-validation-engine="validate[required]" class="mypay-input validate[required]" required>
                                    <option value="">--Select Food Tax--</option>
                                    <?php 
                                    if($sqlPm2 && mysql_num_rows($sqlPm2) > 0) {
                                        while($rowPm2 = mysql_fetch_array($sqlPm2)) { 
                                    ?>
                                        <option value="<?php echo htmlspecialchars($rowPm2['str_code']); ?>" <?php echo ($food_tax == $rowPm2['str_code']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($rowPm2['description']); ?>
                                        </option>
                                    <?php 
                                        } 
                                    } 
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="adv_tax">Advance Tax<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <?php $sqlPm3 = mysql_query("select distinct str_code, description from bq_taxstruct"); ?>
                                <select name="adv_tax" id="adv_tax" data-validation-engine="validate[required]" class="mypay-input validate[required]" required>
                                    <option value="">--Select Advance Tax--</option>
                                    <?php 
                                    if($sqlPm3 && mysql_num_rows($sqlPm3) > 0) {
                                        while($rowPm3 = mysql_fetch_array($sqlPm3)) { 
                                    ?>
                                        <option value="<?php echo htmlspecialchars($rowPm3['str_code']); ?>" <?php echo ($adv_tax == $rowPm3['str_code']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($rowPm3['description']); ?>
                                        </option>
                                    <?php 
                                        } 
                                    } 
                                    ?>
                                </select>
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
                <a href="view_tax_det.php" class="btn-mypay-action" title="View (Ctrl+V)">
                    <i class="fa fa-eye"></i> View
                </a>
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
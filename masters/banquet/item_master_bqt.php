<?php
ob_start();
include("../../config.php");
include("../../header.php");
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
    width: 860px !important;
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

form#itemMasterForm {
    margin: 0 !important;
    padding: 0 !important;
    display: block !important;
}

.mypay-card-body {
    padding: 20px 30px !important;
    background: #ffffff !important;
    margin: 0 !important;
}

.mypay-two-col-layout {
    display: flex !important;
    gap: 30px !important;
    margin-bottom: 20px !important;
}

.mypay-col {
    flex: 1 !important;
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

.mypay-label-cell {
    width: 38% !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #222222 !important;
    font-weight: normal !important;
    padding-right: 10px !important;
    text-align: left !important;
    line-height: 1.2 !important;
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
    width: 62% !important;
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

.mypay-radio-group {
    display: flex !important;
    align-items: center !important;
    gap: 20px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #222222 !important;
    margin: 0 !important;
    padding: 0 !important;
}

.mypay-radio-label {
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    cursor: pointer !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #222222 !important;
    margin: 0 !important;
    padding: 0 !important;
    font-weight: normal !important;
}

.mypay-radio-label input[type="radio"] {
    margin: 0 !important;
    cursor: pointer !important;
    width: 14px !important;
    height: 14px !important;
    vertical-align: middle !important;
}

/* Sub Table Inside Card */
.mypay-sub-table {
    width: 100% !important;
    border-collapse: collapse !important;
    border: 1px solid #0073B5 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    margin-top: 10px !important;
}

.mypay-sub-table thead th {
    background-color: #f5f5f5 !important;
    color: #222222 !important;
    font-weight: bold !important;
    font-size: 12px !important;
    text-align: center !important;
    height: 32px !important;
    padding: 6px 10px !important;
    border: 1px solid #e0e0e0 !important;
}

.mypay-sub-table tbody td {
    padding: 6px 10px !important;
    border: 1px solid #e0e0e0 !important;
    background-color: #ffffff !important;
    text-align: center !important;
    vertical-align: middle !important;
}

.mypay-sub-table tbody tr:hover td {
    background-color: #f8fbfe !important;
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
        $("#itemMasterForm").validationEngine();
    }
    $("#msgFo").fadeOut(5000);
    $("#item_code").focus();
    
    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+S", function() { 
            $('#itemMasterForm').attr('action', '<?php echo $home_path;?>/action/add_item_master.php');  
            $('#itemMasterForm').submit(); 
        }); 

        shortcut.add("Ctrl+V", function() { 
            window.location.href = "view_itemmaster_bqt.php";
        });

        shortcut.add("Ctrl+C", function() { 
            clearForm();
        });

        shortcut.add("Ctrl+E", function() { 
            window.location.href = "view_itemmaster_bqt.php";
        });
    }
});

function clearForm() {
    $('#itemMasterForm').find("input[type=text]").val("");
    $('#itemMasterForm').find("select").val("");
    $('#status_active').prop('checked', true);
    $('#item_code').focus();
}

function checkItemCode(){
    var itmCde = $('#item_code').val().trim();
    if(itmCde == '') return;
    $.ajax({
        type: 'GET',
        url: '../../action/repeatItmMastItemCode.php',
        data: { itmCde: itmCde },
        success: function(data){
            if(data == 1){
                alert("Item code already exists!");
                $('#item_code').val('').focus();
            }
        }
    });
}

function checkItemName(){
    var itmName = $('#item_name').val().trim();
    if(itmName == '') return;
    $.ajax({
        type: 'GET',
        url: '../../action/repeatItmMastItemName.php',
        data: { itmName: itmName },
        success: function(data){
            if(data == 1){
                alert("Item name already exists!");
                $('#item_name').val('').focus();
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

    <!-- Add Form Card Matching Standard Master Design -->
    <div class="mypay-card">
        <div class="mypay-card-header">
            ADD ITEM MASTER
        </div>

        <form id="itemMasterForm" name="itemMasterForm" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_item_master.php" method="post">
            <input type="hidden" name="tariff_rt" id="tariff_rt" />
            <input type="hidden" name="taxCodee" id="taxCodee" />
            
            <div class="mypay-card-body">
                <div class="mypay-two-col-layout">
                    <!-- Left Column -->
                    <div class="mypay-col">
                        <table class="mypay-form-table" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="item_code">Item Code<span class="req-star">*</span> :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <input type="text" name="item_code" id="item_code" data-validation-engine="validate[required]" class="mypay-input validate[required]" style="text-transform:uppercase;" onblur="checkItemCode();" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="item_name">Item Name<span class="req-star">*</span> :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <input type="text" name="item_name" id="item_name" data-validation-engine="validate[required]" class="mypay-input validate[required]" onblur="checkItemName();" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="menu_type">Menu Group<span class="req-star">*</span> :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <select name="menu_type" id="menu_type" data-validation-engine="validate[required]" class="mypay-input validate[required]" required>
                                            <option value="">--Select Menu Group--</option>
                                            <?php
                                            $sqle = mysql_query("select * from bq_grpcode order by grpname asc");
                                            if($sqle && mysql_num_rows($sqle) > 0){
                                                while($res = mysql_fetch_array($sqle)){ 
                                            ?>
                                                <option value="<?php echo htmlspecialchars($res['grpcode']); ?>">
                                                    <?php echo htmlspecialchars($res['grpname']); ?>
                                                </option>
                                            <?php } } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="itmsub_cat">Item Sub Category<span class="req-star">*</span> :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <select name="itmsub_cat" id="itmsub_cat" data-validation-engine="validate[required]" class="mypay-input validate[required]" required>
                                            <option value="">--Select Sub Category--</option>
                                            <?php
                                            $sqle = mysql_query("select distinct subcat_code, subcat_name from bq_subcatitem order by subcat_name asc");
                                            if($sqle && mysql_num_rows($sqle) > 0){
                                                while($res = mysql_fetch_array($sqle)){ 
                                            ?>
                                                <option value="<?php echo htmlspecialchars($res['subcat_code']); ?>">
                                                    <?php echo htmlspecialchars(!empty($res['subcat_name']) ? $res['subcat_name'] : $res['subcat_code']); ?>
                                                </option>
                                            <?php } } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="itmsubmnu_code">Sub Menu Code<span class="req-star">*</span> :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <select name="itmsubmnu_code" id="itmsubmnu_code" data-validation-engine="validate[required]" class="mypay-input validate[required]" required>
                                            <option value="">--Select Sub Menu--</option>
                                            <?php
                                            $sqle = mysql_query("select distinct submenu_code, submenu_name from bq_submenugrp order by submenu_name asc");
                                            if($sqle && mysql_num_rows($sqle) > 0){
                                                while($res = mysql_fetch_array($sqle)){
                                            ?>
                                                <option value="<?php echo htmlspecialchars($res['submenu_code']); ?>">
                                                    <?php echo htmlspecialchars($res['submenu_name']); ?>
                                                </option>
                                            <?php } } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="item_rate">Rate<span class="req-star">*</span> :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <input type="text" name="item_rate" id="item_rate" data-validation-engine="validate[required]" class="mypay-input validate[required]" required />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Right Column -->
                    <div class="mypay-col">
                        <table class="mypay-form-table" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="tax_struc">Tax Structure<span class="req-star">*</span> :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <select name="tax_struc" id="tax_struc" data-validation-engine="validate[required]" class="mypay-input validate[required]" required>
                                            <option value="">--Select Tax Structure--</option>
                                            <?php
                                            $sqle = mysql_query("select distinct str_code, description from bq_taxstruct order by str_code asc");
                                            if($sqle && mysql_num_rows($sqle) > 0){
                                                while($res = mysql_fetch_array($sqle)){
                                            ?>
                                                <option value="<?php echo htmlspecialchars($res['str_code']); ?>">
                                                    <?php echo htmlspecialchars($res['str_code'] . (!empty($res['description']) ? ' - ' . $res['description'] : '')); ?>
                                                </option>
                                            <?php } } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="allow_disc">Allow Discount :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <select name="allow_disc" id="allow_disc" class="mypay-input">
                                            <option value="">--Select--</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="allwrate_chg">Allow Rate Change :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <select name="allwrate_chg" id="allwrate_chg" class="mypay-input">
                                            <option value="">--Select--</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label for="allow_qty">Allow Quantity :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <select name="allow_qty" id="allow_qty" class="mypay-input">
                                            <option value="">--Select--</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell">
                                        <label>Status :</label>
                                    </td>
                                    <td class="mypay-input-cell">
                                        <div class="mypay-radio-group">
                                            <label class="mypay-radio-label" for="status_active">
                                                <input type="radio" name="status" id="status_active" value="1" checked /> Active
                                            </label>
                                            <label class="mypay-radio-label" for="status_passive">
                                                <input type="radio" name="status" id="status_passive" value="0" /> Passive
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Bottom Menu Association Table -->
                <table class="mypay-sub-table" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 30%;">Menu Code</th>
                            <th style="width: 45%;">Menu Name</th>
                            <th style="width: 25%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $sqlM = mysql_query('select distinct menu_code, menu_name from bq_menumaster order by menu_code asc');
                    if($sqlM && mysql_num_rows($sqlM) > 0){
                        while($rwM = mysql_fetch_array($sqlM)){
                    ?>
                        <tr>
                            <td>
                                <input type="text" name="itmnu_code[]" class="mypay-input" value="<?php echo htmlspecialchars($rwM['menu_code']); ?>" readonly />
                            </td>
                            <td>
                                <input type="text" name="itmnu_name[]" class="mypay-input" value="<?php echo htmlspecialchars($rwM['menu_name']); ?>" readonly />
                            </td>
                            <td>
                                <select name="mnu_sts[]" class="mypay-input">
                                    <option value="">--Select--</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </td>
                        </tr>
                    <?php 
                        } 
                    } 
                    ?>
                    </tbody>
                </table>
            </div>

            <!-- Card Bottom Action Bar -->
            <div class="mypay-card-footer">
                <button type="submit" id="add" class="btn-mypay-action" title="Submit (Ctrl+S)">
                    <i class="fa fa-floppy-o"></i> Submit
                </button>
                <a href="view_itemmaster_bqt.php" class="btn-mypay-action" title="View (Ctrl+V)">
                    <i class="fa fa-eye"></i> View
                </a>
                <button type="button" id="clearBtn" class="btn-mypay-action" onclick="clearForm();" title="Clear (Ctrl+C)">
                    <i class="fa fa-paint-brush" style="color:#f39c12;"></i> Clear
                </button>
                <a href="<?php echo $home_path; ?>/masters/banquet/view_itemmaster_bqt.php" class="btn-mypay-action" title="Exit (Ctrl+E)">
                    <i class="fa fa-times" style="color:#e74c3c;"></i> Exit
                </a>
            </div>
        </form>
    </div>

</div>

<?php include("../../footer.php"); ?>
</body>
</html>
<?php
ob_start();
include("../../config.php");
include("../../header.php");

$mencde = isset($_GET['mencde']) ? mysql_real_escape_string($_GET['mencde']) : '';
$sqlC = mysql_query("select * from bq_menumaster where menu_code='$mencde'");
$row = ($sqlC && mysql_num_rows($sqlC) > 0) ? mysql_fetch_array($sqlC) : array();
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

form#editMenuMasterForm {
    margin: 0 !important;
    padding: 0 !important;
    display: block !important;
}

.mypay-card-body {
    padding: 20px 30px !important;
    background: #ffffff !important;
    margin: 0 !important;
}

.mypay-form-table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 12px !important;
    border: none !important;
    margin: 0 0 15px 0 !important;
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
    width: 25% !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #222222 !important;
    font-weight: normal !important;
    padding-right: 15px !important;
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
    width: 75% !important;
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
        $("#editMenuMasterForm").validationEngine();
    }
    $("#msgFo").fadeOut(5000);
    $("#menu_name").focus();
    
    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+S", function() { 
            $('#editMenuMasterForm').attr('action', '<?php echo $home_path;?>/action/update_menu_master.php');  
            $('#editMenuMasterForm').submit(); 
        }); 

        shortcut.add("Ctrl+V", function() { 
            window.location.href = "view-menu-master.php";
        });

        shortcut.add("Ctrl+E", function() { 
            window.location.href = "view-menu-master.php";
        });
    }
});

function selMenuGrp(cnt){
    var menGrp = $('#menu_group' + cnt).val();
    $.ajax({
        type: 'GET',
        url: '../../action/selectMEnuMastSUbmenu.php',
        data: { menGrp: menGrp },
        success: function(data){
            $('#submenu' + cnt).html(data);
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

    <!-- Edit Form Card Matching Standard Master Design -->
    <div class="mypay-card">
        <div class="mypay-card-header">
            UPDATE MENU MASTER
        </div>

        <form id="editMenuMasterForm" name="editMenuMasterForm" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/update_menu_master.php" method="post">
            <input type="hidden" name="tariff_rt" id="tariff_rt" />
            <input type="hidden" name="taxCodee" id="taxCodee" />
            
            <div class="mypay-card-body">
                <table class="mypay-form-table" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="menu_code">Menu Code :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="menu_code" id="menu_code" class="mypay-input" style="text-transform:uppercase;" value="<?php echo isset($row['menu_code']) ? htmlspecialchars($row['menu_code']) : ''; ?>" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="menu_name">Menu Name<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="menu_name" id="menu_name" data-validation-engine="validate[required]" class="mypay-input validate[required]" value="<?php echo isset($row['menu_name']) ? htmlspecialchars($row['menu_name']) : ''; ?>" required />
                            </td>
                        </tr>
                        <tr>
                            <td class="mypay-label-cell">
                                <label>Status :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <div class="mypay-radio-group">
                                    <label class="mypay-radio-label" for="status_active">
                                        <input type="radio" name="status" id="status_active" value="1" <?php echo (!isset($row['status']) || $row['status'] == '1') ? 'checked' : ''; ?> /> Active
                                    </label>
                                    <label class="mypay-radio-label" for="status_passive">
                                        <input type="radio" name="status" id="status_passive" value="0" <?php echo (isset($row['status']) && $row['status'] == '0') ? 'checked' : ''; ?> /> Passive
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Sub Items Table -->
                <table class="mypay-sub-table" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 38%;">Menu Group</th>
                            <th style="width: 38%;">Sub Menu Group</th>
                            <th style="width: 24%;">Allow Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="addedRowsED">
                    <?php
                    $menugrp_options = array();
                    $sqle = mysql_query("select distinct menu_code, menu_name from bq_menugrp order by menu_name asc");
                    if($sqle && mysql_num_rows($sqle) > 0) {
                        while($res = mysql_fetch_array($sqle)){
                            $menugrp_options[] = $res;
                        }
                    }

                    $sqC = mysql_query("select * from bq_menumaster where menu_code='$mencde'");
                    $c = 0;
                    $nmRs = ($sqC && mysql_num_rows($sqC) > 0) ? mysql_num_rows($sqC) : 0;
                    if($nmRs > 0) {
                        while($row_item = mysql_fetch_array($sqC)){
                            $c++;
                    ?>
                        <tr>
                            <input name="menmas_id[]" id="menmas_id<?php echo $c;?>" type="hidden" value="<?php echo $row_item['menmas_id'];?>" />
                            <td>
                                <select name="menu_group[]" id="menu_group<?php echo $c;?>" onChange="selMenuGrp(<?php echo $c;?>);" class="mypay-input">
                                    <option value="">--Select Menu Group--</option>
                                    <?php foreach($menugrp_options as $resulte){ ?>
                                        <option value="<?php echo htmlspecialchars($resulte['menu_code']); ?>" <?php echo ($resulte['menu_code'] == $row_item['menu_group'] || $resulte['menu_name'] == $row_item['menu_group']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($resulte['menu_name']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <select name="submenu[]" id="submenu<?php echo $c;?>" class="mypay-input">
                                    <option value="">--Select Sub Menu--</option>
                                    <?php
                                    $curGrp = $row_item['menu_group'];
                                    $sqlSub = mysql_query("select distinct submenu_code, submenu_name from bq_submenugrp where subgrp_code='$curGrp' or subgrp_code=(select menu_name from bq_menugrp where menu_code='$curGrp') or subgrp_code=(select menu_code from bq_menugrp where menu_name='$curGrp')");
                                    if($sqlSub && mysql_num_rows($sqlSub) > 0){
                                        while($resSub = mysql_fetch_array($sqlSub)){
                                    ?>
                                        <option value="<?php echo htmlspecialchars($resSub['submenu_code']); ?>" <?php echo ($resSub['submenu_code'] == $row_item['submenu'] || $resSub['submenu_name'] == $row_item['submenu']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($resSub['submenu_name']); ?>
                                        </option>
                                    <?php 
                                        }
                                    } else if(!empty($row_item['submenu'])) { ?>
                                        <option value="<?php echo htmlspecialchars($row_item['submenu']); ?>" selected>
                                            <?php echo htmlspecialchars($row_item['submenu']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="allow_qty[]" id="allow_qty<?php echo $c;?>" class="mypay-input" value="<?php echo htmlspecialchars($row_item['allow_qty']); ?>" />
                            </td>
                        </tr>
                    <?php 
                        } 
                    } 
                    
                    // Extra rows up to max 10
                    $totalRows = max($nmRs + 1, 1);
                    for($c = $nmRs + 1; $c <= 10; $c++){ 
                    ?>
                        <tr>
                            <input name="menmas_id[]" id="menmas_id<?php echo $c;?>" type="hidden" value="" />
                            <td>
                                <select name="menu_group[]" id="menu_group<?php echo $c;?>" onChange="selMenuGrp(<?php echo $c;?>);" class="mypay-input">
                                    <option value="">--Select Menu Group--</option>
                                    <?php foreach($menugrp_options as $resulte){ ?>
                                        <option value="<?php echo htmlspecialchars($resulte['menu_code']); ?>">
                                            <?php echo htmlspecialchars($resulte['menu_name']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <select name="submenu[]" id="submenu<?php echo $c;?>" class="mypay-input">
                                    <option value="">--Select Sub Menu--</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="allow_qty[]" id="allow_qty<?php echo $c;?>" class="mypay-input" />
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Card Bottom Action Bar -->
            <div class="mypay-card-footer">
                <button type="submit" id="update" class="btn-mypay-action" title="Update (Ctrl+S)">
                    <i class="fa fa-floppy-o"></i> Update
                </button>
                <a href="view-menu-master.php" class="btn-mypay-action" title="View (Ctrl+V)">
                    <i class="fa fa-eye"></i> View
                </a>
                <a href="<?php echo $home_path; ?>/masters/banquet/view-menu-master.php" class="btn-mypay-action" title="Exit (Ctrl+E)">
                    <i class="fa fa-times" style="color:#e74c3c;"></i> Exit
                </a>
            </div>
        </form>
    </div>

</div>

<?php include("../../footer.php"); ?>
</body>
</html>
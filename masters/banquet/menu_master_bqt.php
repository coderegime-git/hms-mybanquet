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

form#menuMasterForm {
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
        $("#menuMasterForm").validationEngine();
    }
    $("#msgFo").fadeOut(5000);
    $("#menu_code").focus();
    
    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+S", function() { 
            $('#menuMasterForm').attr('action', '<?php echo $home_path;?>/action/add_menu_master.php');  
            $('#menuMasterForm').submit(); 
        }); 

        shortcut.add("Ctrl+V", function() { 
            window.location.href = "view-menu-master.php";
        });

        shortcut.add("Ctrl+C", function() { 
            clearForm();
        });

        shortcut.add("Ctrl+E", function() { 
            window.location.href = "view-menu-master.php";
        });
    }
});

function clearForm() {
    $('#menuMasterForm').find("input[type=text]").val("");
    $('#menuMasterForm').find("select").val("");
    $('#status_active').prop('checked', true);
    $('#menu_code').focus();
}

function checkMenuCode() {
    var menu_code = $('#menu_code').val().trim();
    if(menu_code == '') return;
    $.ajax({
        type: 'GET',
        url: '../../action/repeatBqtMenuMastCode.php',
        data: { menu_code: menu_code },
        success: function(data){
            if(data == 1){
                alert('Menu code already exists!');
                $('#menu_code').val('').focus();
            }
        }
    });
}

function checkMenuName(){
    var menu_name = $('#menu_name').val().trim();
    if(menu_name == '') return;
    $.ajax({
        type: 'GET',
        url: '../../action/repeatBqtMenuMastName.php',
        data: { menu_name: menu_name },
        success: function(data){
            if(data == 1){
                alert('Menu name already exists!');
                $('#menu_name').val('').focus();
            }
        }
    });
}

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

    <!-- Add Form Card Matching Standard Master Design -->
    <div class="mypay-card">
        <div class="mypay-card-header">
            ADD MENU MASTER
        </div>

        <form id="menuMasterForm" name="menuMasterForm" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_menu_master.php" method="post">
            <input type="hidden" name="tariff_rt" id="tariff_rt" />
            <input type="hidden" name="taxCodee" id="taxCodee" />
            
            <div class="mypay-card-body">
                <table class="mypay-form-table" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="menu_code">Menu Code<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="menu_code" id="menu_code" data-validation-engine="validate[required]" class="mypay-input validate[required]" style="text-transform:uppercase;" onblur="checkMenuCode();" required />
                            </td>
                        </tr>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="menu_name">Menu Name<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="menu_name" id="menu_name" data-validation-engine="validate[required]" class="mypay-input validate[required]" onblur="checkMenuName();" required />
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
                    for($c = 1; $c <= 10; $c++){ 
                    ?>
                        <tr>
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
                <button type="submit" id="add" class="btn-mypay-action" title="Submit (Ctrl+S)">
                    <i class="fa fa-floppy-o"></i> Submit
                </button>
                <a href="view-menu-master.php" class="btn-mypay-action" title="View (Ctrl+V)">
                    <i class="fa fa-eye"></i> View
                </a>
                <button type="button" id="clearBtn" class="btn-mypay-action" onclick="clearForm();" title="Clear (Ctrl+C)">
                    <i class="fa fa-paint-brush" style="color:#f39c12;"></i> Clear
                </button>
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
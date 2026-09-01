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

<!-- Datepicker -->
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">

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
    width: 920px !important;
    max-width: 98% !important;
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

form#taxStructForm {
    margin: 0 !important;
    padding: 0 !important;
    display: block !important;
}

.mypay-card-body {
    padding: 20px 30px 20px 30px !important;
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

.mypay-form-table td.mypay-label-cell {
    width: 18% !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #222222 !important;
    font-weight: normal !important;
    padding-right: 10px !important;
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
    width: 32% !important;
    padding-right: 20px !important;
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

/* Grid Subtable for multi-row tax configuration */
.mypay-subtable {
    width: 100% !important;
    border-collapse: collapse !important;
    border: 1px solid #d0d7de !important;
    margin-top: 10px !important;
    background: #ffffff !important;
}

.mypay-subtable th {
    background-color: #f5f5f5 !important;
    color: #222222 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-weight: bold !important;
    font-size: 12px !important;
    text-align: center !important;
    height: 32px !important;
    padding: 4px 8px !important;
    border: 1px solid #d0d7de !important;
    vertical-align: middle !important;
}

.mypay-subtable td {
    padding: 4px 6px !important;
    border: 1px solid #e0e0e0 !important;
    vertical-align: middle !important;
    text-align: center !important;
}

.mypay-subtable td .mypay-input {
    height: 28px !important;
    line-height: 28px !important;
    font-size: 12px !important;
    padding: 0 6px !important;
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
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy"
    });

    if(typeof jQuery.fn.validationEngine !== 'undefined') {
        $("#taxStructForm").validationEngine();
    }
    $("#msgFo").fadeOut(5000);
    $("#applicable_date").focus();
    
    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+S", function() { 
            $('#taxStructForm').attr('action', '../../action/add_tax_struct.php');  
            $('#taxStructForm').submit(); 
        }); 

        shortcut.add("Ctrl+V", function() { 
            window.location.href = "view-fotax-structure.php";
        });

        shortcut.add("Ctrl+C", function() { 
            clearForm();
        });

        shortcut.add("Ctrl+E", function() { 
            window.location.href = "<?php echo $home_path; ?>/dashboard.php";
        });
    }
});

function clearForm() {
    $('#applicable_date').val('');
    $('#str_code').val('');
    $('#description').val('');
    $('#status_active').prop('checked', true);
    $('select[name="tax_code[]"]').val('');
    $('input[name="tax_desc[]"]').val('');
    $('select[name="factor[]"]').val('');
    $('input[name="factor_value[]"]').val('');
    $('select[name="source1[]"]').val('onvalue');
    $('#applicable_date').focus();
}

function checkTaxStrucCode() {
    var str_code = $('#str_code').val().trim();
    if(str_code == '') return;
    $.ajax({
        type: 'GET',
        url: '../../action/repeatBqtTaxStrucCode.php',
        data: { str_code: str_code },
        success: function(data){
            if(data == 1){
                alert('Structure Code already exists!');
                $('#str_code').val('').focus();
            }
        }
    });
}

function selTaxCode(cnt){
    var taxCode = $('#tax_code' + cnt).val();
    if(taxCode == '') {
        $('#tax_desc' + cnt).val('');
        return;
    }
    $.ajax({
        type: 'GET',
        url: '../../action/selectFoStructureCode.php',
        data: { taxCode: taxCode },
        success: function(data){
            $('#tax_desc' + cnt).val(data);
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
            ADD TAX STRUCTURE
        </div>

        <form id="taxStructForm" name="taxStructForm" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_tax_struct.php" method="post">
            <div class="mypay-card-body">
                
                <!-- Master Header Parameters -->
                <table class="mypay-form-table" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="applicable_date">Applicable Date<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="applicable_date" id="applicable_date" data-validation-engine="validate[required]" class="mypay-input datepicker validate[required]" required />
                            </td>
                            <td class="mypay-label-cell">
                                <label for="str_code">Structure Code<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="str_code" id="str_code" data-validation-engine="validate[required]" class="mypay-input validate[required]" style="text-transform:uppercase;" onblur="checkTaxStrucCode();" required />
                            </td>
                        </tr>
                        <tr>
                            <td class="mypay-label-cell">
                                <label for="description">Description<span class="req-star">*</span> :</label>
                            </td>
                            <td class="mypay-input-cell">
                                <input type="text" name="description" id="description" data-validation-engine="validate[required]" class="mypay-input validate[required]" required />
                            </td>
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

                <!-- Tax Definition Rows Subtable -->
                <table class="mypay-subtable" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 5%;">Sl.No</th>
                            <th style="width: 20%;">Tax Code</th>
                            <th style="width: 25%;">Description</th>
                            <th style="width: 18%;">Factor</th>
                            <th style="width: 14%;">Factor Value</th>
                            <th style="width: 18%;">Source</th>
                        </tr>
                    </thead>
                    <tbody id="addedRowsED">
                    <?php 
                    $taxCodesResult = mysql_query("select distinct tax_code from bq_taxmast order by tax_code asc");
                    $taxCodes = array();
                    if($taxCodesResult && mysql_num_rows($taxCodesResult) > 0) {
                        while($tc = mysql_fetch_array($taxCodesResult)) {
                            $taxCodes[] = $tc['tax_code'];
                        }
                    }

                    for($c = 1; $c <= 10; $c++) { 
                    ?>  
                        <tr>
                            <td style="text-align: center; font-weight: bold; color: #555;"><?php echo $c; ?></td>
                            <td>
                                <select name="tax_code[]" id="tax_code<?php echo $c;?>" class="mypay-input" onchange="selTaxCode(<?php echo $c;?>);">
                                    <option value="">--Select Tax Code--</option>
                                    <?php foreach($taxCodes as $code) { ?>
                                        <option value="<?php echo htmlspecialchars($code); ?>"><?php echo htmlspecialchars($code); ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="tax_desc[]" id="tax_desc<?php echo $c;?>" class="mypay-input" readonly placeholder="Auto-filled" />
                            </td>
                            <td>
                                <select name="factor[]" id="factor<?php echo $c;?>" class="mypay-input">
                                    <option value="">--Select Factor--</option>
                                    <option value="percentage">Percentage</option>
                                    <option value="amount">Amount</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="factor_value[]" id="factor_value<?php echo $c;?>" class="mypay-input" placeholder="0.00" />
                            </td>
                            <td>
                                <select name="source1[]" id="source1<?php echo $c;?>" class="mypay-input">
                                    <option value="onvalue" selected>On Value</option>
                                    <option value="discountedvalue">Discounted Value</option>
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
                <a href="view-fotax-structure.php" class="btn-mypay-action" title="View (Ctrl+V)">
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
<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>

<style type="text/css">
/* Payroll (MyPay) Standardized Master View Styling */
body, body.bgBODY {
    background-color: #ffffff !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    margin: 0 !important;
    padding: 0 !important;
}

.mypay-container {
    width: 96% !important;
    max-width: 100% !important;
    margin: 20px auto 40px auto !important;
    padding: 0 !important;
}

/* Action Buttons Bar on Top Right */
.mypay-actions-bar {
    display: flex !important;
    justify-content: flex-end !important;
    align-items: center !important;
    gap: 8px !important;
    margin-bottom: 8px !important;
}

.btn-mypay-add {
    background-color: #0084b4 !important;
    color: #ffffff !important;
    border: 1px solid #00739c !important;
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

.btn-mypay-add:hover {
    background-color: #00739c !important;
    color: #ffffff !important;
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

.mypay-icon-plus {
    background-color: #28a745 !important;
    color: #ffffff !important;
    border-radius: 50% !important;
    width: 14px !important;
    height: 14px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 10px !important;
    font-weight: bold !important;
    line-height: 14px !important;
}

.mypay-icon-exit {
    color: #f39c12 !important;
    font-size: 13px !important;
}

/* View Data Table */
.mypay-table {
    width: 100% !important;
    border-collapse: collapse !important;
    border: 1px solid #0073B5 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
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
}

.mypay-table thead tr.header-row th {
    background-color: #f5f5f5 !important;
    color: #222222 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-weight: bold !important;
    font-size: 13px !important;
    text-align: center !important;
    height: 34px !important;
    padding: 8px 12px !important;
    border: 1px solid #e0e0e0 !important;
    vertical-align: middle !important;
}

.mypay-table tbody td {
    padding: 8px 12px !important;
    border: 1px solid #e0e0e0 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    color: #333333 !important;
    text-align: center !important;
    background-color: #ffffff !important;
    height: 34px !important;
    vertical-align: middle !important;
}

.mypay-table tbody tr:hover td {
    background-color: #f8fbfe !important;
}

/* Status Badge Styling */
.badge-status {
    display: inline-block !important;
    padding: 3px 10px !important;
    font-size: 11px !important;
    font-weight: bold !important;
    line-height: 1.2 !important;
    border-radius: 12px !important;
    text-align: center !important;
    letter-spacing: 0.3px !important;
}

.badge-active {
    background-color: #e6f9ed !important;
    color: #1a7f37 !important;
    border: 1px solid #abefc6 !important;
}

.badge-passive, .badge-deactive {
    background-color: #fbeae9 !important;
    color: #cf222e !important;
    border: 1px solid #f7c3c0 !important;
}
</style>

<script>
jQuery(document).ready(function(){
    $("#msgFo").fadeOut(5000);
    
    if(typeof shortcut !== 'undefined') {
        shortcut.add("Ctrl+A", function() { 
            window.location.href = "tax_structure_bqt.php";
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

    <!-- Top Action Buttons -->
    <div class="mypay-actions-bar">
        <a href="tax_structure_bqt.php" class="btn-mypay-add" id="add" title="Add Tax Structure (Ctrl+A)">
            <span class="mypay-icon-plus"><i class="fa fa-plus"></i></span>
            <span>Add Tax Structure</span>
        </a>
        <a href="<?php echo $home_path; ?>/dashboard.php" class="btn-mypay-exit" id="exit" title="Exit (Ctrl+E)">
            <span class="mypay-icon-exit"><i class="fa fa-sign-out"></i></span>
            <span>Exit</span>
        </a>
    </div>

    <!-- Data Table Matching Payroll Format -->
    <table class="mypay-table" cellpadding="0" cellspacing="0">
        <thead>
            <tr class="banner-row">
                <th colspan="9">VIEW TAX STRUCTURE</th>
            </tr>
            <tr class="header-row">
                <th style="width: 6%;">Sl.No</th>
                <th style="width: 12%;">Applicable Date</th>
                <th style="width: 14%;">Structure Code</th>
                <th style="width: 18%;">Description</th>
                <th style="width: 10%;">Tax Code</th>
                <th style="width: 14%;">Tax Desc</th>
                <th style="width: 8%;">Factor</th>
                <th style="width: 8%;">Factor Value</th>
                <th style="width: 10%;">Status</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $sql = mysql_query("select * from bq_taxstruct order by bqstru_id asc");
        $x = 0;
        if($sql && is_resource($sql) && mysql_num_rows($sql) > 0) {
            while($row = mysql_fetch_array($sql)) {
                $x++;
                $isActive = ($row['status'] == 1 || $row['status'] == '1');
                $statusText = $isActive ? "Active" : "Passive";
                $badgeClass = $isActive ? "badge-active" : "badge-passive";
        ?>
            <tr>
                <td><?php echo $x; ?></td>
                <td><?php echo htmlspecialchars($row['applicable_date']); ?></td>
                <td><?php echo htmlspecialchars($row['str_code']); ?></td>
                <td style="text-align:left;"><?php echo htmlspecialchars($row['description']); ?></td>
                <td><?php echo htmlspecialchars($row['tax_code']); ?></td>
                <td style="text-align:left;"><?php echo htmlspecialchars($row['tax_desc']); ?></td>
                <td><?php echo htmlspecialchars(ucfirst($row['factor'])); ?></td>
                <td><?php echo htmlspecialchars($row['factor_value']); ?></td>
                <td>
                    <span class="badge-status <?php echo $badgeClass; ?>"><?php echo $statusText; ?></span>
                </td>
            </tr>
        <?php 
            } 
        } else { 
        ?>
            <tr>
                <td colspan="9" style="padding: 16px; color: #777; text-align: center; font-size: 13px;">
                    No Tax Structure records found
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

<?php include("../../footer.php"); ?>
</body>
</html>
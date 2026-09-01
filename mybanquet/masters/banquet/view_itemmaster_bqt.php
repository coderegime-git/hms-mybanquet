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

/* Action Buttons Bar on Top Right with Search */
.mypay-actions-bar {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    gap: 8px !important;
    margin-bottom: 10px !important;
    flex-wrap: wrap !important;
}

.mypay-search-box {
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
}

.mypay-search-input {
    width: 260px !important;
    height: 28px !important;
    padding: 0 10px !important;
    border: 1px solid #0073B5 !important;
    border-radius: 4px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    outline: none !important;
    box-sizing: border-box !important;
}

.btn-mypay-search {
    background-color: #0073B5 !important;
    color: #ffffff !important;
    border: 1px solid #005b8a !important;
    border-radius: 3px !important;
    padding: 4px 12px !important;
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

.btn-mypay-search:hover {
    background-color: #005b8a !important;
}

.mypay-btn-group {
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
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
}

.mypay-table thead tr.header-row th {
    background-color: #f5f5f5 !important;
    color: #222222 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-weight: bold !important;
    font-size: 12px !important;
    text-align: center !important;
    height: 32px !important;
    padding: 6px 8px !important;
    border: 1px solid #e0e0e0 !important;
    vertical-align: middle !important;
}

.mypay-table tbody td {
    padding: 6px 8px !important;
    border: 1px solid #e0e0e0 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    color: #333333 !important;
    text-align: center !important;
    background-color: #ffffff !important;
    height: 32px !important;
    vertical-align: middle !important;
}

.mypay-table tbody tr:hover td {
    background-color: #f8fbfe !important;
}

.mypay-edit-btn {
    color: #0084b4 !important;
    font-size: 15px !important;
    text-decoration: none !important;
    display: inline-block !important;
    line-height: 1 !important;
}

.mypay-edit-btn:hover {
    color: #005580 !important;
}

/* Status Badge Styling */
.badge-status {
    display: inline-block !important;
    padding: 2px 8px !important;
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
            window.location.href = "item_master_bqt.php";
        }); 

        shortcut.add("Ctrl+E", function() { 
            window.location.href = "<?php echo $home_path; ?>/dashboard.php";
        }); 
    }
});

function srchTxtBtn(){
    $("#searchTxt").val('');
}

function srchBtn() {
    var itm = $("#searchTxt").val().trim();
    window.location.href = "view_itemmaster_bqt.php?val=" + encodeURIComponent(itm);
}
</script>

<body class="bgBODY">

<div class="mypay-container">

    <?php if(isset($_GET['msg'])){ ?>
        <p style="text-align:center;margin:10px 0;">
            <label id="msgFo" style="color:#7B0E0E;font-weight:bold;font-size:13px;"><?php echo htmlspecialchars($_GET['msg']); ?></label>
        </p>
    <?php } ?>

    <!-- Top Action and Search Bar -->
    <div class="mypay-actions-bar">
        <div class="mypay-search-box">
            <input type="text" id="searchTxt" name="searchTxt" class="mypay-search-input" placeholder="Enter Item code / Name / Menu name" value="<?php if(isset($_GET['val'])){ echo htmlspecialchars($_GET['val']);}?>" onkeypress="if(event.keyCode==13){ srchBtn(); return false; }" />
            <button type="button" name="searchBtn" id="searchBtn" class="btn-mypay-search" onclick="srchBtn();">
                <i class="fa fa-search"></i> Search
            </button>
            <?php if(isset($_GET['val']) && !empty($_GET['val'])) { ?>
                <a href="view_itemmaster_bqt.php" class="btn-mypay-search" style="background:#6c757d;border-color:#5a6268;text-decoration:none;">Reset</a>
            <?php } ?>
        </div>

        <div class="mypay-btn-group">
            <a href="item_master_bqt.php" class="btn-mypay-add" id="add" title="Add Item Master (Ctrl+A)">
                <span class="mypay-icon-plus"><i class="fa fa-plus"></i></span>
                <span>Add Item Master</span>
            </a>
            <a href="<?php echo $home_path; ?>/dashboard.php" class="btn-mypay-exit" id="exit" title="Exit (Ctrl+E)">
                <span class="mypay-icon-exit"><i class="fa fa-sign-out"></i></span>
                <span>Exit</span>
            </a>
        </div>
    </div>

    <!-- Data Table Matching Payroll Format -->
    <table class="mypay-table" cellpadding="0" cellspacing="0">
        <thead>
            <tr class="banner-row">
                <th colspan="14">VIEW ITEM MASTER</th>
            </tr>
            <tr class="header-row">
                <th style="width: 4%;">Sl.No</th>
                <th style="width: 8%;">Code</th>
                <th style="width: 14%;">Name</th>
                <th style="width: 10%;">Sub Category</th>
                <th style="width: 10%;">Submenu Code</th>
                <th style="width: 7%;">Rate</th>
                <th style="width: 8%;">Tax Structure</th>
                <th style="width: 7%;">Allow Disc</th>
                <th style="width: 7%;">Allow Qty</th>
                <th style="width: 8%;">Allow Rate Chg</th>
                <th style="width: 9%;">Menu Name</th>
                <th style="width: 6%;">Menu Status</th>
                <th style="width: 7%;">Status</th>
                <th style="width: 5%;">Edit</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        if(isset($_GET['val']) && trim($_GET['val']) != ''){
            $val = mysql_real_escape_string(trim($_GET['val']));
            $item_where = " where item_code='$val' OR item_name like '%$val%' OR itmnu_name like '%$val%'";
            $sql = mysql_query("select * from bq_itemmaster $item_where order by item_id desc");
        } else {
            $sql = mysql_query("select * from bq_itemmaster where status='1' order by item_id desc");
        }
        
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
                <td><?php echo htmlspecialchars($row['item_code']); ?></td>
                <td style="text-align:left;"><?php echo htmlspecialchars($row['item_name']); ?></td>
                <td style="text-align:left;"><?php echo htmlspecialchars($row['itmsub_cat']); ?></td>
                <td style="text-align:left;"><?php echo htmlspecialchars($row['itmsubmnu_code']); ?></td>
                <td><?php echo htmlspecialchars($row['item_rate']); ?></td>
                <td><?php echo htmlspecialchars($row['tax_struc']); ?></td>
                <td><?php echo htmlspecialchars(ucfirst($row['allow_disc'])); ?></td>
                <td><?php echo htmlspecialchars(ucfirst($row['allow_qty'])); ?></td>
                <td><?php echo htmlspecialchars(ucfirst($row['allwrate_chg'])); ?></td>
                <td style="text-align:left;"><?php echo htmlspecialchars($row['itmnu_name']); ?></td>
                <td><?php echo htmlspecialchars(ucfirst($row['mnu_sts'])); ?></td>
                <td>
                    <span class="badge-status <?php echo $badgeClass; ?>"><?php echo $statusText; ?></span>
                </td>
                <td>
                    <a href="edit_itemmaster_bqt.php?item_id=<?php echo $row['item_id']; ?>" class="mypay-edit-btn" title="Edit">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </td>
            </tr>
        <?php 
            } 
        } else { 
        ?>
            <tr>
                <td colspan="14" style="padding: 16px; color: #777; text-align: center; font-size: 13px;">
                    No Item Master records found
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

<?php include("../../footer.php"); ?>
</body>
</html>
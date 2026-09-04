<?php
include("header-main.php");

// Fetch audit control date
$sqlAC = mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC = mysql_fetch_array($sqlAC);
$adtCurDt = $rowAC['cur_date'];
$adtT = explode('/', $adtCurDt);
$adtTT = $adtT[2].'-'.$adtT[1].'-'.$adtT[0];

// Date range calculation
if(isset($_GET['fromdate']) && isset($_GET['todate']) && !empty($_GET['fromdate']) && !empty($_GET['todate'])) { 
    $frDate = $_GET['fromdate'];
    $toDate = $_GET['todate'];
} else {
    $frDate = $adtCurDt;
    $toDate = $adtCurDt;	
}

$frxpl = explode('/', $frDate);
$frDt = @$frxpl[2].'-'.@$frxpl[1].'-'.@$frxpl[0];
$toDat = explode('/', $toDate);
$toDD = @$toDat[2].'-'.@$toDat[1].'-'.@$toDat[0];

$date_from = strtotime($frDt); 
$date_to = strtotime($toDD);  

$selVen = isset($_GET['ven']) ? $_GET['ven'] : 'all';

// Status colors from database
$sqlRv = mysql_query("select * from bq_stscolor where roomoccupy_id='1'");
$rowRv = mysql_fetch_array($sqlRv); 
$sqlRd = mysql_query("select * from bq_stscolor where roomoccupy_id='2'");
$rowRd = mysql_fetch_array($sqlRd);
$sqlRo = mysql_query("select * from bq_stscolor where roomoccupy_id='3'");
$rowRo = mysql_fetch_array($sqlRo); 
$sqlRg = mysql_query("select * from bq_stscolor where roomoccupy_id='4'");
$rowRg = mysql_fetch_array($sqlRg);
$sqlRm = mysql_query("select * from bq_stscolor where roomoccupy_id='5'");
$rowRm = mysql_fetch_array($sqlRm);
$sqlRe = mysql_query("select * from bq_stscolor where roomoccupy_id='6'");
$rowbl = mysql_fetch_array($sqlRe);

$colorAvailable = !empty($rowRv['room_color']) ? (strpos($rowRv['room_color'], '#') === 0 ? $rowRv['room_color'] : '#'.$rowRv['room_color']) : '#00C85A';
$colorConfirmed = !empty($rowRd['room_color']) ? (strpos($rowRd['room_color'], '#') === 0 ? $rowRd['room_color'] : '#'.$rowRd['room_color']) : '#FF1515';
$colorWaitlist  = !empty($rowRo['room_color']) ? (strpos($rowRo['room_color'], '#') === 0 ? $rowRo['room_color'] : '#'.$rowRo['room_color']) : '#409FFF';
$colorEnquiry   = !empty($rowRg['room_color']) ? (strpos($rowRg['room_color'], '#') === 0 ? $rowRg['room_color'] : '#'.$rowRg['room_color']) : '#F757E6';
$colorTentative = !empty($rowRm['room_color']) ? (strpos($rowRm['room_color'], '#') === 0 ? $rowRm['room_color'] : '#'.$rowRm['room_color']) : '#00b4d8';
$colorBlocked   = !empty($rowbl['room_color']) ? (strpos($rowbl['room_color'], '#') === 0 ? $rowbl['room_color'] : '#'.$rowbl['room_color']) : '#800040';

// Sidebar & KPI Summary Queries
// 1. All Upcoming Bookings
$sqlAR_all = mysql_query("select count(distinct booking_no) AS totalAll from bq_hallbooking where confirm_status='2' AND str_to_date(book_date,'%d/%m/%Y') >= '$adtTT'"); 
$rowAr_all = mysql_fetch_array($sqlAR_all);
$cntAll = $rowAr_all['totalAll'] ? $rowAr_all['totalAll'] : 0;

// 2. Today's Bookings & Guaranteed Pax
$sqlAR_today = mysql_query("select count(distinct booking_no) AS totalToday, sum(guaranted) as totalPaxToday from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') = '$adtTT' AND confirm_status='2'"); 
$rowAr_today = mysql_fetch_array($sqlAR_today);
$cntToday = $rowAr_today['totalToday'] ? $rowAr_today['totalToday'] : 0;
$paxToday = $rowAr_today['totalPaxToday'] ? $rowAr_today['totalPaxToday'] : 0;

// 3. This Week's Bookings
$monday = strtotime("last monday");
$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
$sunday = strtotime(date("Y-m-d",$monday)." +6 days");
$frmW = date("Y-m-d",$monday);
$todW = date("Y-m-d",$sunday);
$sqlAR_week = mysql_query("select count(distinct booking_no) AS totalWeek from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') >= '$frmW' AND str_to_date(book_date,'%d/%m/%Y') <= '$todW' AND confirm_status='2'"); 
$rowAr_week = mysql_fetch_array($sqlAR_week);
$cntWeek = $rowAr_week['totalWeek'] ? $rowAr_week['totalWeek'] : 0;

// 4. This Month's Bookings
$frmM = $adtT[2].'-'.$adtT[1].'-01';
$todM = date("Y-m-t", strtotime($frmM));
$sqlAR_month = mysql_query("select count(distinct booking_no) AS totalMonth from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') >= '$frmM' AND str_to_date(book_date,'%d/%m/%Y') <= '$todM' AND confirm_status='2'"); 
$rowAr_month = mysql_fetch_array($sqlAR_month);
$cntMonth = $rowAr_month['totalMonth'] ? $rowAr_month['totalMonth'] : 0;

// 5. Total Venues & Occupancy Calculation
$sqlVenueCount = mysql_query("select count(*) as totalVenues from bq_venue");
$rowVenueCount = mysql_fetch_array($sqlVenueCount);
$cntVenues = $rowVenueCount['totalVenues'] ? $rowVenueCount['totalVenues'] : 0;

$occupancyRate = ($cntVenues > 0) ? round(($cntToday / $cntVenues) * 100, 1) : 0;
?>

<!-- Google Fonts: Plus Jakarta Sans for a world-class luxury SaaS aesthetic -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap.min.js"></script>

<style>
/* ==========================================================================
   State-of-the-Art Luxury Banquet Management Dashboard
   ========================================================================== */

:root {
    --primary-color: #0073B5;
    --primary-dark: #005a8e;
    --primary-light: #e0f2fe;
    --primary-border: #bae6fd;
    --accent-emerald: #10b981;
    --accent-amber: #f59e0b;
    --accent-purple: #8b5cf6;
    --accent-rose: #f43f5e;
    --surface-bg: #f8fafc;
    --card-bg: #ffffff;
    --text-main: #0f172a;
    --text-muted: #64748b;
    --border-color: #e2e8f0;
    --border-subtle: #f1f5f9;
    --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.06), 0 1px 2px 0 rgba(0, 0, 0, 0.04);
    --shadow-md: 0 4px 12px -1px rgba(0, 0, 0, 0.08), 0 2px 6px -1px rgba(0, 0, 0, 0.04);
    --shadow-lg: 0 12px 24px -4px rgba(0, 0, 0, 0.1), 0 4px 10px -2px rgba(0, 0, 0, 0.05);
    --radius-sm: 6px;
    --radius-md: 10px;
    --radius-lg: 14px;
}

body {
    background-color: var(--surface-bg) !important;
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    color: var(--text-main) !important;
    letter-spacing: -0.01em;
}

.bqt-dashboard-wrapper {
    max-width: 100%;
    margin: 0 auto;
    padding: 18px 24px 70px 24px;
    box-sizing: border-box;
}

/* 1. Header KPIs & Capacity Overview */
.bqt-kpi-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 16px;
    margin-bottom: 20px;
}

@media (max-width: 1200px) {
    .bqt-kpi-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 768px) {
    .bqt-kpi-grid {
        grid-template-columns: 1fr;
    }
}

.bqt-kpi-card {
    background: var(--card-bg);
    border-radius: var(--radius-md);
    border: 1px solid var(--border-color);
    padding: 16px 20px;
    box-shadow: var(--shadow-sm);
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.bqt-kpi-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
    border-color: #cbd5e1;
}

.bqt-kpi-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}

.bqt-kpi-top h4 {
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--text-muted);
    margin: 0;
}

.bqt-kpi-icon {
    width: 38px;
    height: 38px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
}

.kpi-today .bqt-kpi-icon { background: #eff6ff; color: #2563eb; }
.kpi-week .bqt-kpi-icon { background: #ecfeff; color: #0891b2; }
.kpi-month .bqt-kpi-icon { background: #f5f3ff; color: #7c3aed; }
.kpi-occupancy .bqt-kpi-icon { background: #ecfdf5; color: #059669; }

.bqt-kpi-value {
    font-size: 28px;
    font-weight: 800;
    color: var(--text-main);
    line-height: 1;
    margin: 0 0 6px 0;
}

.bqt-kpi-subtext {
    font-size: 12px;
    color: var(--text-muted);
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
}

.bqt-progress-track {
    width: 100%;
    height: 6px;
    background: #f1f5f9;
    border-radius: 3px;
    overflow: hidden;
    margin-top: 8px;
}

.bqt-progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #10b981 0%, #059669 100%);
    border-radius: 3px;
    transition: width 0.6s ease;
}

/* 2. Glassmorphic Controls & Navigation Bar */
.bqt-toolbar-card {
    background: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    padding: 14px 20px;
    margin-bottom: 20px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
}

.bqt-toolbar-left {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 12px;
}

/* Quick Date Preset Chips */
.bqt-preset-group {
    display: flex;
    align-items: center;
    gap: 6px;
    background: #f1f5f9;
    padding: 3px;
    border-radius: 8px;
    margin-right: 8px;
}

.bqt-preset-btn {
    border: none;
    background: transparent;
    font-size: 12px;
    font-weight: 700;
    color: var(--text-muted);
    padding: 5px 12px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.15s ease;
}

.bqt-preset-btn:hover {
    color: var(--text-main);
}

.bqt-preset-btn.active {
    background: #ffffff;
    color: var(--primary-color);
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.bqt-input-group {
    display: flex;
    align-items: center;
    gap: 8px;
}

.bqt-input-box {
    position: relative;
    display: flex;
    align-items: center;
}

.bqt-input-box i {
    position: absolute;
    left: 10px;
    color: #94a3b8;
    font-size: 13px;
    pointer-events: none;
}

.bqt-input-date {
    height: 36px;
    padding: 6px 12px 6px 30px;
    font-size: 13px;
    font-weight: 700;
    color: var(--text-main);
    background-color: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: var(--radius-sm);
    text-align: center;
    width: 120px;
    box-sizing: border-box;
    transition: all 0.15s ease;
}

.bqt-input-date:focus {
    border-color: var(--primary-color);
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 115, 181, 0.15);
}

.bqt-select {
    height: 36px;
    padding: 6px 12px;
    font-size: 13px;
    font-weight: 700;
    color: var(--text-main);
    background-color: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: var(--radius-sm);
    min-width: 170px;
    transition: all 0.15s ease;
    cursor: pointer;
}

.bqt-select:focus {
    border-color: var(--primary-color);
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 115, 181, 0.15);
}

.btn-bqt-primary {
    background: linear-gradient(135deg, #0073B5 0%, #005a8e 100%);
    color: #ffffff !important;
    border: none;
    border-radius: var(--radius-sm);
    padding: 0 18px;
    height: 36px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none !important;
    box-shadow: 0 2px 4px rgba(0, 115, 181, 0.25);
    transition: all 0.15s ease;
}

.btn-bqt-primary:hover {
    background: linear-gradient(135deg, #005a8e 0%, #00456e 100%);
    box-shadow: 0 4px 8px rgba(0, 115, 181, 0.35);
    transform: translateY(-1px);
}

.btn-bqt-outline {
    background: #ffffff;
    color: var(--text-main) !important;
    border: 1px solid #cbd5e1;
    border-radius: var(--radius-sm);
    padding: 0 14px;
    height: 36px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none !important;
    transition: all 0.15s ease;
}

.btn-bqt-outline:hover {
    background-color: #f1f5f9;
    border-color: #94a3b8;
}

.btn-bqt-action {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #ffffff !important;
    border: none;
    border-radius: var(--radius-sm);
    padding: 0 18px;
    height: 36px;
    font-size: 13px;
    font-weight: 800;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none !important;
    box-shadow: 0 2px 6px rgba(16, 185, 129, 0.3);
    transition: all 0.15s ease;
}

.btn-bqt-action:hover {
    box-shadow: 0 4px 10px rgba(16, 185, 129, 0.45);
    transform: translateY(-1px);
}

.bqt-toolbar-right {
    display: flex;
    align-items: center;
    gap: 8px;
}

/* 3. Main Split Grid: Left Sidebar + Center Timeline Matrix */
.bqt-main-grid {
    display: grid;
    grid-template-columns: 330px 1fr;
    gap: 20px;
    align-items: start;
}

@media (max-width: 1200px) {
    .bqt-main-grid {
        grid-template-columns: 1fr;
    }
}

/* Left Sidebar: Upcoming Functions Drawer */
.bqt-drawer-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 670px;
}

.bqt-drawer-header {
    padding: 16px 18px;
    background-color: #ffffff;
    border-bottom: 1px solid var(--border-color);
}

.bqt-drawer-title {
    font-size: 13px;
    font-weight: 800;
    color: var(--text-main);
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 0 0 12px 0;
    text-transform: uppercase;
    letter-spacing: 0.6px;
}

.bqt-drawer-title-left {
    display: flex;
    align-items: center;
    gap: 8px;
}

.bqt-drawer-title i {
    color: var(--primary-color);
}

.bqt-search-box {
    position: relative;
    width: 100%;
}

.bqt-search-input {
    width: 100%;
    box-sizing: border-box;
    padding: 8px 12px 8px 34px;
    font-size: 12px;
    font-weight: 600;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    background: #f8fafc;
    color: var(--text-main);
    transition: all 0.15s ease;
}

.bqt-search-input:focus {
    background: #ffffff;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(0, 115, 181, 0.15);
    outline: none;
}

.bqt-search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    color: #94a3b8;
}

/* Sidebar Tab Nav */
.bqt-drawer-tabs {
    display: flex;
    background: #f1f5f9;
    padding: 4px;
    border-bottom: 1px solid var(--border-color);
}

.bqt-tab-btn {
    flex: 1;
    border: none;
    background: transparent;
    padding: 7px 4px;
    font-size: 12px;
    font-weight: 700;
    color: var(--text-muted);
    border-radius: 6px;
    cursor: pointer;
    text-align: center;
    transition: all 0.15s ease;
}

.bqt-tab-btn.active {
    background: #ffffff;
    color: var(--primary-color);
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
}

.bqt-tab-count {
    display: inline-block;
    padding: 1px 6px;
    font-size: 10px;
    font-weight: 800;
    border-radius: 10px;
    background: #e2e8f0;
    color: var(--text-main);
    margin-left: 3px;
}

.bqt-tab-btn.active .bqt-tab-count {
    background: var(--primary-light);
    color: var(--primary-color);
}

/* Sidebar Booking List */
.bqt-booking-list {
    flex: 1;
    overflow-y: auto;
    padding: 12px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    background: #fafbfc;
}

.bqt-booking-card {
    background: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: var(--radius-sm);
    padding: 12px 14px;
    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    text-decoration: none !important;
    display: block;
    color: inherit;
    position: relative;
    box-shadow: var(--shadow-sm);
}

.bqt-booking-card:hover {
    border-color: var(--primary-color);
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
}

.bqt-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 6px;
}

.bqt-card-bknum {
    background: #eff6ff;
    color: #1d4ed8;
    font-size: 11px;
    font-weight: 800;
    padding: 3px 8px;
    border-radius: 4px;
    letter-spacing: 0.3px;
}

.bqt-card-session {
    font-size: 10px;
    font-weight: 800;
    text-transform: uppercase;
    padding: 2px 7px;
    border-radius: 10px;
    letter-spacing: 0.5px;
}

.session-lunch { background: #fef3c7; color: #b45309; }
.session-dinner { background: #ede9fe; color: #6d28d9; }
.session-other { background: #e0f2fe; color: #0369a1; }

.bqt-card-guest {
    font-size: 13px;
    font-weight: 800;
    color: var(--text-main);
    margin-bottom: 6px;
    line-height: 1.3;
}

.bqt-card-details {
    display: flex;
    flex-direction: column;
    gap: 4px;
    font-size: 11px;
    color: var(--text-muted);
    font-weight: 600;
    margin-bottom: 8px;
}

.bqt-card-meta-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.bqt-card-venue {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    color: #334155;
    font-weight: 700;
}

.bqt-card-pax {
    background: #f1f5f9;
    padding: 2px 6px;
    border-radius: 4px;
    font-weight: 700;
    color: #475569;
}

.bqt-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px solid #f1f5f9;
    padding-top: 8px;
    font-size: 11px;
}

.bqt-card-date {
    color: var(--text-muted);
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.bqt-card-btn {
    color: var(--primary-color);
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

/* 4. Center Timeline Schedule Matrix */
.bqt-matrix-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 670px;
}

.bqt-matrix-header {
    padding: 14px 20px;
    background: #ffffff;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.bqt-matrix-title {
    font-size: 14px;
    font-weight: 800;
    color: var(--text-main);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.bqt-matrix-title i {
    color: var(--primary-color);
}

.bqt-matrix-range-badge {
    background: var(--primary-light);
    color: var(--primary-color);
    font-size: 12px;
    font-weight: 800;
    padding: 5px 12px;
    border-radius: 20px;
    border: 1px solid var(--primary-border);
    display: flex;
    align-items: center;
    gap: 6px;
}

.bqt-table-container {
    flex: 1;
    overflow: auto;
    position: relative;
    background: #ffffff;
}

.bqt-timeline-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    table-layout: fixed;
    font-size: 12px;
}

/* Sticky Headers */
.bqt-timeline-table thead th {
    position: sticky;
    top: 0;
    background: #0073B5;
    color: #ffffff;
    font-weight: 800;
    font-size: 11px;
    text-align: center;
    padding: 10px 4px;
    border-right: 1px solid rgba(255, 255, 255, 0.15);
    border-bottom: 2px solid #005a8e;
    z-index: 25;
    height: 42px;
    box-sizing: border-box;
    white-space: nowrap;
}

.bqt-timeline-table thead th.th-date {
    left: 0;
    z-index: 35;
    width: 100px;
    min-width: 100px;
    max-width: 100px;
    text-align: center;
    border-right: 1px solid rgba(255, 255, 255, 0.25);
}

.bqt-timeline-table thead th.th-venue {
    left: 100px;
    z-index: 35;
    width: 160px;
    min-width: 160px;
    max-width: 160px;
    text-align: left;
    padding-left: 12px;
    border-right: 2px solid rgba(255, 255, 255, 0.35);
}

.bqt-timeline-table thead th.th-hour {
    width: 48px;
    min-width: 48px;
    letter-spacing: -0.3px;
}

/* Sticky Columns in Body */
.bqt-timeline-table tbody td.td-date {
    position: sticky;
    left: 0;
    background: #ffffff;
    font-weight: 800;
    color: var(--text-main);
    text-align: center;
    padding: 10px 8px;
    border-right: 1px solid var(--border-color);
    border-bottom: 1px solid var(--border-color);
    z-index: 15;
    width: 100px;
    min-width: 100px;
    max-width: 100px;
}

.bqt-timeline-table tbody tr:hover td.td-date {
    background: #f8fafc;
}

.bqt-timeline-table tbody td.td-venue {
    position: sticky;
    left: 100px;
    background: #ffffff;
    padding: 10px 12px;
    border-right: 2px solid #cbd5e1;
    border-bottom: 1px solid var(--border-color);
    z-index: 15;
    width: 160px;
    min-width: 160px;
    max-width: 160px;
}

.bqt-timeline-table tbody tr:hover td.td-venue {
    background: #f8fafc;
}

.bqt-venue-name {
    font-weight: 800;
    font-size: 13px;
    color: #1e293b;
    display: block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-decoration: none;
    transition: color 0.15s ease;
}

.bqt-venue-name:hover {
    color: var(--primary-color);
}

.bqt-venue-meta {
    font-size: 10px;
    font-weight: 600;
    color: #94a3b8;
    display: block;
    margin-top: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Slot Cells */
.bqt-timeline-table tbody td.td-slot {
    padding: 4px 2px;
    text-align: center;
    border-right: 1px solid #f1f5f9;
    border-bottom: 1px solid var(--border-color);
    height: 48px;
    box-sizing: border-box;
}

/* Spanning Gantt Booking Pill */
.bqt-gantt-pill {
    width: 100%;
    height: 100%;
    min-height: 38px;
    border-radius: 6px;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 10px;
    box-sizing: border-box;
    text-decoration: none !important;
    cursor: pointer;
    font-weight: 700;
    font-size: 11px;
    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 2px 4px rgba(0,0,0,0.15), inset 0 1px 0 rgba(255,255,255,0.25);
    overflow: hidden;
    position: relative;
}

.bqt-gantt-pill:hover {
    transform: translateY(-1px) scale(1.01);
    box-shadow: 0 6px 14px rgba(0,0,0,0.25);
    z-index: 10;
}

.bqt-pill-left {
    display: flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.bqt-pill-right {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-shrink: 0;
}

.bqt-pill-tag {
    background: rgba(0, 0, 0, 0.25);
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: 800;
}

/* Vacant Slot */
.bqt-slot-vacant {
    display: block;
    width: 100%;
    height: 100%;
    min-height: 38px;
    border-radius: 4px;
    background-color: #f8fafc;
    border: 1px dashed #cbd5e1;
    color: #94a3b8;
    text-decoration: none !important;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.15s ease;
    cursor: pointer;
}

.bqt-slot-vacant:hover {
    background-color: #ecfdf5;
    border-color: #34d399;
    color: #059669;
    transform: scale(1.05);
    z-index: 5;
    box-shadow: 0 2px 6px rgba(16, 185, 129, 0.2);
}

.bqt-slot-vacant i {
    opacity: 0;
    font-size: 11px;
    transition: opacity 0.15s ease;
}

.bqt-slot-vacant:hover i {
    opacity: 1;
}

/* 5. Bottom Status Legend Bar */
.bqt-legend-bar {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    padding: 14px 20px;
    margin-top: 20px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
}

.bqt-legend-items {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 16px;
}

.bqt-legend-pill {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    font-weight: 700;
    color: var(--text-main);
}

.bqt-color-dot {
    width: 14px;
    height: 14px;
    border-radius: 4px;
    display: inline-block;
    box-shadow: 0 1px 2px rgba(0,0,0,0.15);
}

/* 6. Luxury Quick Details Modal */
.bqt-modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(15, 23, 42, 0.65);
    backdrop-filter: blur(4px);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
}

.bqt-modal-box {
    background: #ffffff;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    width: 90%;
    max-width: 520px;
    overflow: hidden;
    animation: modalIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes modalIn {
    from { opacity: 0; transform: scale(0.95) translateY(10px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}

.bqt-modal-header {
    background: linear-gradient(135deg, #0073B5 0%, #005a8e 100%);
    color: #ffffff;
    padding: 18px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.bqt-modal-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 800;
    display: flex;
    align-items: center;
    gap: 8px;
}

.bqt-modal-close {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: #ffffff;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.15s ease;
}

.bqt-modal-close:hover {
    background: rgba(255, 255, 255, 0.35);
}

.bqt-modal-body {
    padding: 24px;
}

.bqt-modal-field-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 20px;
}

.bqt-modal-field {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.bqt-modal-field label {
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-muted);
    margin: 0;
}

.bqt-modal-field span {
    font-size: 13px;
    font-weight: 700;
    color: var(--text-main);
}

.bqt-modal-footer {
    background: #f8fafc;
    border-top: 1px solid var(--border-color);
    padding: 14px 24px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
}
</style>

<div class="bqt-dashboard-wrapper">

    <!-- 1. Executive Summary & Capacity KPI Row -->
    <div class="bqt-kpi-grid">
        <div class="bqt-kpi-card kpi-today">
            <div>
                <div class="bqt-kpi-top">
                    <h4>Today's Functions</h4>
                    <div class="bqt-kpi-icon"><i class="fa fa-calendar-check-o"></i></div>
                </div>
                <div class="bqt-kpi-value"><?php echo $cntToday; ?></div>
            </div>
            <div class="bqt-kpi-subtext">
                <i class="fa fa-users" style="color:#2563eb;"></i> <?php echo $paxToday; ?> Expected Pax Today
            </div>
        </div>

        <div class="bqt-kpi-card kpi-occupancy">
            <div>
                <div class="bqt-kpi-top">
                    <h4>Today's Occupancy</h4>
                    <div class="bqt-kpi-icon"><i class="fa fa-pie-chart"></i></div>
                </div>
                <div class="bqt-kpi-value"><?php echo $occupancyRate; ?>%</div>
            </div>
            <div>
                <div class="bqt-kpi-subtext">
                    <span><?php echo $cntToday; ?> of <?php echo $cntVenues; ?> Halls Booked</span>
                </div>
                <div class="bqt-progress-track">
                    <div class="bqt-progress-bar" style="width: <?php echo min(100, $occupancyRate); ?>%;"></div>
                </div>
            </div>
        </div>

        <div class="bqt-kpi-card kpi-week">
            <div>
                <div class="bqt-kpi-top">
                    <h4>This Week</h4>
                    <div class="bqt-kpi-icon"><i class="fa fa-calendar"></i></div>
                </div>
                <div class="bqt-kpi-value"><?php echo $cntWeek; ?></div>
            </div>
            <div class="bqt-kpi-subtext">
                <i class="fa fa-clock-o" style="color:#0891b2;"></i> Mon &ndash; Sun Schedule
            </div>
        </div>

        <div class="bqt-kpi-card kpi-month">
            <div>
                <div class="bqt-kpi-top">
                    <h4>This Month</h4>
                    <div class="bqt-kpi-icon"><i class="fa fa-bar-chart"></i></div>
                </div>
                <div class="bqt-kpi-value"><?php echo $cntMonth; ?></div>
            </div>
            <div class="bqt-kpi-subtext">
                <i class="fa fa-check-circle-o" style="color:#7c3aed;"></i> Total Bookings in <?php echo date('F', strtotime($frmM)); ?>
            </div>
        </div>

        <div class="bqt-kpi-card" style="background: linear-gradient(135deg, #0073B5 0%, #00456e 100%); color: #ffffff; border: none;">
            <div>
                <div class="bqt-kpi-top">
                    <h4 style="color: rgba(255,255,255,0.8);">Total Upcoming</h4>
                    <div class="bqt-kpi-icon" style="background: rgba(255,255,255,0.18); color: #fff;"><i class="fa fa-bookmark"></i></div>
                </div>
                <div class="bqt-kpi-value" style="color: #ffffff;"><?php echo $cntAll; ?></div>
            </div>
            <div class="bqt-kpi-subtext" style="color: rgba(255,255,255,0.85);">
                <i class="fa fa-building-o"></i> <?php echo $cntVenues; ?> Active Banquet Halls
            </div>
        </div>
    </div>

    <!-- 2. Controls & Date Navigation Toolbar -->
    <div class="bqt-toolbar-card">
        <div class="bqt-toolbar-left">
            <!-- Quick Date Preset Chips -->
            <div class="bqt-preset-group">
                <button type="button" class="bqt-preset-btn" onclick="applyPreset('today');">Today</button>
                <button type="button" class="bqt-preset-btn" onclick="applyPreset('tomorrow');">Tomorrow</button>
                <button type="button" class="bqt-preset-btn" onclick="applyPreset('3days');">Next 3 Days</button>
                <button type="button" class="bqt-preset-btn" onclick="applyPreset('week');">This Week</button>
                <button type="button" class="bqt-preset-btn" onclick="applyPreset('month');">This Month</button>
            </div>

            <div class="bqt-input-group">
                <div class="bqt-input-box">
                    <i class="fa fa-calendar-o"></i>
                    <input name="from_date" type="text" class="bqt-input-date datepicker" id="from_date" value="<?php echo $frDate; ?>" placeholder="DD/MM/YYYY" autocomplete="off" />
                </div>
                <span style="color:#94a3b8;font-weight:700;">&ndash;</span>
                <div class="bqt-input-box">
                    <i class="fa fa-calendar-o"></i>
                    <input name="to_date" type="text" class="bqt-input-date datepicker1" id="to_date" value="<?php echo $toDate; ?>" placeholder="DD/MM/YYYY" autocomplete="off" />
                </div>
            </div>

            <select name="bq_venue" id="bq_venue" class="bqt-select">
                <option value="all">All Venues & Halls</option>
                <?php 
                $sqlPV = mysql_query("select * from bq_venue order by venue_desc asc");
                while($rowPV = mysql_fetch_array($sqlPV)) { 
                ?>
                    <option value="<?php echo $rowPV['venue_code']; ?>" <?php if($selVen == $rowPV['venue_code'] || $selVen == $rowPV['venue_desc']) echo 'selected'; ?>>
                        <?php echo $rowPV['venue_desc']; ?> (<?php echo $rowPV['location']; ?>)
                    </option>
                <?php } ?>
            </select>

            <button type="button" class="btn-bqt-primary" onclick="showGridView();" title="Apply Filters">
                <i class="fa fa-filter"></i> Apply
            </button>
        </div>

        <div class="bqt-toolbar-right">
            <button type="button" class="btn-bqt-outline" onclick="dashprevious();" title="Step Back 1 Day">
                <i class="fa fa-chevron-left"></i> Prev Day
            </button>
            <button type="button" class="btn-bqt-outline" onclick="dashNext();" title="Step Forward 1 Day">
                Next Day <i class="fa fa-chevron-right"></i>
            </button>
            <a href="<?php echo $home_path; ?>/transaction/frontdesk/hall-booking.php" target="_blank" class="btn-bqt-action" title="Create New Banquet Booking">
                <i class="fa fa-plus-circle"></i> + New Booking
            </a>
        </div>
    </div>

    <!-- 3. Main Split Grid: Left Sidebar + Central Schedule Timeline -->
    <div class="bqt-main-grid">

        <!-- Left Column: Upcoming Functions & Hall Status Drawer -->
        <div class="bqt-drawer-card">
            <div class="bqt-drawer-header">
                <div class="bqt-drawer-title">
                    <div class="bqt-drawer-title-left">
                        <i class="fa fa-calendar"></i> Upcoming Banquets
                    </div>
                </div>
                <div class="bqt-search-box">
                    <i class="fa fa-search bqt-search-icon"></i>
                    <input type="text" id="bookingSearchInput" class="bqt-search-input" placeholder="Search guest, Bk#, venue..." onkeyup="filterSidebarBookings();" />
                </div>
            </div>

            <div class="bqt-drawer-tabs">
                <button type="button" class="bqt-tab-btn active" id="tab-today" onclick="switchSidebarTab('today');">
                    Today <span class="bqt-tab-count"><?php echo $cntToday; ?></span>
                </button>
                <button type="button" class="bqt-tab-btn" id="tab-week" onclick="switchSidebarTab('week');">
                    Week <span class="bqt-tab-count"><?php echo $cntWeek; ?></span>
                </button>
                <button type="button" class="bqt-tab-btn" id="tab-month" onclick="switchSidebarTab('month');">
                    Month <span class="bqt-tab-count"><?php echo $cntMonth; ?></span>
                </button>
                <button type="button" class="bqt-tab-btn" id="tab-all" onclick="switchSidebarTab('all');">
                    All <span class="bqt-tab-count"><?php echo $cntAll; ?></span>
                </button>
            </div>

            <!-- Tab 1: Today -->
            <div class="bqt-booking-list" id="list-today">
                <?php
                $sqlTodayList = mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') = '$adtTT' AND confirm_status='2' order by str_to_date(book_date,'%d/%m/%Y') ASC");
                if(mysql_num_rows($sqlTodayList) > 0) {
                    while($rowB = mysql_fetch_array($sqlTodayList)) {
                        $sessClass = 'session-other';
                        $sessLow = strtolower($rowB['session']);
                        if(strpos($sessLow, 'lunch') !== false) $sessClass = 'session-lunch';
                        else if(strpos($sessLow, 'dinner') !== false) $sessClass = 'session-dinner';
                ?>
                    <div class="bqt-booking-card" data-search="<?php echo strtolower($rowB['booking_no'].' '.$rowB['guest_name'].' '.$rowB['venue']); ?>">
                        <div class="bqt-card-header">
                            <span class="bqt-card-bknum">#<?php echo $rowB['booking_no']; ?></span>
                            <span class="bqt-card-session <?php echo $sessClass; ?>"><?php echo strtoupper($rowB['session']); ?></span>
                        </div>
                        <div class="bqt-card-guest"><?php echo strtoupper($rowB['guest_name']); ?></div>
                        <div class="bqt-card-details">
                            <div class="bqt-card-meta-row">
                                <span class="bqt-card-venue"><i class="fa fa-map-marker" style="color:var(--primary-color);"></i> <?php echo $rowB['venue']; ?></span>
                                <span class="bqt-card-pax"><i class="fa fa-users"></i> <?php echo $rowB['guaranted']; ?> Pax</span>
                            </div>
                            <div class="bqt-card-meta-row" style="margin-top:2px;">
                                <span><i class="fa fa-clock-o"></i> <?php echo $rowB['from_time']; ?> &ndash; <?php echo $rowB['to_time']; ?></span>
                                <span style="text-transform:capitalize;color:#64748b;"><?php echo $rowB['funct']; ?></span>
                            </div>
                        </div>
                        <div class="bqt-card-footer">
                            <span class="bqt-card-date"><i class="fa fa-calendar-o"></i> <?php echo $rowB['book_date']; ?></span>
                            <a href="<?php echo $home_path; ?>/transaction/frontdesk/edit-hall-booking.php?roomBk=<?php echo $rowB['booking_no']; ?>&rmBkID=<?php echo $rowB['hallbook_id']; ?>" target="_blank" class="bqt-card-btn">
                                Edit &rarr;
                            </a>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    echo '<div style="text-align:center;padding:40px 15px;color:#94a3b8;"><i class="fa fa-calendar-times-o" style="font-size:28px;margin-bottom:8px;display:block;"></i>No functions scheduled for today.</div>';
                }
                ?>
            </div>

            <!-- Tab 2: Week -->
            <div class="bqt-booking-list" id="list-week" style="display:none;">
                <?php
                $sqlWeekList = mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') >= '$frmW' AND str_to_date(book_date,'%d/%m/%Y') <= '$todW' AND confirm_status='2' order by str_to_date(book_date,'%d/%m/%Y') ASC");
                if(mysql_num_rows($sqlWeekList) > 0) {
                    while($rowB = mysql_fetch_array($sqlWeekList)) {
                        $sessClass = 'session-other';
                        $sessLow = strtolower($rowB['session']);
                        if(strpos($sessLow, 'lunch') !== false) $sessClass = 'session-lunch';
                        else if(strpos($sessLow, 'dinner') !== false) $sessClass = 'session-dinner';
                ?>
                    <div class="bqt-booking-card" data-search="<?php echo strtolower($rowB['booking_no'].' '.$rowB['guest_name'].' '.$rowB['venue']); ?>">
                        <div class="bqt-card-header">
                            <span class="bqt-card-bknum">#<?php echo $rowB['booking_no']; ?></span>
                            <span class="bqt-card-session <?php echo $sessClass; ?>"><?php echo strtoupper($rowB['session']); ?></span>
                        </div>
                        <div class="bqt-card-guest"><?php echo strtoupper($rowB['guest_name']); ?></div>
                        <div class="bqt-card-details">
                            <div class="bqt-card-meta-row">
                                <span class="bqt-card-venue"><i class="fa fa-map-marker" style="color:var(--primary-color);"></i> <?php echo $rowB['venue']; ?></span>
                                <span class="bqt-card-pax"><i class="fa fa-users"></i> <?php echo $rowB['guaranted']; ?> Pax</span>
                            </div>
                            <div class="bqt-card-meta-row" style="margin-top:2px;">
                                <span><i class="fa fa-clock-o"></i> <?php echo $rowB['from_time']; ?> &ndash; <?php echo $rowB['to_time']; ?></span>
                                <span style="text-transform:capitalize;color:#64748b;"><?php echo $rowB['funct']; ?></span>
                            </div>
                        </div>
                        <div class="bqt-card-footer">
                            <span class="bqt-card-date"><i class="fa fa-calendar-o"></i> <?php echo $rowB['book_date']; ?></span>
                            <a href="<?php echo $home_path; ?>/transaction/frontdesk/edit-hall-booking.php?roomBk=<?php echo $rowB['booking_no']; ?>&rmBkID=<?php echo $rowB['hallbook_id']; ?>" target="_blank" class="bqt-card-btn">
                                Edit &rarr;
                            </a>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    echo '<div style="text-align:center;padding:40px 15px;color:#94a3b8;"><i class="fa fa-calendar-times-o" style="font-size:28px;margin-bottom:8px;display:block;"></i>No functions scheduled for this week.</div>';
                }
                ?>
            </div>

            <!-- Tab 3: Month -->
            <div class="bqt-booking-list" id="list-month" style="display:none;">
                <?php
                $sqlMonthList = mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') >= '$frmM' AND str_to_date(book_date,'%d/%m/%Y') <= '$todM' AND confirm_status='2' order by str_to_date(book_date,'%d/%m/%Y') ASC");
                if(mysql_num_rows($sqlMonthList) > 0) {
                    while($rowB = mysql_fetch_array($sqlMonthList)) {
                        $sessClass = 'session-other';
                        $sessLow = strtolower($rowB['session']);
                        if(strpos($sessLow, 'lunch') !== false) $sessClass = 'session-lunch';
                        else if(strpos($sessLow, 'dinner') !== false) $sessClass = 'session-dinner';
                ?>
                    <div class="bqt-booking-card" data-search="<?php echo strtolower($rowB['booking_no'].' '.$rowB['guest_name'].' '.$rowB['venue']); ?>">
                        <div class="bqt-card-header">
                            <span class="bqt-card-bknum">#<?php echo $rowB['booking_no']; ?></span>
                            <span class="bqt-card-session <?php echo $sessClass; ?>"><?php echo strtoupper($rowB['session']); ?></span>
                        </div>
                        <div class="bqt-card-guest"><?php echo strtoupper($rowB['guest_name']); ?></div>
                        <div class="bqt-card-details">
                            <div class="bqt-card-meta-row">
                                <span class="bqt-card-venue"><i class="fa fa-map-marker" style="color:var(--primary-color);"></i> <?php echo $rowB['venue']; ?></span>
                                <span class="bqt-card-pax"><i class="fa fa-users"></i> <?php echo $rowB['guaranted']; ?> Pax</span>
                            </div>
                            <div class="bqt-card-meta-row" style="margin-top:2px;">
                                <span><i class="fa fa-clock-o"></i> <?php echo $rowB['from_time']; ?> &ndash; <?php echo $rowB['to_time']; ?></span>
                                <span style="text-transform:capitalize;color:#64748b;"><?php echo $rowB['funct']; ?></span>
                            </div>
                        </div>
                        <div class="bqt-card-footer">
                            <span class="bqt-card-date"><i class="fa fa-calendar-o"></i> <?php echo $rowB['book_date']; ?></span>
                            <a href="<?php echo $home_path; ?>/transaction/frontdesk/edit-hall-booking.php?roomBk=<?php echo $rowB['booking_no']; ?>&rmBkID=<?php echo $rowB['hallbook_id']; ?>" target="_blank" class="bqt-card-btn">
                                Edit &rarr;
                            </a>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    echo '<div style="text-align:center;padding:40px 15px;color:#94a3b8;"><i class="fa fa-calendar-times-o" style="font-size:28px;margin-bottom:8px;display:block;"></i>No functions scheduled for this month.</div>';
                }
                ?>
            </div>

            <!-- Tab 4: All -->
            <div class="bqt-booking-list" id="list-all" style="display:none;">
                <?php
                $sqlAllList = mysql_query("select * from bq_hallbooking where confirm_status='2' AND str_to_date(book_date,'%d/%m/%Y') >= '$adtTT' order by str_to_date(book_date,'%d/%m/%Y') ASC");
                if(mysql_num_rows($sqlAllList) > 0) {
                    while($rowB = mysql_fetch_array($sqlAllList)) {
                        $sessClass = 'session-other';
                        $sessLow = strtolower($rowB['session']);
                        if(strpos($sessLow, 'lunch') !== false) $sessClass = 'session-lunch';
                        else if(strpos($sessLow, 'dinner') !== false) $sessClass = 'session-dinner';
                ?>
                    <div class="bqt-booking-card" data-search="<?php echo strtolower($rowB['booking_no'].' '.$rowB['guest_name'].' '.$rowB['venue']); ?>">
                        <div class="bqt-card-header">
                            <span class="bqt-card-bknum">#<?php echo $rowB['booking_no']; ?></span>
                            <span class="bqt-card-session <?php echo $sessClass; ?>"><?php echo strtoupper($rowB['session']); ?></span>
                        </div>
                        <div class="bqt-card-guest"><?php echo strtoupper($rowB['guest_name']); ?></div>
                        <div class="bqt-card-details">
                            <div class="bqt-card-meta-row">
                                <span class="bqt-card-venue"><i class="fa fa-map-marker" style="color:var(--primary-color);"></i> <?php echo $rowB['venue']; ?></span>
                                <span class="bqt-card-pax"><i class="fa fa-users"></i> <?php echo $rowB['guaranted']; ?> Pax</span>
                            </div>
                            <div class="bqt-card-meta-row" style="margin-top:2px;">
                                <span><i class="fa fa-clock-o"></i> <?php echo $rowB['from_time']; ?> &ndash; <?php echo $rowB['to_time']; ?></span>
                                <span style="text-transform:capitalize;color:#64748b;"><?php echo $rowB['funct']; ?></span>
                            </div>
                        </div>
                        <div class="bqt-card-footer">
                            <span class="bqt-card-date"><i class="fa fa-calendar-o"></i> <?php echo $rowB['book_date']; ?></span>
                            <a href="<?php echo $home_path; ?>/transaction/frontdesk/edit-hall-booking.php?roomBk=<?php echo $rowB['booking_no']; ?>&rmBkID=<?php echo $rowB['hallbook_id']; ?>" target="_blank" class="bqt-card-btn">
                                Edit &rarr;
                            </a>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    echo '<div style="text-align:center;padding:40px 15px;color:#94a3b8;"><i class="fa fa-calendar-times-o" style="font-size:28px;margin-bottom:8px;display:block;"></i>No upcoming functions found.</div>';
                }
                ?>
            </div>
        </div>

        <!-- Center Column: Continuous Timeline Gantt Matrix -->
        <div class="bqt-matrix-card">
            <div class="bqt-matrix-header">
                <div class="bqt-matrix-title">
                    <i class="fa fa-sliders"></i> Master Venue Timeline
                </div>
                <div class="bqt-matrix-range-badge">
                    <i class="fa fa-calendar"></i> <?php echo $frDate; ?> <?php if($frDate != $toDate) echo ' &ndash; '.$toDate; ?>
                </div>
            </div>

            <div class="bqt-table-container" id="dshBrd">
                <table class="bqt-timeline-table">
                    <thead>
                        <tr>
                            <th class="th-date">Date</th>
                            <th class="th-venue">Venue / Hall</th>
                            <?php for($cc=6; $cc<=24; $cc++) { ?>
                                <th class="th-hour"><?php echo sprintf('%02d:00', $cc); ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = $date_from; $i <= $date_to; $i += 86400) {
                            $rr = date("d/m/Y", $i);	
                            $rrr = date("Y-m-d", $i);

                            if($selVen != '' && $selVen != 'all') {
                                $sqlRe = mysql_query("select * from bq_venue where venue_code='$selVen' or venue_desc='$selVen'");
                            } else {
                                $sqlRe = mysql_query("select * from bq_venue order by venue_desc asc");
                            }

                            $totalVens = mysql_num_rows($sqlRe);
                            $vIdx = 0;

                            while($rowRe = mysql_fetch_array($sqlRe)) {
                                $vIdx++;
                        ?>
                        <tr>
                            <!-- Sticky Date Column -->
                            <?php if($vIdx == 1) { ?>
                                <td class="td-date" rowspan="<?php echo $totalVens; ?>">
                                    <div style="font-size:13px;font-weight:800;"><?php echo $rr; ?></div>
                                    <div style="font-size:11px;color:#64748b;font-weight:700;margin-top:2px;text-transform:uppercase;"><?php echo date('l', $i); ?></div>
                                </td>
                            <?php } ?>

                            <!-- Sticky Venue Column with Floor & Area Meta -->
                            <td class="td-venue" title="<?php echo $rowRe['venue_desc']; ?>">
                                <a href="<?php echo $home_path; ?>/transaction/frontdesk/view-hall-booking.php?val=<?php echo urlencode($rowRe['venue_code']); ?>&fromdate=<?php echo $rr; ?>&todate=<?php echo $rr; ?>" target="_blank" class="bqt-venue-name">
                                    <?php echo $rowRe['venue_desc']; ?>
                                </a>
                                <span class="bqt-venue-meta">
                                    <?php echo !empty($rowRe['location']) ? $rowRe['location'] : 'Banquet Hall'; ?>
                                    <?php if(!empty($rowRe['area']) && $rowRe['area'] != '1') echo ' &bull; '.$rowRe['area']; ?>
                                </span>
                            </td>

                            <!-- Hourly Continuous Gantt Grid from 6 to 24 -->
                            <?php
                            $cc = 6;
                            while($cc <= 24) {
                                // Check if this hour has an active booking
                                $sqD = mysql_query("select * from bq_dashhall where str_to_date(funtion_date,'%d/%m/%Y') = STR_TO_DATE('$rr','%d/%m/%Y') AND venue='".$rowRe['venue_code']."' AND hour='".$cc."' AND status='1'");
                                
                                if(mysql_num_rows($sqD) > 0) {
                                    $roD = mysql_fetch_array($sqD);
                                    $currentBkNo = $roD['booking_no'];
                                    
                                    // Calculate how many continuous hours this booking spans
                                    $spanHours = 1;
                                    for($nextH = $cc + 1; $nextH <= 24; $nextH++) {
                                        $checkNext = mysql_query("select * from bq_dashhall where str_to_date(funtion_date,'%d/%m/%Y') = STR_TO_DATE('$rr','%d/%m/%Y') AND venue='".$rowRe['venue_code']."' AND hour='".$nextH."' AND status='1' AND booking_no='$currentBkNo'");
                                        if(mysql_num_rows($checkNext) > 0) {
                                            $spanHours++;
                                        } else {
                                            break;
                                        }
                                    }

                                    // Fetch full booking details for luxury preview
                                    $sqb = mysql_fetch_array(mysql_query("select * from bq_hallbooking where booking_no='".$roD['booking_no']."' AND hallbook_id='".$roD['hallbook_id']."'"));

                                    $slotColor = $colorConfirmed;
                                    $statusLabel = "Confirmed";
                                    if($roD['confirm_status'] == 1) { $slotColor = $colorAvailable; $statusLabel = "Available"; }
                                    else if($roD['confirm_status'] == 2) { $slotColor = $colorConfirmed; $statusLabel = "Confirmed"; }
                                    else if($roD['confirm_status'] == 3) { $slotColor = $colorWaitlist; $statusLabel = "Wait Listed"; }
                                    else if($roD['confirm_status'] == 4) { $slotColor = $colorEnquiry; $statusLabel = "Enquiry"; }
                                    else if($roD['confirm_status'] == 5) { $slotColor = $colorTentative; $statusLabel = "Tentative"; }
                                    else if($roD['confirm_status'] == 6) { $slotColor = $colorBlocked; $statusLabel = "Blocked"; }

                                    $guestName = !empty($roD['guest_name']) ? $roD['guest_name'] : 'Guest';
                                    $paxGuar = !empty($sqb['guaranted']) ? $sqb['guaranted'] : '1';
                                    $fromTimeStr = !empty($sqb['from_time']) ? $sqb['from_time'] : sprintf('%02d:00', $cc);
                                    $toTimeStr = !empty($sqb['to_time']) ? $sqb['to_time'] : sprintf('%02d:00', $cc + $spanHours);
                                    $sessionStr = !empty($sqb['session']) ? strtoupper($sqb['session']) : 'EVENT';
                                    $functStr = !empty($sqb['funct']) ? $sqb['funct'] : 'Function';

                                    // JSON data for the luxury modal
                                    $bookingJson = htmlspecialchars(json_encode([
                                        'booking_no' => $roD['booking_no'],
                                        'hallbook_id' => $roD['hallbook_id'],
                                        'guest_name' => $guestName,
                                        'venue' => $rowRe['venue_desc'],
                                        'location' => $rowRe['location'],
                                        'session' => $sessionStr,
                                        'funct' => $functStr,
                                        'from_time' => $fromTimeStr,
                                        'to_time' => $toTimeStr,
                                        'guaranted' => $paxGuar,
                                        'status' => $statusLabel,
                                        'status_color' => $slotColor,
                                        'phone' => !empty($sqb['contact_mobile']) ? $sqb['contact_mobile'] : (!empty($sqb['phone']) ? $sqb['phone'] : 'N/A'),
                                        'remarks' => !empty($sqb['remarks']) ? $sqb['remarks'] : 'None'
                                    ]), ENT_QUOTES, 'UTF-8');
                            ?>
                                <td class="td-slot" colspan="<?php echo $spanHours; ?>">
                                    <div class="bqt-gantt-pill" 
                                         style="background: linear-gradient(135deg, <?php echo $slotColor; ?> 0%, #b91c1c 100%);"
                                         onclick='openBookingModal(<?php echo $bookingJson; ?>);'>
                                        <div class="bqt-pill-left">
                                            <i class="fa fa-user-circle"></i>
                                            <span><?php echo strtoupper($guestName); ?></span>
                                            <span style="opacity:0.85;">(<?php echo $sessionStr; ?>)</span>
                                        </div>
                                        <div class="bqt-pill-right">
                                            <span class="bqt-pill-tag"><i class="fa fa-users"></i> <?php echo $paxGuar; ?> Pax</span>
                                            <span class="bqt-pill-tag">#<?php echo $roD['booking_no']; ?></span>
                                        </div>
                                    </div>
                                </td>
                            <?php 
                                    $cc += $spanHours;
                                } else { 
                            ?>
                                <td class="td-slot">
                                    <a href="<?php echo $home_path; ?>/transaction/frontdesk/hall-booking.php?dte=<?php echo $rr; ?>&ven=<?php echo urlencode($rowRe['venue_desc']); ?>" 
                                       target="_blank" 
                                       class="bqt-slot-vacant" 
                                       data-toggle="tooltip" 
                                       data-placement="top" 
                                       title="Vacant &bull; Click to Book <?php echo htmlspecialchars($rowRe['venue_desc']); ?> (<?php echo sprintf('%02d:00', $cc); ?>)">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </td>
                            <?php 
                                    $cc++;
                                } 
                            } 
                            ?>
                        </tr>
                        <?php 
                            } 
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- 4. Modern Status Legend Bar -->
    <div class="bqt-legend-bar">
        <span style="font-size:12px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:0.8px;">
            <i class="fa fa-tags"></i> Status Legend:
        </span>
        <div class="bqt-legend-items">
            <div class="bqt-legend-pill">
                <span class="bqt-color-dot" style="background-color: #f8fafc; border: 1px dashed #34d399;"></span>
                <span>Available / Vacant</span>
            </div>
            <div class="bqt-legend-pill">
                <span class="bqt-color-dot" style="background-color: <?php echo $colorConfirmed; ?>;"></span>
                <span>Confirmed</span>
            </div>
            <div class="bqt-legend-pill">
                <span class="bqt-color-dot" style="background-color: <?php echo $colorWaitlist; ?>;"></span>
                <span>Wait Listed</span>
            </div>
            <div class="bqt-legend-pill">
                <span class="bqt-color-dot" style="background-color: <?php echo $colorEnquiry; ?>;"></span>
                <span>Enquiry</span>
            </div>
            <div class="bqt-legend-pill">
                <span class="bqt-color-dot" style="background-color: <?php echo $colorTentative; ?>;"></span>
                <span>Tentative</span>
            </div>
            <div class="bqt-legend-pill">
                <span class="bqt-color-dot" style="background-color: <?php echo $colorBlocked; ?>;"></span>
                <span>Blocked</span>
            </div>
        </div>
        <div style="font-size:12px;color:#94a3b8;font-weight:600;">
            <i class="fa fa-info-circle"></i> Click any booking pill for quick preview & actions, or click a vacant slot to book.
        </div>
    </div>

</div>

<!-- 5. Luxury Quick Details Modal -->
<div class="bqt-modal-backdrop" id="bookingModal" onclick="closeBookingModal(event);">
    <div class="bqt-modal-box" onclick="event.stopPropagation();">
        <div class="bqt-modal-header" id="modalHeaderBg">
            <h3><i class="fa fa-bookmark"></i> <span id="modalBkNum">Booking Details</span></h3>
            <button type="button" class="bqt-modal-close" onclick="closeBookingModal();">&times;</button>
        </div>
        <div class="bqt-modal-body">
            <div class="bqt-modal-field-grid">
                <div class="bqt-modal-field">
                    <label>Guest Name</label>
                    <span id="modalGuest" style="color:var(--primary-color);font-size:15px;"></span>
                </div>
                <div class="bqt-modal-field">
                    <label>Venue / Hall</label>
                    <span id="modalVenue"></span>
                </div>
                <div class="bqt-modal-field">
                    <label>Timing / Duration</label>
                    <span id="modalTiming"></span>
                </div>
                <div class="bqt-modal-field">
                    <label>Session & Function</label>
                    <span id="modalSession"></span>
                </div>
                <div class="bqt-modal-field">
                    <label>Guaranteed Pax</label>
                    <span id="modalPax"></span>
                </div>
                <div class="bqt-modal-field">
                    <label>Contact Phone</label>
                    <span id="modalPhone"></span>
                </div>
            </div>

            <div class="bqt-modal-field" style="margin-bottom:10px;">
                <label>Remarks / Notes</label>
                <span id="modalRemarks" style="color:#64748b;font-weight:normal;font-style:italic;"></span>
            </div>
        </div>
        <div class="bqt-modal-footer">
            <button type="button" class="btn-bqt-outline" onclick="closeBookingModal();">Close</button>
            <a href="#" id="modalEditBtn" target="_blank" class="btn-bqt-primary">
                <i class="fa fa-pencil"></i> Open Booking &rarr;
            </a>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-2:+5",
        dateFormat: "dd/mm/yy"
    });

    $(".datepicker1").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-2:+5",
        dateFormat: "dd/mm/yy"
    });
});

// Navigate with filters
function showGridView() {
    var ven = $('#bq_venue').val();
    var fromdate = $('#from_date').val();
    var todate = $('#to_date').val();

    if(fromdate == "" || todate == "") {
        alert("Please select both From and To dates.");
        return;
    }

    window.location.href = "dashboard.php?fromdate=" + encodeURIComponent(fromdate) + "&todate=" + encodeURIComponent(todate) + "&ven=" + encodeURIComponent(ven);
}

// Preset Range Handlers
function applyPreset(preset) {
    var cur = "<?php echo $adtCurDt; ?>";
    var ven = $('#bq_venue').val();
    var parts = cur.split('/');
    var baseDate = new Date(parts[2], parts[1] - 1, parts[0]);

    var formatDate = function(d) {
        var dd = String(d.getDate()).padStart(2, '0');
        var mm = String(d.getMonth() + 1).padStart(2, '0');
        return dd + '/' + mm + '/' + d.getFullYear();
    };

    var fromStr = cur;
    var toStr = cur;

    if(preset === 'today') {
        fromStr = cur;
        toStr = cur;
    } else if(preset === 'tomorrow') {
        var tom = new Date(baseDate);
        tom.setDate(tom.getDate() + 1);
        fromStr = formatDate(tom);
        toStr = formatDate(tom);
    } else if(preset === '3days') {
        var end3 = new Date(baseDate);
        end3.setDate(end3.getDate() + 2);
        fromStr = cur;
        toStr = formatDate(end3);
    } else if(preset === 'week') {
        fromStr = "<?php echo date('d/m/Y', strtotime($frmW)); ?>";
        toStr = "<?php echo date('d/m/Y', strtotime($todW)); ?>";
    } else if(preset === 'month') {
        fromStr = "<?php echo date('01/m/Y', strtotime($frmM)); ?>";
        toStr = "<?php echo date('t/m/Y', strtotime($frmM)); ?>";
    }

    window.location.href = "dashboard.php?fromdate=" + encodeURIComponent(fromStr) + "&todate=" + encodeURIComponent(toStr) + "&ven=" + encodeURIComponent(ven);
}

// Step Day
function dashNext() {
    var frm = $('#from_date').val();
    if(!frm) return;
    var parts = frm.split('/');
    if(parts.length === 3) {
        var dt = new Date(parts[2], parts[1] - 1, parts[0]);
        dt.setDate(dt.getDate() + 1);
        var dd = String(dt.getDate()).padStart(2, '0');
        var mm = String(dt.getMonth() + 1).padStart(2, '0');
        var nextDate = dd + '/' + mm + '/' + dt.getFullYear();
        var ven = $('#bq_venue').val();
        window.location.href = "dashboard.php?fromdate=" + encodeURIComponent(nextDate) + "&todate=" + encodeURIComponent(nextDate) + "&ven=" + encodeURIComponent(ven);
    }
}

function dashprevious() {
    var frm = $('#from_date').val();
    if(!frm) return;
    var parts = frm.split('/');
    if(parts.length === 3) {
        var dt = new Date(parts[2], parts[1] - 1, parts[0]);
        dt.setDate(dt.getDate() - 1);
        var dd = String(dt.getDate()).padStart(2, '0');
        var mm = String(dt.getMonth() + 1).padStart(2, '0');
        var prevDate = dd + '/' + mm + '/' + dt.getFullYear();
        var ven = $('#bq_venue').val();
        window.location.href = "dashboard.php?fromdate=" + encodeURIComponent(prevDate) + "&todate=" + encodeURIComponent(prevDate) + "&ven=" + encodeURIComponent(ven);
    }
}

// Sidebar Tab Switching
function switchSidebarTab(tabName) {
    $('.bqt-tab-btn').removeClass('active');
    $('#tab-' + tabName).addClass('active');
    $('.bqt-booking-list').hide();
    $('#list-' + tabName).show();
    filterSidebarBookings();
}

// Real-time Sidebar Search Filter
function filterSidebarBookings() {
    var query = $('#bookingSearchInput').val().toLowerCase().trim();
    var activeList = $('.bqt-booking-list:visible');

    activeList.find('.bqt-booking-card').each(function() {
        var searchData = $(this).attr('data-search') || $(this).text().toLowerCase();
        if(query === "" || searchData.indexOf(query) > -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

// Open Booking Modal
function openBookingModal(data) {
    $('#modalBkNum').text('Booking #' + data.booking_no);
    $('#modalGuest').text(data.guest_name);
    $('#modalVenue').text(data.venue + ' (' + data.location + ')');
    $('#modalTiming').text(data.from_time + ' – ' + data.to_time);
    $('#modalSession').text(data.session + ' • ' + data.funct);
    $('#modalPax').text(data.guaranted + ' Pax');
    $('#modalPhone').text(data.phone);
    $('#modalRemarks').text(data.remarks && data.remarks !== '' ? data.remarks : 'No special instructions recorded.');

    var editUrl = "<?php echo $home_path; ?>/transaction/frontdesk/edit-hall-booking.php?roomBk=" + encodeURIComponent(data.booking_no) + "&rmBkID=" + encodeURIComponent(data.hallbook_id);
    $('#modalEditBtn').attr('href', editUrl);

    $('#bookingModal').css('display', 'flex');
}

function closeBookingModal(e) {
    $('#bookingModal').hide();
}
</script>

<?php include("footer.php"); ?>
</body>
</html>
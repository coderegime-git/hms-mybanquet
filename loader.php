<?php
if (!isset($home_path)) {
    $home_path = 'http://' . $_SERVER['HTTP_HOST'] . '/mybanquet';
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/loader.css">
<script type="text/javascript" src="<?php echo $home_path; ?>/js/loader.js"></script>

<!-- Global Page Loader Markup -->
<div id="global-loader-overlay">
	<div class="global-loader-box">
		<div class="global-spinner"></div>
		<div class="global-loader-text">Loading, please wait...</div>
	</div>
</div>

<!-- Centered Blue Success Modal Backdrop & Markup -->
<div id="global-success-backdrop" onclick="hideSuccessPopup()"></div>

<div id="global-success-popup">
	<div class="success-popup-header">
		<div class="success-popup-icon">
			<i class="fa fa-check"></i>
		</div>
		<div class="success-popup-title" id="success-popup-title">SUCCESS</div>
	</div>
	<div class="success-popup-body" id="success-popup-message">
		Data Saved Successfully.
	</div>
	<div class="success-popup-footer">
		<button type="button" class="success-popup-btn" onclick="hideSuccessPopup()">OK</button>
	</div>
</div>

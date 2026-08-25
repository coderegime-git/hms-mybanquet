/**
 * Global Page Loader & Notification Controller (Exact implementation from mypay)
 */
function showGlobalLoader(msg) {
	if(typeof $ !== 'undefined' && $('#global-loader-overlay').length) {
		var text = msg || 'Loading, please wait...';
		$('.global-loader-text').text(text);
		$('#global-loader-overlay').removeClass('hidden');
	}
}

function hideGlobalLoader() {
	if(typeof $ !== 'undefined' && $('#global-loader-overlay').length) {
		$('#global-loader-overlay').addClass('hidden');
	}
}

// Aliases for compatibility
function showLoader(msg) {
	showGlobalLoader(msg);
}

function hideLoader() {
	hideGlobalLoader();
}

var successPopupTimer = null;

function showSuccessPopup(message, title) {
	if (typeof $ !== 'undefined' && $('#global-success-popup').length) {
		var msgText = message || 'Data Saved Successfully.';
		$('#success-popup-message').html(msgText);
		$('#success-popup-title').text(title || 'SUCCESS');
		$('#global-success-backdrop').addClass('show');
		$('#global-success-popup').addClass('show');
		
		if (successPopupTimer) clearTimeout(successPopupTimer);
		successPopupTimer = setTimeout(function() {
			hideSuccessPopup();
		}, 3500);
	}
}

function hideSuccessPopup() {
	if (typeof $ !== 'undefined' && $('#global-success-popup').length) {
		$('#global-success-backdrop').removeClass('show');
		$('#global-success-popup').removeClass('show');
	}
}

if (typeof $ !== 'undefined') {
	$(window).on('load pageshow', function() {
		hideGlobalLoader();
	});

	$(document).ready(function() {
		setTimeout(hideGlobalLoader, 400);

		$(document).on('submit', 'form', function(e) {
			if (!e.isDefaultPrevented()) {
				showGlobalLoader('Processing, please wait...');
			}
		});

		$(document).on('click', 'a[href]', function(e) {
			var href = $(this).attr('href');
			var target = $(this).attr('target');
			var onclick = $(this).attr('onclick');

			if (href && href !== '#' && href.indexOf('javascript:') !== 0 && target !== '_blank' && (!onclick || onclick.indexOf('window.open') === -1)) {
				showGlobalLoader('Loading, please wait...');
				if (href.indexOf('-xls.php') !== -1 || href.indexOf('PDF.php') !== -1 || href.indexOf('DOC.php') !== -1) {
					setTimeout(hideGlobalLoader, 3000);
				}
			}
		});

		$(document).ajaxStart(function() {
			showGlobalLoader('Loading, please wait...');
		});
		$(document).ajaxStop(function() {
			hideGlobalLoader();
		});

		// Auto-convert any inline msgFo notification into the popup
		if ($("#msgFo").length && $("#msgFo").text().trim() !== '' && !$('#global-success-popup').hasClass('show')) {
			var inlineMsg = $("#msgFo").text().trim();
			showSuccessPopup(inlineMsg);
			$("#msgFo").hide();
		}
	});
} else {
	window.addEventListener('load', function() {
		var overlay = document.getElementById('global-loader-overlay');
		if (overlay) overlay.classList.add('hidden');
	});
}

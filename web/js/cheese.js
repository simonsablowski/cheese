function loadLibrary(url, callback) {
	var script = document.createElement('script');
	script.src = url;
	
	var head = document.getElementsByTagName('head')[0];
	var done = false;
	
	script.onload = script.onreadystatechange = function() {
		if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
			done = true;
			
			callback();
			
			script.onload = script.onreadystatechange = null;
			head.removeChild(script);
		}
	};
	
	head.appendChild(script);
}

function initializeExternalLinks() {
	$('a').filter(function() {
		return this.hostname && this.hostname !== location.hostname;
	}).addClass('external');
	
	$('a.external').click(function(event) {
		open(this.href);
		event.preventDefault();
	});
}

function initializeCheckAllLinks() {
	$('.check-all').click(function() {
		$('input[type="checkbox"]').attr('checked', $(this).is(':checked'));
	});
}

function initializeAccordeons() {
	$('.accordeon .row.divider').toggleClass('collapsed').css('cursor', 'pointer').click(function() {
		$(this).siblings(':not(.divider).' + this.id).toggle();
		$(this).toggleClass('collapsed')
		$(this).toggleClass('expanded');
	});
	$('.accordeon .row.divider.collapsed').siblings(':not(.divider)').hide();
}

function initializePopupMessages() {
	$('#message').fadeOut(5000);
}

function initializeSortables() {
	$('.sortable').sortable({
		helper: function(e, ui) {
			ui.children().each(function() {
				$(this).width($(this).width());
			});
			return ui;
		}
	}).disableSelection();
}

loadLibrary('http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js', function() {
	$(document).ready(function() {
		initializeExternalLinks();
		initializeCheckAllLinks();
		initializePopupMessages();
		//initializeAccordeons();
		//initializeSortables();
	});
});
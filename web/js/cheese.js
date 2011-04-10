$(function() {
	$('.check-all')
		.click(function() {
			$('input[type="checkbox"]').attr('checked', $(this).is(':checked'));
		});
	
	$('.accordeon .row.divider').each(function() {
		$(this).toggleClass('xxx', false);
	});
	$('.accordeon .row.divider')
		.toggleClass('collapsed')
		.css('cursor', 'pointer')
		.click(function() {
			$(this).siblings(':not(.divider).' + this.id).toggle();
			$(this).toggleClass('collapsed')
			$(this).toggleClass('expanded');
		});
	$('.accordeon .row.divider.collapsed').siblings(':not(.divider)').hide();
});
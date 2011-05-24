$(document).ready(function() {
	$('a').filter(function() {
		return this.hostname && this.hostname !== location.hostname;
	}).addClass('external');
	
	$('a.external').click(function(e) {
		open(this.href);
		e.preventDefault();
	});
	
	$('#message').fadeOut(5000);
	
	$('.check-all').click(function() {
		$('input[type="checkbox"]').attr('checked', $(this).is(':checked'));
	});
	
	$('.accordeon .row.divider').toggleClass('collapsed').css('cursor', 'pointer').click(function() {
		$(this).siblings(':not(.divider).' + this.id).toggle();
		$(this).toggleClass('collapsed')
		$(this).toggleClass('expanded');
	});
	$('.accordeon .row.divider.collapsed').siblings(':not(.divider)').hide();
});
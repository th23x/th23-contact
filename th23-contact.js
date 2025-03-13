jQuery(document).ready(function($) {

	// Descriptions: Show/ hide descriptions for input fields if focussed
	$('.th23-contact-form input, .th23-contact-form select, .th23-contact-form textarea').on('focus', function() {
		var wrap = $(this).closest('.input-wrap');
		// check if focus setting is done separately eg by theme
		if(wrap.is('.focus')) {
			return;
		}
		// set focus
		wrap.addClass('focus');
		// special handling for file dialogs - detect opening of selection dialog (click event happening after focus)
		if($(this).attr('type') == 'file') {
			$(this).click(function() {
				wrap.addClass('open');
			});
		}
		// attach blur event only to elements where focus is handled
		$(this).blur(function() {
			// special handling for file dialogs - keep focus class despite losing focus when selection dialog is open
			if(wrap.is('.open')) {
				wrap.removeClass('open');
				return;
			}
			wrap.removeClass('focus');
			$(this).off('blur click');
		})
	});

});

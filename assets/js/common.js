$(function(){
    
	$('header .menu-btn').on('click', function(){
		var menu = $(this);
		var nav = menu.parents('header').find('nav');

		if (menu.hasClass('on')) {
			menu.removeClass('on');
			nav.fadeOut('fast');
		} else {
			menu.addClass('on');
			nav.fadeIn('fast');
		}
	})
})

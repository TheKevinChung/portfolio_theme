$(function(){
	AOS.init();

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
	});

	$(window).resize(function(){
		if ($(this).width() > 780) {
			$('header nav').css('display','inline-block');
		} else {
			$('header nav').css('display','none');
		}
	});

	$(window).scroll(function(){
		if ($(window).scrollTop() > 200) {
			$('.btn-top').fadeIn();
		} else {
			$('.btn-top').fadeOut();
		}
	});

	$('.btn-top').on('click', function(){
		$('html, body').animate({
			scrollTop: '0'
		}, 300);
	});
})

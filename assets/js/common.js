var SNS = {
	facebook: function(link, title) {
		link= encodeURIComponent(link);
		title= encodeURIComponent(document.title);

		var url= 'http://www.facebook.com/share.php?u=' + link + '&t=' + title;
		window.open(url, '', 'width=526, height=500, top=100, left=200, resizable=no, scrollbars=no, status=no;');
	},
	twitter: function(link, title) {
		link= encodeURIComponent(link);
		title= encodeURIComponent(document.title);

		var url= 'http://twitter.com/share?url=' + link + '&t=' + title;
		window.open(url, '', 'width=600, height=500, top=100, left=200, resizable=no, scrollbars=no, status=no;');
	},
	pinterest: function(link, title) {
		link= encodeURIComponent(link);
		title= encodeURIComponent(document.title);

		var media= 'https://images.unsplash.com/photo-1593642634402-b0eb5e2eebc9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80'
		var url= 'http://pinterest.com/pin/create/bookmarklet/?url=' + link + '&media=' + media +'&description=' + title;
		window.open(url, '', 'menubar=no, toolbar=no, resizable=yes, scrollbars=yes, height=600, width=600, top=100, left=200');
	}
}

var snsCurrentURL= jQuery(location).attr('href');

function snsShare(type, title) {
	if (type=="twitter") {
		SNS.twitter(snsCurrentURL, title);
	}else if(type=="facebook"){
		SNS.facebook(snsCurrentURL, title);
	}else if(type=="pinterest"){
		SNS.pinterest(snsCurrentURL, title);
	}
}

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

	$('.sns-share .link-copy').on('click',function(e){
		$(this).find('.pop').fadeIn(function(){
            $(this).delay(1000).fadeOut();
		});

		e.preventDefault();
		var urlLink = window.location.href;
		var input = "<input type='text' value='"+urlLink+"' readonly style='width:1px;height:1px;position:absolute;opacity:0;'>";
		
		$(this).after(input);
		$(this).siblings('input').select(); 
		document.execCommand('copy');
	});
})

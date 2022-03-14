// menu分下げる
$(window).on('load resize', function () {
	setTimeout(function () {
		var HH = $('#header').outerHeight() || 96;
		console.log(HH);
		$('main').css('padding-top', HH);
	}, 600);
});

// レスポンシブ画像切替
$(window).on('load resize', function(){
	var width = $(window).width(),
			item = $('.rwdImg');
	if( width < 769 ){
		item.each(function(){
			$(this).attr('src', $(this).attr('src').replace('_pc','_sp'));
		})
	} else {
		item.each(function(){
			$(this).attr('src', $(this).attr('src').replace('_sp','_pc'));
		})
	}
});

$(function () {
	// scroll
	$('a[href^="#"]').click(function () {
		var navH = $('nav').outerHeight();
		var speed = 400;
		var href = $(this).attr('href');
		var target = $(href == '#' || href == '' ? 'html' : href);
		var position = target.offset().top - navH;
		$('html,body').animate({
			scrollTop: position
		}, speed, 'swing');
		return false;
	});

	// pagetop
	var topBtn = $('#pagetop');
	topBtn.hide();
	$(window).scroll(function () {
		if ($(this).scrollTop() > 200) {
			topBtn.fadeIn();
		} else {
			topBtn.fadeOut();
		}
	});
	
});
$(function () {
	// SP30 FAQ
	$('.SP30 .sec01 .a').hide();
	$('.SP30 .sec01 .q').click(function () {
		$(this).toggleClass('open');
		$(this).next().slideToggle();
	});
});
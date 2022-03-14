$(function () {
	var slide = $('.slide');
	slide.slick({
		'arrows': false,
	});
	document.querySelectorAll('.thumbnail li').forEach(function (thumbnail, i) {
		thumbnail.addEventListener('click', function () {
			slide.slick('slickGoTo', i, false);
		});
	});
	// メーターの数値取得
	$('.status .meter .scale').each(function (i) {
		const inputV = $(this).text();
		if (inputV == 0) {
			$(this).css({
				'width': '4em',
				'background-color': '#E5E5E5'
			});
		} else if (inputV < 5) {
			$(this).css('width', '4em');
		} else {
			$(this).css('width', inputV + '%');
		}
	});
	$('.aside .form button.submit').click(function () {
		// var type = $(this)[0].classList[1]
		// $('.alert.' + type).fadeIn().css({ 'display': 'flex' });
	});
	$('.close').click(function () {
		$('.alert').fadeOut();
	});
	var read = [false, false];
	$('.aside .links ul li a').each(function (i, e) {
		e.addEventListener('click', function () {
			read[i] = true;
			console.log(read)
			if (read[0] && read[1]) {
				$('input[name="agree"]').prop('checked', true);
				
				$('.submit').each(function (i, e) {
					$(e).removeClass('disabled');
				})
			}
		});
	});
});
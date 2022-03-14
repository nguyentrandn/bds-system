$(function () {
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
});
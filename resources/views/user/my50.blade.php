<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="all">
	<title>不動産クラウドファンディング「彩」丨抽選申込履歴一覧</title>
	<meta name="description" content="埼玉県をみんなで応援しよう！お金を増やしながら、まちづくりに貢献。新しいお金の運用方法　不動産クラウドファンディング">
	<meta name="keywords" content="不動産クラウドファンディング クラウドファンディング お金の運用 埼玉県 不動産 まちづくり">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-------- ogp -------->
	<meta property="og:url" content="https://XXXXXXXXX.com" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="不動産クラウドファンディング「彩」" />
	<meta property="og:description" content="埼玉県をみんなで応援しよう！お金を増やしながら、まちづくりに貢献。新しいお金の運用方法　不動産クラウドファンディング" />
	<meta property="og:site_name" content="不動産クラウドファンディング「彩」" />
	<meta property="og:image" content="/assets/img/ogp.jpg" />
	<!-------- /ogp -------->

	<!-------- favicon_icon -------->
	<link rel="shortcut icon" href="/assets/img/common/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="/assets/img/common/favicon_16.png">
    <link rel="shortcut icon" type="image/png" sizes="32x32" href="/assets/img/common/favicon_32.png">
    <link rel="shortcut icon" type="image/png" sizes="192x192" href="/assets/img/common/android-chrome-192.png">
    <link rel="shortcut icon" type="image/png" sizes="512x512" href="/assets/img/common/android-chrome-512.png">
    <link rel="sapple-touch-icon" type="image/png" sizes="180x180" href="/assets/img/common/apple-touch-icon-180.png">
	<!-------- favicon_icon -------->

	<link rel="canonical" href="https://XXXXXXXXX.com">
	<meta http-equiv="content-style-type" content="text/css">
	<meta http-equiv="content-script-type" content="text/javascript">

	<!-- css -->
	<link type="text/css" rel="stylesheet" href="/assets/css/common/reset.css">
	<link type="text/css" rel="stylesheet" href="/assets/css/common/common.css">
	<link type="text/css" rel="stylesheet" href="/assets/css/user.css">

	<!-- js -->
	<script type="text/javascript" src="/assets/js/common/jquery-3.4.1.min.js"></script>

	<!-- Jquery Toast -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"
	integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
	integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- Moment JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
	integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script type="text/javascript" src="/assets/js/common/include.js"></script>
	<script type="text/javascript" src="/assets/js/common/common.js" defer></script>
	<script type="text/javascript" src="/assets/js/user_app.js?v={{rand(10,1000)}}" defer></script>
	<script type="text/javascript" src="/assets/js/user.js" defer></script>

</head>
<body>
	<header id="header" class="member_on"></header>

	<main class="MY50">
		<div class="breadcrumbs">
			<ul itemscope itemtype="https://schema.org/BreadcrumbList">
				<!-- InstanceBeginEditable name="breadcrumbs" -->
				<li id="breadcrumbs_common" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"></li>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<meta itemprop="position" content="2" />
					<a itemprop="item" href="/my-page">
						<span itemprop="name">マイページ</span>
					</a>
				</li>
				<!-- InstanceEndEditable -->
				<li>抽選申込履歴一覧</li>
			</ul>
		</div>

		<div class="mv">
			<h2 class="pageTtl">
				抽選申込履歴一覧
			</h2>
		</div>

		<div class="inner">
			<div class="operation">
				<form id="form" name="myform" onsubmit="return false">
					<div class="wrap">
						<p class="radio">
							<span class="dataTtl">抽選ステータス</span>
							<input type="radio" name="抽選ステータス" id="type_app" value="申込" data-search-operator="=" />
							<label for="type_app">申込</label>
							<input type="radio" name="抽選ステータス" id="type_win" value="当選" data-search-operator="=" />
							<label for="type_win">当選</label>
							<input type="radio" name="抽選ステータス" id="type_lost" value="落選" data-search-operator="=" />
							<label for="type_lost">落選</label>
							<input type="radio" name="抽選ステータス" id="type_cancel" value="キャンセル" data-search-operator="="/>
							<label for="type_cancel">キャンセル</label>
						</p>
					</div>
					<div class="buttons">
						<button id="reset_form_button" type="reset" class="btn clear">クリア</button>
						<button id="search_button"  class="btn style1">検索</button>
					</div>
				</form>
			</div>
			
			<table class="infoTable" id="table_data">
				<tbody>
					<tr class="pc">
						<th>抽選ステータス</th>
						<th>申込日</th>
						<th>ファンド名</th>
						<th>申込金額<br>（申込口数）</th>
						<th>当選金額<br>（当選口数）</th>
						<th>抽選日</th>
						<th>キャンセル日</th>
						<th>申込キャンセル</th>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="alert typeCancel">
			<div class="box">
				<div class="close closeButton"></div>
				<h2>本当にキャンセルしてよろしいですか？</h2>
				<p>
					ファンド名
					<span class="item" id="cancel_fund_name"></span>
				</p>
				<div class="buttons">
					<span class="close">戻る</span>
					<span class="yes" id="confirm_cancel_application_button">はい</span>
				</div>
			</div>
		</div>
		<div class="alert yes">
			<div class="box">
				<div class="close closeButton"></div>
				<p>
					申込みをキャンセルしました
				</p>
				<span class="singleButton close">
					閉じる
				</span>
			</div>
		</div>
	</main>

	<footer id="footer"></footer>

	<script>

	function doSearch() {
		let search_conditions = getDataFromForm('form');
		loadTableData(search_conditions);
	}

	function loadTableData(conditions = []) {
		conditions.push({
			column_name: 'user_id',
			search_operator: '=',
			value: '{{$user->id}}'
		});

		/**
		 * Add loading effect
		 */
		
		$("#table_data").find("tr:gt(0)").remove();
		$('#table_data').append(`
		<tr class="in" style="border-bottom: 0.1rem solid #D6D6D6; text-align: center;">
			<td colspan="8" style="padding: 0;"><img style="width: 60px; height: 60px;" src="/assets/img/form/loading.svg" /></td>
		</tr>
		`);

		$.ajax({
				url: "/ajax/fund_application/list",
				data: JSON.stringify(conditions),
				type: 'POST',
				contentType: 'application/json',
			})
			.done(function(data) {
				let items = '';
				
				if(data.result.length === 0) {
					items+= `
						<tr class="in" style="border-bottom: 0.1rem solid #D6D6D6; text-align: center;">
							<td colspan="8";>データがありません</td>
						</tr>
						`;
				}

				data.result.forEach(function(data) {
					    var type = '';
						var tag = '';

						switch(data['抽選ステータス']) {
							case '申込': {
								type = 'typeApp';
								tag = 'yet';
								break;
							}
							case '当選': {
								type = 'winArea';
								tag = 'win';
								break;
							}
							case '落選': {
								tag = 'lost';
								break;
							}
							case 'キャンセル': {
								tag = 'cancel';
								break;
							}
						}

						items+= `
						<tr style="border-bottom: 0.1rem solid #D6D6D6;" class="${type}">
							<td class="tag ${tag}"><p>${data['抽選ステータス']}</p></td>
							<td>${data['申込日']}</td>
							<td class="name"><a target="_blank" href="${'/fund/detail?fund_id=' + data['fund_id']}">${data['ファンド名']}</a></td>
							<td>${data['申込金額']}<span>(${data['申込口数']})</span></td>
							<td>${data['当選金額']}<span>(${data['当選口数']})</span></td>
							<td>${data['抽選日']}</td>
							<td>${data['キャンセル日']}</td>
							<td>
								<button data-user-id="${data['user_id']}" data-fund-id="${data['fund_id']}" 
										data-fund-name="${data['ファンド名']}"
										class="compBtn typeCancel cancel-application-btn">キャンセル</button>
							</td>
						</tr>
						`;
				});

				$("#table_data").find("tr:gt(0)").remove();
				$('#table_data').append(items);



				/**
				 * Cacel application
				 */
				$('.cancel-application-btn').click(function() {
					let USER_ID = event.target.dataset.userId;
					let FUND_ID = event.target.dataset.fundId;
					let FUND_NAME = event.target.dataset.fundName;

					// Update fund name on poup confirm cancel.
					$('#cancel_fund_name').text(FUND_NAME);

					var type = 'typeCancel';
					$('.alert.' + type).fadeIn().css({ 'display': 'flex' });

					/**
					 * Binding save action to button.
					 */
					 
					$("#confirm_cancel_application_button").unbind("click");
					$('#confirm_cancel_application_button').click(function() {
						let btn = $(this);
						btn.addClass('disabled');

						/**
						 * Set cancel time
						 */
						
						var data = [{
								"column_name": "キャンセル日",
								"data_type": "text",
								"value": moment().format('YYYY-MM-DD hh:mm:ss'),
							},
							{
								"column_name": "抽選結果",
								"data_type": "text",
								"value": 'キャンセル',
							},
						];

						$.ajax({
								url: `/ajax/fund_application/update/${FUND_ID}/${USER_ID}`,
								data: JSON.stringify(data),
								type: 'POST',
								contentType: 'application/json',
							})
							.done(function() {
								loadTableData();

								var type = 'yes';
								$('.alert.' + type).fadeIn().css({ 'display': 'flex' });
							})
							.fail(function(error) {
								showErrorMessage(error.responseJSON);
								btn.removeClass('disabled');
							});
					});
				});
			})
			.fail(function(error) {
				showErrorMessage(error.responseJSON);
			});
	}

	$(document).ready(function() {
		loadTableData();

		/**
		 * Handle press enter key
		 */
		$(document).on('keypress', function(e) {
			if (e.which == 13) {
				doSearch();
			}
		});

		$('#reset_form_button').click(function() {
			loadTableData();
		});

		$('#search_button').click(function() {
			doSearch();
		});
	});

	// 1 json dc tra ve tu database
	var database = '{"name":"Nguyen", "age":21, "sex":"Nam"}';
	var obj = JSON.parse(database);
	console.log(obj.name);
	</script>
</body>
</html>

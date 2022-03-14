<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="all">
	<title>不動産クラウドファンディング「彩」丨投資履歴一覧</title>
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

	<script type="text/javascript" src="/assets/js/common/include.js"></script>
	<script type="text/javascript" src="/assets/js/common/common.js" defer></script>
	<script type="text/javascript" src="/assets/js/user_app.js?v={{rand(10,1000)}}" defer></script>
	<script type="text/javascript" src="/assets/js/user.js" defer></script>

	<style>
		.infoTable td.status span {
			display: inline-block;
			width: 8rem;
			height: 3rem;
			font-weight: 600;
			text-align: center;
			color: #ffffff;
			line-height: 3rem;
			padding: 0 !important;
			border-radius: 5px;
			font-size: 1.4rem;
		}
	</style>
</head>
<body>
	<header id="header" class="member_on"></header>

	<main class="MY40">
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
				<li>投資履歴一覧</li>
			</ul>
		</div>

		<div class="mv">
			<h2 class="pageTtl">
				投資履歴一覧
			</h2>
		</div>

		<div class="inner">
			<div class="operation">
				<form id="form" name="myform" onsubmit="return false">
					<div class="wrap">
						<p class="radio">
							<span class="dataTtl">入金状況</span>
							<span>
								<input type="radio" name="入金状況" id="type_not" value="未入金" data-search-operator="=">
								<label for="type_not">未入金</label>
								<input type="radio" name="入金状況" id="type_deposited" value="入金済" data-search-operator="=">
								<label for="type_deposited">入金済</label>
							</span>
						</p>
						<p class="field">
							<label class="dataTtl" for="">ファンドステータス</label>
							<select name="ファンドステータス" data-search-operator="=">
								<option value="">選択してください</option>
								<option value="申込み">申込み</option>
								<option value="抽選中">抽選中</option>
								<option value="当選">当選</option>
								<option value="落選">落選</option>
								<option value="募集中">募集中</option>
								<option value="募集終了">募集終了</option>
								<option value="成立">成立</option>
								<option value="運用中">運用中</option>
								<option value="運用終了">運用終了</option>
								<option value="不成立">不成立</option>
							</select>
						</p>
					</div>
				</form>
				<div class="buttons">
					<button id="reset_form_button" type="reset" class="btn clear">クリア</button>
					<button id="search_button"  class="btn style1">検索</button>
				</div>
			</div>
			
			<table class="infoTable" id="table_data">
				<tbody>
					<tr class="pc midashi">
						<th>入金状況</th>
						<th style="width: 150px;">申込日</th>
						<th style="width: 150px;">抽選日</th>
						<th>ファンド<br>ステータス</th>
						<th>ファンド名</th>
						<th style="width: 150px;">入金期限</th>
						<th style="width: 200px;">投資金額<br>（申込口数/総口数）</th>
					</tr>
				</tbody>
			</table>
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
			<td colspan="7" style="padding: 0;"><img style="width: 60px; height: 60px;" src="/assets/img/loading.svg" /></td>
		</tr>
		`);

		$.ajax({
				url: "/ajax/investor/list",
				data: JSON.stringify(conditions),
				type: 'POST',
				contentType: 'application/json',
			})
			.done(function(data) {

				let items = '';

				if(data.result.length === 0) {
					items+= `
						<tr class="in" style="border-bottom: 0.1rem solid #D6D6D6; text-align: center;">
							<td colspan="7";>データがありません</td>
						</tr>
						`;
				}

				data.result.forEach(function(data) {
						var tag = '';

						switch(data['入金状況']) {
							case '未入金': {
								tag = 'yet';
								break;
							}
							case '入金済': {
								tag = 'ok';
								break;
							}
							case 'キャンセル': {
								tag = 'cancel';
								break;
							}
						}

						items+= `
						<tr style="border-bottom: 0.1rem solid #D6D6D6;">
							<td class="tag ${tag}"><p>${data['入金状況']}</p></td>
							<td>${data['申込日']}</td>
							<td>${data['抽選日']}</td>
							<td class="status"><span style="background-color: ${getFundStatusColorByName(data['ファンドステータス'])};" class="fund-status-label">${data['ファンドステータス']  || '-'}</span></td>
							<td class="name"><a target="_blank" href="${'/fund/detail?fund_id=' + data['fund_id']}">${data['ファンド名']}</a></td>
							<td>${data['入金期限']}</td>
							<td>
								${data['投資金額']}
								<span>(${data['申込口数'] || '-'}/${data['当選口数'] || '-'})</span>
							</td>
						</tr>
						`;
				});

				$("#table_data").find("tr:gt(0)").remove();
				$('#table_data').append(items);
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
	</script>
</body>
</html>

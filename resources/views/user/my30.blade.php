<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="all">
	<title>不動産クラウドファンディング「彩」丨投資分配状況一覧</title>
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

	<main class="MY30">
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
				<li>投資分配状況一覧</li>
			</ul>
		</div>

		<div class="mv">
			<h2 class="pageTtl">
				投資分配状況一覧
			</h2>
		</div>

		<div class="inner">
			<div class="operation">
				<form id="form" name="myform" onsubmit="return false">
					<div class="wrap">
						<p class="radio">
							<span class="dataTtl">ステータス</span>
							<span>
								<input name="ファンドステータス" type="radio" id="type_inop" value="運用中" data-search-operator="=" />
								<label for="type_inop">運用中</label>
								<input name="ファンドステータス" type="radio" id="type_end" value="運用終了" data-search-operator="="  />
								<label for="type_end">運用終了</label>
							</span>
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
						<th>ステータス</th>
						<th>ファンド</th>
						<th>投資金額</th>
						<th>分配金合計<br>（税引前）</th>
						<th>源泉調整額</th>
						<th>分配金合計<br>（税引後）</th>
						<th>償還金合計</th>
					</tr>
				</tbody>
			</table>
			<p class="note">※税引後振込額は、分配金額（投資金額×運用利回り）より、個人の場合は税率20.42％、法人の場合は15.314%の源泉徴収後の金額と償還金合計の合計となります。</p>
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
				url: "/ajax/user/investment-distribution-status-list",
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

						items+= `
						<tr style="border-bottom: 0.1rem solid #D6D6D6;">
							<td class="status" style="text-align: center;"><span style="background-color: ${getFundStatusColorByName(data['ファンドステータス'])};" class="fund-status-label">${data['ファンドステータス']  || '-'}</span></td>
							<td><a target="_blank" href="${'/fund/detail?fund_id=' + data['fund_id']}">${data['ファンド名']}</a></td>
							<td class="price1">${data['投資金額'] || '-'}</td>
							<td class="price2">${data['分配金合計（税引前）'] || '-'}</td>
							<td class="price3">${data['源泉調整額'] || '-'}</td>
							<td class="price4">${data['分配金合計（税引後）'] || '-'}</td>
							<td class="price5">${data['償還金合計'] || '-'}</td>
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
		let params = $.queryParam();

		if( $.urlParam('fund_status') ) {
			$(`#form [name="ファンドステータス"]`).val([params.fund_status]).change();

			doSearch();
		} else {
			loadTableData();
		}

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

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="all">
	<title>不動産クラウドファンディング「彩」丨マイページ</title>
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

	<!-- font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">

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
	<script type="text/javascript" src="/assets/js/form.js?v={{rand(10,1000)}}" defer></script>
</head>
<body>
	<header id="header" class="member_on"></header>

	<main class="MY10">
		<div class="breadcrumbs">
			<ul itemscope itemtype="https://schema.org/BreadcrumbList">
				<!-- InstanceBeginEditable name="breadcrumbs" -->
				<li id="breadcrumbs_common" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"></li>
				<!-- InstanceEndEditable -->
				<li>マイページ</li>
			</ul>
		</div>

		<div class="mv">
			<h2 class="secTtl">
				マイページ
			</h2>
		</div>

		@if(!$user->identity_verification_flag)
		<div class="confirmation">
			<h2>本人確認コードの入力</h2>
			<p class="txtL">
				投資を始めるには本人確認コードの入力が必要です。<br><br>
				【本人確認方法が「はがき受け取り」の場合】<br>本人限定受取郵便をご登録の住所にお送りしています。はがきに記載のコードをご入力ください。<br><br>
				【本人確認方法が「面談」の場合】<br>面談時に本人確認コードをお渡ししています。
			</p>
			<p class="inputBox">
				<form id="input_identify_code_form">
					<label>本人確認コード<input name="code" type="text" autocomplete="" required /></label>
					<button type="submit" id="button_submit_identify_code" class="code btn style1">登録する</button>
				</form>
			</p>
		</div>
		@endif

		@if($user->identity_verification_flag && !$user->allow_investment_flag)
		<div class="confirmation">
			<h2>マイナンバーと銀行振込口座が未入力です。</h2>
			<p class="txtCenter">
				ファンドへの応募をするためには入力をする必要があります。
			</p>
			<button class="btn style1" onclick="location.href='/user/my70'">
				会員情報の編集
			</button>
		</div>
		@endif

		<div class="inner">
			<section class="message">
				<h3>
					メッセージ
				</h3>
				<div class="messageList">
					<!-- <p class="sort">
						既読のメッセージを表示する
					</p> -->
					<ul id="list_data">
						<!-- data will append to here  -->
					</ul>
				</div>
				<button id="button_view_all_message" class="btn more style1" onclick="location.href='/user/my60'">すべてのメッセージを見る</button>
			</section>

			<section class="status">
				<h3>
					資産状況
				</h3>
				<ul>
					<li>
						<p class="itemTtl">現在の投資金額</p>
						<div class="item">
							<p>¥{{number_format($current_investment_amount)}}</p>
							<a href="/user/my30?fund_status=運用中">現在の投資分配状況一覧</a>
						</div>
					</li>
					<li>
						<p class="itemTtl">累積の投資金額</p>
						<div class="item">
							<p>¥{{number_format($cumulative_investment_amount)}}</p>
							<a href="/user/my30?fund_status=運用終了">過去の投資分配状況一覧</a>
						</div>
					</li>
					<li>
						<p class="itemTtl">累積分配金額<br>（税引前）</p>
						<div class="item">
							<p>¥{{number_format($cumulative_distribution_amount_before_tax)}}</p>
							<a href="/user/my30">投資分配状況一覧</a>
						</div>
					</li>
				</ul>
			</section>

			<section class="informations">
				<h3>
					入出金履歴
				</h3>
				<button class="btn style1" onclick="location.href='/user/my20'">
					入出金履歴一覧
				</button>
			</section>

			<section class="informations">
				<h3>
					取引履歴
				</h3>
				<div class="btnWrap">
					<button class="btn style1" onclick="location.href='/user/my30'">
						投資分配状況一覧
					</button>
					<button class="btn style1" onclick="location.href='/user/my40'">
						投資履歴一覧
					</button>
					<button class="btn style1" onclick="location.href='/user/my50'">
						抽選申し込み履歴一覧
					</button>
				</div>
			</section>

			<section class="informations">
				<h3>
					会員情報
				</h3>

				@if(!$user->identity_verification_flag)
				<button class="btn style3">
					会員情報の編集
				</button>
				<p class="redTxt">※本人確認コード入力後、編集できます</p>
				@else
				<button class="btn style1" onclick="location.href='/profile'">
					会員情報の編集
				</button>
				@endif
			</section>
		</div>

		@if(!$user->identity_verification_flag)
		<!-- popup input identify code success -->
		<div class="alert code">
			<div class="box">
				<div class="close closeButton" onclick="'{{request()->get('redirect_url')}}' ? window.location.assign('{{request()->get('redirect_url')}}') : location.reload();"></div>
				<p>
					本人確認コードを確認しました
				</p>
				<span class="singleButton close" onclick="'{{request()->get('redirect_url')}}' ? window.location.assign('{{request()->get('redirect_url')}}') : location.reload();">
					閉じる
				</span>
			</div>
		</div>
		<!-- popup input identify code success -->
		@endif

	</main>

	<footer id="footer"></footer>
	
	<script>
	function loadUserMessages(conditions = []) {
		conditions.push({
			column_name: 'user_id',
			search_operator: '=',
			value: ['all', '{{$user->id}}']
		});

		/**
		 * Add loading effect
		 */
		$("#list_data").find("li").remove();
		$('#list_data').append(`
			<li style="text-align: center;">
				<img style="width: 60px; height: 60px;" src="/assets/img/loading.svg" />
			</li>
		`);

		$.ajax({
				url: "/ajax/user/message-list",
				data: JSON.stringify(conditions),
				type: 'POST',
				contentType: 'application/json',
			})
			.done(function(data) {

				let items = '';

				if(data.result.length === 0) {
					items+= `
						<li style="text-align: center;">
							データがありません
						</li>
						`;

					$('#button_view_all_message').hide();
				}

				// Get top 03 elements only.
				data.result = data.result.slice(0, 3);

				data.result.forEach(function(data) {
						var tag = '';
						var visited = '';
						var fund_id = '';

						// Check is direct message or not.
						if(data['message_type'] == 'user_message') {
							tag = 'dm';
						}

						// Check is read message or not
						if(data['is_read'] == 1) {
							visited = 'visited';
						}

						items+= `
						<li class="${visited} ${tag}">
							<a href="/user/my61?message_id=${data['id']}&message_type=${data['message_type']}">
								<span class="date">${data['送信日時']}</span>
								<span class="ttl">${data['タイトル']}</span>
							</a>
						</li>
						`;
				});

				$("#list_data").find("li").remove();
				$('#list_data').append(items);
			})
			.fail(function(error) {
				showErrorMessage(error.responseJSON);
			});
	}

	$(document).ready(function() {
		loadUserMessages();
	});
	</script>
</body>
</html>

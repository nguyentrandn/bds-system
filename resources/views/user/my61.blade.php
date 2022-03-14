<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="all">
	<title>不動産クラウドファンディング「彩」丨メッセージ詳細</title>
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
	<script type="text/javascript" src="/assets/js/common/include.js"></script>
	<script type="text/javascript" src="/assets/js/common/common.js" defer></script>
	<script type="text/javascript" src="/assets/js/user.js" defer></script>

</head>
<body>
	@php
		function formatJPDatetime($time) {
			$date = \Carbon\Carbon::parse($time);
			return $date->format('Y年m月d日 H:i');
		}
	@endphp


	<header id="header" class="member_on"></header>

	<main class="MY61">
		@if(isset($params['is_notice_detail_page']) && $params['is_notice_detail_page'])
		<div class="breadcrumbs">
			<ul itemscope itemtype="https://schema.org/BreadcrumbList">
				<!-- InstanceBeginEditable name="breadcrumbs" -->
				<li id="breadcrumbs_common" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"></li>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<meta itemprop="position" content="2" />
					<a itemprop="item" href="/notice">
						<span itemprop="name">新着情報</span>
					</a>
				</li>
				<!-- InstanceEndEditable -->
				<li>{{$params['message']['タイトル']}}</li>
			</ul>
		</div>
		@else 
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
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<meta itemprop="position" content="3" />
					<a itemprop="item" href="/user/my60">
						<span itemprop="name">メッセージ一覧</span>
					</a>
				</li>
				<!-- InstanceEndEditable -->
				<li>メッセージ詳細</li>
			</ul>
		</div>
		@endif

		<div class="inner">
			<section>
				<h3>
					{{$params['message']['タイトル']}}
					<span class="data">{{formatJPDatetime($params['message']['送信日時'])}}</span>
				</h3>
				<div class="contentsBody">
					<p style="white-space: pre-line;">
						{{$params['message']['本文']}}
					</p>
				</div>

				<p class="attachment">
					@foreach( $params['message_attachments'] as $key => $item )
					@if($key == 0)
					<span>添付：</span>
					@else 
					<span style="width: 50px; display: inline-block;"></span>
					@endif

					<a style="padding-top: 10px;display: inline-block;" target="_blank" href="{{$item->url}}">{{$item->name}}</a> <br/>
					@endforeach
				</p>
			</section>
		</div>
		
		@if(isset($params['is_notice_detail_page']) && !$params['is_notice_detail_page'])
		<button class="btn style1" onclick="location.href='/user/my60'">メッセージ一覧へ戻る</button>
		@endif
	</main>

	<footer id="footer"></footer>
</body>
</html>

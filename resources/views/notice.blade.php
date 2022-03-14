<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="all">
	<title>不動産クラウドファンディング「彩」丨メッセージ一覧</title>
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

</head>
<body>
	<header id="header" class="member_on"></header>

	<main class="MY60">
		<div class="breadcrumbs">
			<ul itemscope itemtype="https://schema.org/BreadcrumbList">
				<!-- InstanceBeginEditable name="breadcrumbs" -->
				<li id="breadcrumbs_common" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"></li>
				<!-- InstanceEndEditable -->
				<li>新着情報</li>
			</ul>
		</div>

		<div class="inner">
			<section class="message">
				<h3>
                新着情報
				</h3>
				<div class="messageList">
					<ul id="list_data">
                        @foreach( $notices->slice(0, 3) as $item)
						<li>
                            <a href="/notice/detail?notice_id={{$item->id}}">
                                <span class="date">{{$item->公開期間_from}}</span>
                                <span class="ttl">{{$item->タイトル}}</span>
                            </a>
						</li>
						@endforeach
					</ul>
				</div>
			</section>

			@if(false)
			<section class="pagination">
				<a href="" class="arrow prev">
					◀
				</a>
				<ol>
					<li class="current">
						<a href="">
							1
						</a>
					</li>
					<li>
						<a href="">
							2
						</a>
					</li>
					<li>
						<a href="">
							3
						</a>
					</li>
					<li>
						<a href="">
							4
						</a>
					</li>
					<li>
						<a href="">
							5
						</a>
					</li>
					<li>
						...
					</li>
				</ol>
				<a href="" class="arrow next">
					▶
				</a>
			</section>
			@endif
		</div>
	</main>

	<footer id="footer"></footer>
</body>
</html>

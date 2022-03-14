<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="all">
	<title>不動産クラウドファンディング「彩」丨ファンド一覧</title>
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
	<link type="text/css" rel="stylesheet" href="/assets/css/fund/fu10.css">

	<!-- js -->
	<script type="text/javascript" src="/assets/js/common/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="https://pagination.js.org/dist/2.1.5/pagination.min.js"></script>
	<script type="text/javascript" src="/assets/js/common/include.js"></script>
	<script type="text/javascript" src="/assets/js/common/common.js" defer></script>
	<script type="text/javascript" src="/assets/js/fund.js" defer></script>

</head>
<body>
	<header id="header" class="member_none"></header><!-- classでスイッチ　member_on member_none -->

	<main class="FU10">
		<div class="breadcrumbs">
			<ul itemscope itemtype="https://schema.org/BreadcrumbList">
				<!-- InstanceBeginEditable name="breadcrumbs" -->
				<li id="breadcrumbs_common" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"></li>
				<!-- InstanceEndEditable -->
				<li>ファンド一覧</li>
			</ul>
		</div>
		<div class="mv">
			<div class="inner">
				<h1 class="mincho">
					ファンド一覧
				</h1>
			</div>
		</div>
		<div class="search">
			<form id="fu10_form">
				<div class="operation">
					<div class="wrap">
						<p class="check">
							<span class="dataTtl">ステータス</span>
							<span>
								<input {{ in_array('募集前', request()->get('ファンドステータス') ?? []) ? 'checked' : ''}} name="ファンドステータス[]" type="checkbox" value="募集前" name="checkbox02" id="type_underR">
								<label for="type_underR" class="checkbox02">募集前</label>

								<br class="sp">
								<input {{ in_array('運用中', request()->get('ファンドステータス') ?? []) ? 'checked' : ''}}  name="ファンドステータス[]" type="checkbox" value="運用中" name="checkbox02" id="type_inop">
								<label for="type_inop" class="checkbox02">運用中</label>

								<input {{ in_array('運用終了', request()->get('ファンドステータス') ?? []) ? 'checked' : ''}}  name="ファンドステータス[]" type="checkbox" value="運用終了" name="checkbox02" id="type_end">
								<label for="type_end" class="checkbox02">運用終了</label>
							</span>
						</p>
					</div>
					<div class="buttons">
						<button onclick="$('#fu10_form').prop('checked', false);" class="btn clear">クリア</button>
						<button type="submit" class="btn style1">検索</button>
					</div>
				</div>
			</form>
		</div>

		<section class="list">
			<ul>
				@foreach( $items as $item)
				<li data-status="{{$item->ui_list_data_status}}">
					<div class="img">
						<a class="more" href="/fund/detail?fund_id={{$item->id}}"><img src="{{$item->メイン画像}}" alt=""></a>
						<div class="label">
						</div>
					</div>
					<div class="text">

						@if(in_array($item->ファンドステータス, ['募集前']))
						<div class="status">
							<p class="premiere"><span>{{$item->募集開始予定}}</span>　募集開始予定</p>
							<p class="meter"><span class="scale"></span></p>
						</div>
						@endif 

						@if(in_array($item->ファンドステータス, ['募集中', '運用中', '運用終了']))
						<div class="status">
							<p class="meter"><span class="scale" style="width: {{$item->reach_percent}}%;">{{$item->reach_percent}}</span></p>
						</div>
						@endif

						<div class="row">
							<h2>
								{{$item->ファンド名}}
							</h2>
						</div>
						<div class="row nums">
							<dl>
								<dt>
									予定分配率<br>(年利)
								</dt>
								<dd>
									<span class="num">{{$item->予定分配率}}</span><span class="unit">%</span>
								</dd>
							</dl>
							<dl>
								<dt>
									運用期間
								</dt>
								<dd>
									<span class="num">{{$item->運用期間}}</span><span class="unit">ヶ月</span>
								</dd>
							</dl>
						</div>
						<dl class="row">
							<dt>
								募集金額
							</dt>
							<dd>
								{{$item->募集金額}}円
							</dd>
						</dl>
						<dl class="row">
							<dt>
								募集単位
							</dt>
							<dd>
								{{$item->投資単位（1口）}}万/口(最低{{$item->一人あたり投資可能口数_from}}口から)
							</dd>
						</dl>
						<dl class="row">
							<dt>
								応募金額
							</dt>
							<dd>
								{{number_format($item->応募金額 * $item->投資単位（1口）)}}円
							</dd>
						</dl>
						<a class="more" href="/fund/detail?fund_id={{$item->id}}">
							詳細
						</a>
					</div>
				</li>
				@endforeach
			</ul>
		</section>
		<section id="demo"></section>
		<section class="pagination">
			<a class="arrow prev">
				◀
			</a>
			<ol>
			@foreach( $paginations as $value)
				<li>
					<a href="?page={{$value}}">
						{{$value}}
					</a>
				</li>
            @endforeach
			</ol>
			<a class="arrow next">
				▶
			</a>
		</section>
	</main>

	<footer id="footer"></footer>
</body>
</html>

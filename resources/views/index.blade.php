<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="all">
	<title>不動産クラウドファンディング「彩」</title>
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
	<link type="text/css" rel="stylesheet" href="/assets/css/tp10.css">

	<!-- js -->
	<script type="text/javascript" src="/assets/js/common/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="/assets/js/common/include.js"></script>
	<script type="text/javascript" src="/assets/js/common/common.js" defer></script>
	<script type="text/javascript" src="/assets/js/tp10.js" defer></script>

	<style>
		.secBody .list .pic {
			height: 335px;
			overflow: hidden;
		}
	</style>
</head>
<body>
	<header id="header" class="member_none"></header><!-- classでスイッチ　member_on member_none -->
	<main>
		<div class="mv">
			<h2 class="pageTtl">
				<span>埼玉県をみんなで応援しよう！</span>
				お金を増やしながら<span class="inline-pc" style="font-family: 'ヒラギノ明朝 ProN W3', 'HiraMinProN-W3', 'HG明朝E', 'ＭＳ Ｐ明朝', 'MS PMincho', 'MS 明朝', serif;">、</span><br class="sp">まちづくりに貢献
			</h2>
			<p class="lead">新しいお金の運用方法<span class="inline-pc">　</span><br class="sp">不動産クラウドファンディング</p>
		</div>
		
		<div class="inner">
			<section class="sec01">
				<h3 class="secTtl">
					新着ファンド
					<span>New Fund Offers</span>
				</h3>
				<div class="secBody">
					<ul class="list">
						@foreach( $items->slice(0, 3) as $item)
						<li data-status="{{$item->ui_list_data_status}}">
							<a class="pic" href="/fund/detail?fund_id={{$item->id}}"><img src="{{$item->メイン画像}}" alt="{{$item->ファンド名}}"></a>
							<dl>
								<dt>{{$item->ファンド名}}</dt>
								<dd>
									<div>
										<div class="rate">
											<p>予定分配率</p>
											<p><span>{{$item->予定分配率}}</span> ％</p>
										</div>
										<div class="period">
											<p>運用期間</p>
											<p><span>{{$item->運用期間}}</span> ヶ月</p>
										</div>
									</div>
									<div>
										<div class="recruitment">
											<p>募集金額</p>
											<p><span>{{$item->募集金額}}</span> 円</p>
										</div>
										<div class="mininvestment">
											<p>最低投資額</p>
											<p><span>{{number_format($item->一人あたり投資可能口数_from * $item->投資単位（1口）)}}</span> 円</p>
										</div>
									</div>
									<div>
										<div class="subscription">
											<p>応募金額</p>
											<p><span>{{number_format($item->応募金額 * $item->投資単位（1口）)}}</span> 円</p>
										</div>
										<div class="remaining">
											<p>残り</p>
											@if(is_numeric($item->残り日数))
											<p><span>{{$item->残り日数}}</span> 日</p>
											@else
											<p>{{$item->残り日数}}</p>
											@endif
										</div>
									</div>
								</dd>

								@if(in_array($item->ファンドステータス, ['募集前']))
								<dd class="status">
									<p class="premiere"><span>{{$item->募集開始予定}}</span>　募集開始予定</p>
									<p class="meter"><span class="scale"></span></p>
								</dd>
								@endif 

								@if(in_array($item->ファンドステータス, ['募集中', '運用中', '運用終了']))
								<dd class="status">
									<p class="meter"><span class="scale" style="width: {{$item->reach_percent}}%;">{{$item->reach_percent}}</span></p>
								</dd>
								@endif
							</dl>
						</li>
						@endforeach
					</ul>
				</div>
				<button class="btn style1" onclick="location.href='/fund'">全てのファンドを見る</button>
			</section>

			<section class="sec02">
				<h3 class="secTtl">
					彩 -sai- 不動産クラウド<br class="sp">ファンディング とは？
					<span>About</span>
				</h3>
				<div class="secBody">
					<div class="box1">
						<p class="pic"><img src="/assets/img/tp10/sec02_img1.png" alt="イメージ画像"></p>
						<dl>
							<dt>埼玉県内に特化した<br class="pc">不動産投資クラウドファンディングサイトです。</dt>
							<dd>不動産の安定した賃貸収益を分配し、定期預金より高金利でお金を運用いたします。扱う物件は埼玉県内の不動産。投資で利益を得ながら、埼玉県のまちづくりに貢献しませんか？</dd>
						</dl>
					</div>
					<ul class="box2">
						<li>
							<p class="pic"><img src="/assets/img/tp10/sec02_img2.png" alt="イメージ画像"></p>
							<dl>
								<dt>リスクを抑えて投資<br class="pc">ができる</dt>
								<dd>日々の価格変動が少なく、元本の安全性が高い一方、定期預金に預けるよりも高金利で運用できます。</dd>
							</dl>
						</li>
						<li>
							<p class="pic"><img src="/assets/img/tp10/sec02_img3.png" alt="イメージ画像"></p>
							<dl>
								<dt>少額から始められる</dt>
								<dd>１口10万円で3口から投資が可能。年に一回は定期預金と同じようにお引き出しが可能です。</dd>
							</dl>
						</li>
						<li>
							<p class="pic"><img src="/assets/img/tp10/sec02_img4.png" alt="イメージ画像"></p>
							<dl>
								<dt>埼玉県のまちづくりに貢献</dt>
								<dd>扱う物件は、埼玉県内の不動産に特化しています。投資をしながら埼玉県を応援しませんか？</dd>
							</dl>
						</li>
						<li>
							<p class="pic"><img src="/assets/img/tp10/sec02_img5.png" alt="イメージ画像"></p>
							<dl>
								<dt>安心・手軽</dt>
								<dd>彩-SAI-では、本人限定受取郵便またはご面談での本人確認を行っているため、書類をアップロードして頂く必要はありません。</dd>
							</dl>
						</li>
					</ul>
				</div>
				<button class="btn style1" onclick="location.href='/sp10'">不動産クラウドファンディングとは？</button>
			</section>

			<section class="sec03">
				<h3 class="secTtl">
					ご利用の流れ
					<span>Flow</span>
				</h3>
				<div class="secBody">
					<ul>
						<li>
							<p class="stepNum">1</p>
							<p class="txt">
								無料会員登録
							</p>
							<p class="pic"><img src="/assets/img/tp10/sec03_img1.png" alt="イメージ画像"></p>
						</li>
						<li>
							<p class="stepNum">2</p>
							<p class="txt">
								無料会員登録
								<span class="note">本人限定受取郵便 または<br>ご面談でのご確認</span>
							</p>
							<p class="pic"><img src="/assets/img/tp10/sec03_img2.png" alt="イメージ画像"></p>
						</li>
						<li>
							<p class="stepNum">3</p>
							<p class="txt">
								本人確認コードを<br>マイページから入力
							</p>
							<p class="pic"><img src="/assets/img/tp10/sec03_img3.png" alt="イメージ画像"></p>
						</li>
						<li>
							<p class="stepNum">4</p>
							<p class="txt">
								ファンドへの申込み<br>運用開始
							</p>
							<p class="pic"><img src="/assets/img/tp10/sec03_img4.png" alt="イメージ画像"></p>
						</li>
					</ul>
				</div>
				<button class="btn style1" onclick="location.href='/sp20'">ご利用の流れを詳しく見る</button>
			</section>

			<section class="sec04">
				<h3 class="secTtl">
					新着情報
					<span>News</span>
				</h3>
				<div class="secBody">
					<ul>
						@foreach( $notices->slice(0, 3) as $item)
						<li>
							<p class="day">{{$item->公開期間_from}}</p>
							<p class="ttl"><a href="/notice/detail?notice_id={{$item->id}}">{{$item->タイトル}}</a></p>
						</li>
						@endforeach
					</ul>
				</div>
				<button class="btn style1" onclick="location.href='/notice'">すべてのお知らせを見る</button>
			</section>
		</div>
	</main>

	<footer id="footer"></footer>
</body>
</html>

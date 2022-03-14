<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="all">
	<title>{{$fund->ファンド名}}丨ファンド詳細</title>
	<meta name="description" content="埼玉県をみんなで応援しよう！お金を増やしながら、まちづくりに貢献。新しいお金の運用方法　不動産クラウドファンディング">
	<meta name="keywords" content="不動産クラウドファンディング クラウドファンディング お金の運用 埼玉県 不動産 まちづくり">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-------- ogp -------->
	<meta property="og:url" content="https://XXXXXXXXX.com" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="{{$fund->ファンド名}}" />
	<meta property="og:description" content="埼玉県をみんなで応援しよう！お金を増やしながら、まちづくりに貢献。新しいお金の運用方法　不動産クラウドファンディング" />
	<meta property="og:site_name" content="{{$fund->ファンド名}}" />
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link type="text/css" rel="stylesheet" href="/assets/css/fund/fu20.css">

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
	<script type="text/javascript" src="/assets/js/fund.js" defer></script>

	<script type="text/javascript" src="/assets/js/user_app.js?v={{rand(10,1000)}}" defer></script>
	<script type="text/javascript" src="/assets/js/form.js?v={{rand(10,1000)}}" defer></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<style>
		ul.thumbnail  img {
			height: 100% !important;
			min-width: 123px;
			padding-right: 10px;
		}
	</style>
</head>
<body>
	<header id="header" class="member_none"></header><!-- classでスイッチ　member_on member_none -->

	@php
		function formatJPDate($time) {
			$date = \Carbon\Carbon::parse($time);
			return $date->format('Y年m月d日');
		}

		function formatJPTime($time) {
			$date = \Carbon\Carbon::parse($time);
			return $date->format('H:i');
		}

		function formatJPDatetime($time) {
			$date = \Carbon\Carbon::parse($time);
			return $date->format('Y年m月d日 H:i');
		}
	@endphp

	<main class="FU10">
		<div class="breadcrumbs">
			<ul itemscope itemtype="https://schema.org/BreadcrumbList">
				<!-- InstanceBeginEditable name="breadcrumbs" -->
				<li id="breadcrumbs_common" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"></li>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<meta itemprop="position" content="2" />
					<a itemprop="item" href="/fund">
						<span itemprop="name">ファンド一覧</span>
					</a>
				</li>
				<!-- InstanceEndEditable -->
				<li>{{$fund->ファンド名}}</li>
			</ul>
		</div>
		<div class="mv">
			<div class="inner">
				<h1 class="mincho">
					{{$fund->ファンド名}}
				</h1>
			</div>
		</div>
		<div class="content">
			<div class="main">
				<section class="img">
					<ul class="slide">
						@if($fund->メイン画像)
						<li>
							<img src="{{$fund->メイン画像}}" alt="">
						</li>
						@endif

						@if($fund->サブ画像_1)
						<li>
							<img src="{{$fund->サブ画像_1}}" alt="">
						</li>
						@endif

						@if($fund->サブ画像_2)
						<li>
							<img src="{{$fund->サブ画像_2}}" alt="">
						</li>
						@endif

						@if($fund->サブ画像_3)
						<li>
							<img src="{{$fund->サブ画像_3}}" alt="">
						</li>
						@endif

						@if($fund->サブ画像_4)
						<li>
							<img src="{{$fund->サブ画像_4}}" alt="">
						</li>
						@endif

						@if($fund->サブ画像_5)
						<li>
							<img src="{{$fund->サブ画像_5}}" alt="">
						</li>
						@endif
					</ul>
					<ul class="thumbnail" style="overflow: hidden;">
						@if($fund->メイン画像)
						<li>
							<img src="{{$fund->メイン画像}}" alt="">
						</li>
						@endif

						@if($fund->サブ画像_1)
						<li>
							<img src="{{$fund->サブ画像_1}}" alt="">
						</li>
						@endif

						@if($fund->サブ画像_2)
						<li>
							<img src="{{$fund->サブ画像_2}}" alt="">
						</li>
						@endif

						@if($fund->サブ画像_3)
						<li>
							<img src="{{$fund->サブ画像_3}}" alt="">
						</li>
						@endif

						@if($fund->サブ画像_4)
						<li>
							<img src="{{$fund->サブ画像_4}}" alt="">
						</li>
						@endif

						@if($fund->サブ画像_5)
						<li>
							<img src="{{$fund->サブ画像_5}}" alt="">
						</li>
						@endif
					</ul>
				</section>
				<section class="text">
					<input type="radio" name="tab" id="tab1" checked>
					<input type="radio" name="tab" id="tab2">
					<input type="radio" name="tab" id="tab3">
					<input type="radio" name="tab" id="tab4">
					<input type="radio" name="tab" id="tab5">
					<input type="radio" name="tab" id="tab6">
					<div class="tabs">
						<label for="tab1">
							物件
						</label>
						<label for="tab2">
							物件詳細
						</label>
						<label for="tab3">
							想定収支<br>スキーム
						</label>
						<label for="tab4">
							リスク
						</label>
						<label for="tab5">
							営業者
						</label>
						<label for="tab6">
							FAQ
						</label>
					</div>
					<div class="contents">
						<div class="tab summary">
							<img src="{{$fund->チラシ画像}}" alt="">
						</div>
						<div class="tab property">
							<h3>
								物件概要
							</h3>
							<dl>
								<dt>
									物件名称
								</dt>
								<dd>
									{{$fund->物件名称}}
								</dd>
								<dt>
									所在地
								</dt>
								<dd>
									{{$fund->所在地}}
								</dd>
								<dt>
									交通
								</dt>
								<dd>
									{{$fund->交通}}
								</dd>
							</dl>
							<div class="map">
								@if($fund->交通)
								<iframe src="{{$fund->交通}}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
								@endif
							</div>
							<h3>
								土地
							</h3>
							<dl>
								<dt>
									地目
								</dt>
								<dd>
									{{$fund->地目}}
								</dd>
								<dt>
									面積
								</dt>
								<dd>
									{{$fund->面積}}
								</dd>
								<dt>
									権利
								</dt>
								<dd>
									{{$fund->権利}}
								</dd>
							</dl>
							<h3>
								建物
							</h3>
							<dl>
								<dt>
									構造
								</dt>
								<dd>
									{{$fund->構造}}
								</dd>
								<dt>
									床面積
								</dt>
								<dd>
									{{$fund->床面積}}
								</dd>
								<dt>
									築年月
								</dt>
								<dd>
									{{$fund->築年月}}
								</dd>
							</dl>
							<h3>
								法令
							</h3>
							<dl>
								<dt>
									用途地域
								</dt>
								<dd>
									{{$fund->用途地域}}
								</dd>
								<dt>
									建ぺい率
								</dt>
								<dd>
									{{$fund->建ぺい率}}
								</dd>
								<dt>
									容積率
								</dt>
								<dd>
									{{$fund->容積率}}
								</dd>
							</dl>
							<h3>
								賃貸借契約の概要
							</h3>
							<dl>
								<dt>
									貸主
								</dt>
								<dd>
									{{$fund->容積率}}
								</dd>
								<dt>
									借主
								</dt>
								<dd>
									{{$fund->容積率}}
								</dd>
								<dt>
									契約形態
								</dt>
								<dd>
									{{$fund->容積率}}
								</dd>
								<dt>
									現契約期間
								</dt>
								<dd>
									{{formatJPDate($fund->現契約期間_from)}} ~ {{formatJPDate($fund->現契約期間_to)}}
								</dd>
								<dt>
									賃料月額
								</dt>
								<dd>
									{{$fund->賃料月額}}
								</dd>
								<dt>
									敷金
								</dt>
								<dd>
									{{$fund->敷金}}
								</dd>
								<dt>
									契約更改の方法
								</dt>
								<dd>
									{{$fund->契約更改の方法}}
								</dd>
								<dt>
									その他重要な事項
								</dt>
								<dd>
									{{$fund->その他重要な事項}}
								</dd>
							</dl>
						</div>
						<div class="tab scheme">
							<h3>
								出資金の内訳
							</h3>
							<table>
								<tbody>
									<tr>
										<th colspan="2">建物</th>
									</tr>
									<tr>
										<td>物件価格</td>
										<td>{{number_format($fund->物件価格)}}円</td>
									</tr>
									<tr>
										<td>出資総額</td>
										<td>{{number_format($fund->出資総額)}}円</td>
									</tr>
									<tr>
										<td>募集金額</td>
										<td>{{number_format($fund->募集金額)}}円</td>
									</tr>
									<tr>
										<td>劣後出資額</td>
										<td>{{number_format($fund->劣後出資額)}}円</td>
									</tr>
								</tbody>
							</table>
							<h3>
								想定収支　（※運用期間中の想定数値）
							</h3>
							<table>
								<tbody>
									<tr>
										<th>項目</th>
										<th colspan="2">契約期間（半年間）の収支</th>
									</tr>
									<tr>
										<td rowspan="2">収入</td>
										<td>賃料収入</td>
										<td>{{number_format($fund->賃料収入)}}円</td>
									</tr>
									<tr>
										<td>合計①</td>
										<td>{{number_format($fund->賃料収入)}}円</td>
									</tr>
									<tr>
										<td rowspan="7">支出</td>
										<td>維持管理費</td>
										<td>{{number_format($fund->維持管理費)}}円</td>
									</tr>
									<tr>
										<td>修繕積立会</td>
										<td>{{number_format($fund->修繕積立会)}}円</td>
									</tr>
									<tr>
										<td>公租公課</td>
										<td>{{number_format($fund->公租公課)}}円</td>
									</tr>
									<tr>
										<td>火災保険料</td>
										<td>{{number_format($fund->火災保険料)}}円</td>
									</tr>
									<tr>
										<td>PMフィー</td>
										<td>{{number_format($fund->PMフィー)}}円</td>
									</tr>
									<tr>
										<td>税理士報酬</td>
										<td>{{number_format($fund->税理士報酬)}}円</td>
									</tr>
									<tr>
										<td>その他</td>
										<td>{{number_format($fund->その他)}}円</td>
									</tr>
									<tr>
										<td>合計②</td>
										<td colspan="2">{{number_format($fund->合計)}}円</td>
									</tr>
									<tr>
										<td>分配原資</td>
										<td>①ー②</td>
										<td>{{number_format($fund->分配原資)}}円</td>
									</tr>
								</tbody>
							</table>
							<h3>
								分配金の内訳
							</h3>
							<table>
								<tbody>
									<tr>
										<th colspan="3">分配金の内訳</th>
									</tr>
									<tr>
										<td colspan="2">分配原資</td>
										<td>{{number_format($fund->分配原資)}}円</td>
									</tr>
									<tr>
										<td rowspan="2">優先支出分配金（お客様）</td>
										<td>全体336口</td>
										<td>{{number_format($fund->全体口数)}}円</td>
									</tr>
									<tr>
										<td>1口あたり</td>
										<td>{{number_format($fund['1口あたり'])}}円</td>
									</tr>
									<tr>
										<td colspan="2">劣後出資分配金（営業者）</td>
										<td>{{number_format($fund->劣後出資分配金（営業者）)}}円</td>
									</tr>
								</tbody>
							</table>
							<p>
								※実際にお客様にお支払いする分配金は、源泉徴収税20.42%（所得税＋復興特別所得税）を控除した金額となります。
							</p>
							<h3>
								スキーム図（例）
							</h3>
							<p>
								割合はかわることがあります
							</p>
							<img src="/assets/img/fund/scheme_01.png" alt="">
							<img src="/assets/img/fund/scheme_02.png" alt="">
						</div>
						<div class="tab risk">
							<h3>
								1. 出資金の元本割れリスク
							</h3>
							<p>
								本商品は、投資家の皆様の出資金について元本保証をするものではありません。本商品の収益性、利益の配当や財産の分配も保証されたものではない為、以下に記載の各リスクのほか、「契約成立前書面」に記載したリスクにより投資家の出資金について元本が損失するおそれがあります。
							</p>
							<h3>
								2. 本事業者の信用リスク
							</h3>
							<p>
								本事業者が破綻等したことにより事業継続が困難となった場合、本契約は終了します。匿名組合勘定による分別管理は信託法第34条の分別管理と異なり、本事業者が破綻等した場合には、保全されないので、出資金全額が返還されないおそれがあります。
							</p>
							<h3>
								3. 不動産のリスク
							</h3>
							<p>
								経済環境や不動産需給関係の影響あるいは、頭書物件の価値の毀損によっては、運用期間中において空室が発生する場合があるほか、頭書物件を想定する時期･条件で売却できず、収益に悪影響を与えるおそれがあります。
							</p>
							<h3>
								4. その他のリスク
							</h3>
							<p>
								以下の事象等により不動産価格が減少または当該不動産に付随する支払が増大し、元本割れするリスクがございます。<br>
								<br>
								・法令、税制及び政府による規制変更によるリスク<br>
								・自然災害、人為的災害により不動産が滅失・毀損・劣化するリスク<br>
								・経年劣化、隠れたる瑕疵の発見などによる不動産的価値の下落による環境リスク<br>
								・本不動産の工作物などが第三者に損害を与える場合には、本不動産の所有者として損害賠償義務を負担する可能性あるリスク<br>
								・本契約の解除又は譲渡に制限があることに関するリスク<br>
								・匿名組合員は営業に関する指図ができないことに関するリスク
							</p>
						</div>
						<div class="tab sales">
							<table>
								<tbody>
									<tr>
										<th>商号</th>
										<td>{{$fund->商号}}</td>
									</tr>
									<tr>
										<th>登録</th>
										<td style="white-space: pre-line;">{{$fund->登録}}</td>
									</tr>
									<tr>
										<th>所在地</th>
										<td>{{$fund->所在地}}</td>
									</tr>
									<tr>
										<th>代表者</th>
										<td>{{$fund->代表者}}</td>
									</tr>
									<tr>
										<th>電話番号</th>
										<td>{{$fund->電話番号}}</td>
									</tr>
									<tr>
										<th>主な事業</th>
										<td>{{$fund->主な事業}}</td>
									</tr>
									<tr>
										<th>資本金</th>
										<td>{{$fund->資本金}}</td>
									</tr>
									<tr>
										<th>設立日</th>
										<td>{{$fund->設立日}}</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tab faq">
							<ul>
								<li>
									<h3>
										出資金はいつ振り込めばいいでしょうか？
									</h3>
									<div class="answer">
										<p>
											募集終了日の翌日にメールにて通知される結果において「当選」が確定してからのご入金をお願いします。 （抽選結果通知前の出資金のお預かりはしておりません。もし誤って先に出資金をお振込みいただいた場合は、ご登録口座へご返金させていただきます。その際の振込手数料はお客様負担となります。また処理の都合上、ご返金までに数日お時間がかかる場合がございますので予めご了承ください。）
										</p>
									</div>
								</li>
								<li>
									<h3>
										出資金以外に費用はかかりますか？
									</h3>
									<div class="answer">
										<p>
											出資金の入金時の手数料はお客様負担になります。
										</p>
									</div>
								</li>
								<li>
									<h3>
										投資申込を解約したいのですが可能ですか。
									</h3>
									<div class="answer">
										<p>
											お客様は、「契約成立時書面」をダウンロードした日を起算日として８日間が経過するまでの間、書面により当社に通知いただくことで、契約の解除を行うことができます。 具体的な手続きについてはTOPページ下部の「<a href="">クーリングオフ（契約解除）について</a>」をご参照下さい。<br>
											<br>
											その他お手続きに関するご質問は、「<a href="">こちら</a>」をご参照ください。
										</p>
									</div>
								</li>
								<li>
									<h3>
										当選結果はいつ頃確認できますか
									</h3>
									<div class="answer">
										<p>
											当選の場合は、募集終了日の翌営業日正午12：00までに当選者の方へマイページ上のメッセージまたはメールにて通知いたします。また当選結果についてはマイページの「抽選申込履歴一覧」でもご確認いただけます。
										</p>
									</div>
								</li>
								<li>
									<h3>
										当選者からキャンセルが出た場合、再抽選はありますか。
									</h3>
									<div class="answer">
										<p>
											抽選の結果「落選」となった場合においても、ファンドの成立日までに当選者からのキャンセルがあればご応募いただいた中から事務局にて「再抽選」を実施いたします。再抽選は「当選」した場合のみ、その旨をメールにて通知をさせていただきます。
										</p>
									</div>
								</li>
								<li>
									<h3>
										その他、留意しておく事項はありますか。
									</h3>
									<div class="answer">
										<p>
											募集期間中にお申込みいただいたすべてのお申込みの中から募集総額を割り振りする都合上、複数口お申込みいただいても一部のみ当選となる場合があります。また、抽選方式は抽選により当選者を抽出いたしますので、お申込みが完了していても「落選」する場合がありますので予めご了承ください。
										</p>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</section>
			</div>
			<aside class="aside">
				<div class="detail">
					<h2>
						ファンド概要
					</h2>
					<dl>
						<dt>
							予定分配率(年利)※税引前
						</dt>
						<dd>
							<span class="num">{{$fund->予定分配率}}</span><span class="unit">%</span>
						</dd>
						<dt>
							運用期間
						</dt>
						<dd>
							<p>
								<span class="num">{{$fund->運用期間_interval ?? '0'}}</span><span class="unit">ヶ月</span>
								<br>
								予定開始日：{{formatJPDate($fund->運用期間_from)}}<br>
								予定終了日：{{formatJPDate($fund->運用期間_to)}}
							</p>
						</dd>
						<dt>
							配当日
						</dt>
						<dd>
							{{formatJPDate($fund->配当日)}}
						</dd>
						<dt>
							募集種別
						</dt>
						<dd>
							{{$fund->募集種別}}
						</dd>
						<dt>
							募集期間
						</dt>
						<dd>
							開始日：{{formatJPDate($fund->募集期間（日時）_from)}}<br>{{formatJPTime($fund->募集期間（日時）_from)}}<br>
							予定終了日：{{formatJPDate($fund->募集期間（日時）_to)}}<br>{{formatJPTime($fund->募集期間（日時）_to)}}
						</dd>
					</dl>
				</div>
				<div class="requireState">
					<h2>
						募集状況
					</h2>

					@if(in_array($fund->ファンドステータス, ['募集前']))
					<div class="status">
						<p class="premiere"><span>{{$fund->募集開始予定}}</span>　募集開始予定</p>
					</div>
					@endif

					@if(in_array($fund->ファンドステータス, ['募集中', '運用中', '運用終了']))
					<div class="status">
						<p class="meter"><span class="scale" style="width: {{$fund->reach_percent}}%;">
							{{$fund->reach_percent}}
						</span></p>
					</div>
					@endif
					<dl>
						<dt>
							募集金額
						</dt>
						<dd>
							{{number_format($fund->募集金額)}}円
						</dd>
						<dt>
							現在申込み金額
						</dt>
						<dd>
							{{$fund->応募金額}}
						</dd>
						<dt>
							残り日数
						</dt>
						<dd>
							{{$fund->残り日数}}
						</dd>
						<dt>
							募集方式
						</dt>
						<dd>
							抽選式
						</dd>
						<dt>
							投資単位
						</dt>
						<dd>
							{{number_format($fund->投資単位（1口）)}}円／1口
						</dd>
						<dt>
							一人当たり<br>
							投資可能金額
						</dt>
						<dd>
							最低{{number_format($fund->一人あたり投資可能口数_from * $fund->投資単位（1口）)}}円/{{$fund->一人あたり投資可能口数_from}}口から<br>
							最大{{number_format($fund->一人あたり投資可能口数_to * $fund->投資単位（1口）)}}円/{{$fund->一人あたり投資可能口数_to}}口まで
						</dd>
					</dl>
				</div>
				<div class="apply">
					<h2>
						申込
					</h2>
					<div class="form">
						<form id="fu20_form">
							<div class="row">
								<div class="title">
									申込口数
								</div>
								<div class="input select">
									<select name="申込口数" data-investment-unit="{{$fund->投資単位（1口）}}" required {{$is_applied || $fund->ファンドステータス !== '募集中' ? 'disabled' : ''}}>
										<option value="">-</option>
										@for ($i = $fund->一人あたり投資可能口数_from; $i <= $fund->一人あたり投資可能口数_to; $i++)
										<option value="{{$i}}">{{$i}}</option>
										@endfor
									</select>
								</div>
								<span class="unit">
									口
								</span>
							</div>
							<div class="row">
								<div class="title">
									出資金額
								</div>
								<div class="input">
									<input name="出資金額" disabled type="text" required {{$is_applied || $fund->ファンドステータス !== '募集中' ? 'disabled' : ''}}/>
								</div>
								<span class="unit">
									円
								</span>
							</div>
							<div class="links">
								<ul>
									<li>
										<a target="_blank" href="/assets/pdf/不動産クラウドファンディング「彩」.pdf">契約成立前書面（PDF）</a>
									</li>
									<li>
										<a target="_blank" href="/assets/pdf/不動産クラウドファンディング「彩」.pdf">電子取引に係る重要事項説明書（PDF）</a>
									</li>
								</ul>
								<p class="notice">
									上記書類を必ずご確認ください
								</p>
							</div>

							<input name="user_id" value="{{optional($user)->id}}" type="text" hidden />
							<input name="fund_id" value="{{$fund->id}}" type="text" hidden />

							<input name="agree" type="checkbox" hidden />

							<!-- 表示したいアラートで切り替えてください -->
							<!-- 常時活性の場合は .disabled を削除します -->
							
							@if($is_applied)
							<button type="button" class="submit disabled" disabled style="pointer-events: none; opacity: .65; background: #878787;">
								申込済
							</button>
							@endif

							<!-- button for apply job -->
							@if(!$is_applied && $fund->ファンドステータス == '募集中')
							<button id="fu20_submit_button" type="submit" class="submit" data-popup-to-show="{{$popup_to_show}}">
								抽選申込をする
							</button>
							@endif

							@if(!$is_applied && $fund->ファンドステータス !== '募集中')
							<button type="button" class="submit disabled" disabled style="pointer-events: none; opacity: .65; background: #878787;">
								{{$fund->ファンドステータス}}
							</button>
							@endif
						</form>
					</div>
				</div>
			</aside>
		</div>
	</main>
<div class="alert confirm">
	<div class="box">
		<div class="close closeButton"></div>
		<h2>
			お申込み確認
		</h2>
		<p>下記の内容でお申込みしてよろしいですか？</p>
		<dl>
			<dt>
				申込口数
			</dt>
			<dd id="申込口数_selected">
				10 口
			</dd>
			<dt>
				出資金額
			</dt>
			<dd id="出資金額_selected">
				1,000,000 円
			</dd>
		</dl>
		<div class="buttons">
			<span class="close">キャンセル</span>
			<a id="confirm_apply_fund_button">はい</a>
		</div>
	</div>
</div>
<div class="alert login">
	<div class="box">
		<div class="close closeButton"></div>
		<h2>
			お申込みするには会員登録が必要です
		</h2>
		<p>会員の方はログインしてください</p>
		<div class="buttons">
			<a href="/signin">ログイン</span>
			<a href="/form/rg10">新規会員登録</a>
		</div>
	</div>
</div>
<div class="alert profile">
	<div class="box">
		<div class="close closeButton"></div>
		<h2>
		マイナンバーと口座情報を入力後、お申込みができます
		</h2>
		<a href="/profile?redirect_url={{request()->getRequestUri()}}" class="singleButton">
			会員情報入力へ
		</a>
	</div>
</div>

<div class="alert verify">
	<div class="box">
		<div class="close closeButton"></div>
		<h2>
			本人確認コードを入力後、お申込みができます
		</h2>
		<p>本人確認はがきが届いている場合はマイページよりコードをご入力ください</p>
		<a href="/my-page?redirect_url={{request()->getRequestUri()}}" class="singleButton">
			マイページへ
		</a>
	</div>
</div>


<div class="alert document">
	<div class="box">
		<div class="close closeButton"></div>
		<h2>
			お申込み前に書類の確認が必要です
		</h2>
		<p>
			「契約成立前書面」 「電子取引に係る重要事項説明書」 を確認されていません。<br>
			<br>
			フォーム上のリンクをクリックしてご確認の上、お申込みください。
		</p>
		<span class="singleButton close">
			閉じる
		</span>
	</div>
</div>
	<footer id="footer"></footer>
</body>
</html>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="all">
	<title>不動産クラウドファンディング「彩」丨会員情報</title>
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
	<link type="text/css" rel="stylesheet" href="/assets/css/form.css">
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
	<script type="text/javascript" src="/assets/js/user.js" defer></script>
	<script type="text/javascript" src="/assets/js/user_app.js?v={{rand(10,1000)}}" defer></script>
	<script type="text/javascript" src="/assets/js/form.js?v={{rand(10,1000)}}" defer></script>

	<style>
		.formControl.style2 span {
			font-weight: 600; 
			margin-right: 4rem; 
			width: 8rem; 
		}

		.formControl.style2 p {
			margin-top: 2rem;
		}
		
		.d-none {
			display: none;
		}
	</style>
</head>
<body>
	<header id="header" class="member_on"></header><!-- classでスイッチ　member_on member_none -->

	<main class="MY70">
		<div class="breadcrumbs">
			<ul itemscope itemtype="https://schema.org/BreadcrumbList">
				<!-- InstanceBeginEditable name="breadcrumbs" -->
				<li id="breadcrumbs_common" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"></li>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<meta itemprop="position" content="2" />
					<a itemprop="item" href="/user/my10.html">
						<span itemprop="name">マイページ</span>
					</a>
				</li>
				<!-- InstanceEndEditable -->
				<li>会員情報</li>
			</ul>
		</div>

		<div class="mv">
			<h2 class="pageTtl">
				会員情報
			</h2>
			<p class="lead">住所やメールアドレスなど、編集不可になっている項目の変更を希望される方は、<a href="/ct10.html">「お問い合わせ」ページよりご連絡ください。</a></p>
		</div>

		<div class="inner">
			<form id="my70_form">
				<dl>
					<dt>
						<label>メールアドレス</label>
					</dt>
					<dd>
						<p><span>{{$user['メールアドレス']}}</span></p>
					</dd>
				</dl>

				<dl>
					<dt>
						<label>お名前</label>
					</dt>
					<dd>
						<p>
							<span>{{$user['お名前1']}}</span><span>{{$user['お名前2']}}</span>
						</p>
					</dd>
				</dl>

				<dl>
					<dt>
						<label>生年月日</label>
					</dt>
					<dd>
						<p>
							<span>{{$user['生年月日_year']}}年</span><span>{{$user['生年月日_month']}}月</span><span>{{$user['生年月日_day']}}日</span>
						</p>
					</dd>
				</dl>

				<dl>
					<dt>
						<label>郵便番号</label>
					</dt>
					<dd>
						<p><span>{{$user['郵便番号']}}</span></p>
					</dd>
				</dl>

				<dl>
					<dt>
						<label>都道府県</label>
					</dt>
					<dd>
						<p><span>{{$user['都道府県']}}</span></p>
					</dd>
				</dl>

				<dl>
					<dt>
						<label>住所</label>
					</dt>
					<dd>
						<p><span>{{$user['住所']}}</span></p>
					</dd>
				</dl>

				<dl>
					<dt>
						<label>建物名</label>
					</dt>
					<dd>
						<p><span>{{$user['建物名']}}</span></p>
					</dd>
				</dl>

				<dl class="hasNote style2">
					<dt>
						<label>電話番号<span class="badge">必須</span></label>
						<p class="redTxt">※どちらか必ずご入力ください</p>
					</dt>
					<dd class="formControl style3">
						<p>
							固定電話<input type="tel" name="固定電話" autocomplete="" placeholder="000-000-000" />
						</p>
						<p>
							携帯電話<input type="tel" name="携帯電話" autocomplete="" placeholder="000-0000-0000" />
						</p>
					</dd>
				</dl>

				<dl>
					<dt>
						<label>金融資産<span class="badge">必須</span></label>
					</dt>
					<dd class="formControl">
						<p>
							<select name="金融資産" required>
								<option value="">選択してください</option>
								<option value="100万円以上">100万円以上</option>
								<option value="300万円未満">300万円未満</option>
								<option value="500万円未満">500万円未満</option>
								<option value="1,000万円未満">1,000万円未満</option>
								<option value="3,000万円未満">3,000万円未満</option>
								<option value="5,000万円未満">5,000万円未満</option>
								<option value="1億円未満">1億円未満</option>
								<option value="1億円以上">1億円以上</option>
							</select>
						</p>
					</dd>
				</dl>

				<dl>
					<dt>
						<label>勤務先（法人の方は会社名）</label>
					</dt>
					<dd class="formControl">
						<p>
							<input type="text" name="勤務先" autocomplete="" placeholder="〇〇〇株式会社" />
						</p>
					</dd>
				</dl>

				<dl>
					<dt>
						<label>余剰資金の運用である</label>
					</dt>
					<dd>
						<p><span>{{$user['余剰資金の運用である']}}</span></p>
					</dd>
				</dl>

				<dl>
					<dt>
						<label>元本が毀損した場合、生活に支障が出るかどうか</label>
					</dt>
					<dd>
						<p><span>{{$user['元本が毀損した場合、生活に支障が出るかどうか']}}</span></p>
					</dd>
				</dl>

				<dl>
					<dt>
						<label>金融に係る業務の経験</label>
					</dt>
					<dd>
						<p><span>{{$user['金融に係る業務の経験']}}</span></p>
					</dd>
				</dl>

				<dl>
					<dt>
						<label>投資方針<span class="badge">必須</span></label>
					</dt>
					<dd class="formControl">
						<p>
							<select name="投資方針" required>
								<option value="">選択してください</option>
								<option value="短期利益追求">短期利益追求</option>
								<option value="長期安定保有">長期安定保有</option>
							</select>
						</p>
					</dd>
				</dl>

				<dl>
					<dt>
						<label>投資経験（年数）<span class="badge">必須</span></label>
					</dt>
					<dd class="formControl">
						<p>
							<select name="投資経験（年数）" required>
								<option value="">選択してください</option>
								<option value="なし">なし</option>
								<option value="1年未満">1年未満</option>
								<option value="3年未満">3年未満</option>
								<option value="5年未満">5年未満</option>
								<option value="10年未満">10年未満</option>
								<option value="10年以上">10年以上</option>
							</select>
						</p>
					</dd>
				</dl>

				<dl>
					<dt>
						<label>本人確認方法</label>
					</dt>
					<dd>
						<p><span>{{$user['本人確認方法']}}</span></p>
					</dd>
				</dl>

				@if(!$user->allow_investment_flag)
				<dl style="margin-bottom: 4rem;">
					<dt>
						<label>マイナンバー<span class="badge">必須</span></label>
						<p class="redTxt">※保存後は変更できません</p>
					</dt>
					<dd class="formControl">
						<p style="position: relative;">
							<input name="マイナンバー" type="number" autocomplete="" placeholder="0000000000" required="" />

							<span id="マイナンバー_note" class="note d-none" style="color: #F94C4A; font-weight: 600; position: absolute;">※マイナンバー、12文字でないといけません。</span>
						</p>
					</dd>
				</dl>

				<dl class="hasNote style2">
					<dt>
						<label>振込先の銀行<span class="badge">必須</span></label>
						<p class="redTxt">※全てご入力ください</p>
						<p class="redTxt">※保存後は変更できません</p>
					</dt>
					<dd class="formControl style3">
						<p>
							金融機関名<input type="text" name="金融機関名" autocomplete="" placeholder="銀行名を入力（例：みずほ銀行）" required />
						</p>
						<p>
							支店名<input type="text" name="支店名" autocomplete="" placeholder="支店名を入力（例：中央支店）" required />
						</p>
						<div class="formRadio">
							<p>
								<span>口座種別</span>
								<input name="口座種別" value="普通預金口座" type="radio" id="actype_1"><label for="actype_1">普通預金口座</label>
								<input name="口座種別" value="当座預金口座" type="radio" id="actype_2"><label for="actype_2">当座預金口座</label>
							</p>
						</div>
						<p>
							口座番号<input type="number" name="口座番号" autocomplete="" placeholder="00000000" required />
						</p>
						<p>
							口座名義人<input type="text" name="口座名義人" autocomplete="" placeholder="フジタデン" required />
							<span class="note" style="color: #F94C4A; text-indent: 7em;">※氏名の間にスペースを入れずにご入力ください</span>
						</p>
					</dd>
				</dl>
				@else 
				<dl>
					<dt>
						<label>マイナンバー</label>
					</dt>
					<dd class="formControl">
						<p><span>{{substr($user['マイナンバー'], 0, 4)}}********</span></p>
					</dd>
				</dl>

				<dl class="hasNote style2">
					<dt>
						<label>振込先の銀行</label>
					</dt>
					<dd class="formControl style2">
						<p>
							<span>金融機関名</span>{{$user['金融機関名']}}
						</p>
						<p>
							<span>支店名</span>{{$user['支店名']}}
						</p>
						<div class="formRadio">
							<p>
								<span>口座種別</span>
								<input disabled name="口座種別" value="普通預金口座" type="radio" id="actype_1"><label for="actype_1">普通預金口座</label>
								<input disabled name="口座種別" value="当座預金口座" type="radio" id="actype_2"><label for="actype_2">当座預金口座</label>
							</p>
						</div>
						<p>
							<span >口座番号</span> {{$user['口座番号']}}
						</p>
						<p>
							<span >口座名義人</span>{{$user['口座名義人']}}
						</p>
					</dd>
				</dl>
				@endif

				<button id="my70_form_submit_button" type="submit" class="btn style1">入力内容を保存する</button>
			</form>
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
	</main>
	
	<footer id="footer"></footer>

<script>
function loadDetailInformation(USER_ID) {
    /**
     * Get data for edit.
     */
    $.get(`/ajax/user.detail.${USER_ID}`, function(data) {
        bindDataForForm(data, '#my70_form');
    });
}

$(document).ready(function() {
    let USER_ID = '{{$user->id}}';

	let isFormValid = true;

	
	$('input[name="口座名義人"]').focusout(function( event ) {
		// Check if have whitespace.
		if( /^$|\s|　| +/.test(event.target.value) ) {
			$( event.target ).focus();
			$( event.target ).css('background-color', '#FFE0E0');
			isFormValid = false;
		} else {
			$( event.target ).css('background-color', 'inherit');
			isFormValid = true;
		}
	});

	$('input[name="マイナンバー"]').focusout(function( event ) {
		// Check if have whitespace.
		if( event.target.value.length !== 12 ) {
			$( event.target ).focus();
			$( event.target ).css('background-color', '#FFE0E0');
			$('#マイナンバー_note').removeClass('d-none');
			isFormValid = false;
		} else {
			$( event.target ).css('background-color', 'inherit');
			$('#マイナンバー_note').addClass('d-none');
			isFormValid = true;
		}
	});

    loadDetailInformation(USER_ID);
    $("#my70_form").submit(function( event ) {
		event.preventDefault();


        // If both field is empty
        if( !$('#my70_form input[name="固定電話"]').val() && !$('#my70_form input[name="携帯電話"]').val() ) {
            $('#my70_form input[name="固定電話"]').css('background-color', '#FFE0E0');
            $('#my70_form input[name="携帯電話"]').css('background-color', '#FFE0E0');
            $('#my70_form input[name="携帯電話"]').focus();

            return;
        } else {
            $('#my70_form input[name="固定電話"]').css('background-color', 'inherit');
            $('#my70_form input[name="携帯電話"]').css('background-color', 'inherit');
        }

		if(!isFormValid) {
			return;
		}

        $('#my70_form_submit_button').prop("disabled", true);

        let data = getDataFromForm('#my70_form');

        $.ajax({
                url: `/ajax/user.update.${USER_ID}`,
                data: JSON.stringify(data),
                type: 'POST',
                contentType: 'application/json',
            })
            .done(function() {
                showMessageSaveSuccessfully();
                 $('#my70_form_submit_button').prop("disabled", false);

				setTimeout(function() {
					'{{request()->get('redirect_url')}}' ? window.location.assign('{{request()->get('redirect_url')}}') : location.reload();
                }, 2000);
            })
            .fail(function(error) {
                showErrorMessage(error.responseJSON);
                $('#my70_form_submit_button').prop("disabled", false);

				
				if (error.responseJSON.error_code == 'required_fields') {
                    displayFormValidation(error.responseJSON.error_fields, '#my70_form');
                }
            });

    });
});
</script>
</body>
</html>

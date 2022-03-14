@extends('layout.q_admin')

@section('breadcrumb')
<div id="breadcrumbs">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/US10">顧客一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">顧客情報詳細</li>
        </ol>
    </nav>
</div>
@endsection


@section('content')
<div class="conten user-detail-screen">
    <div class="title-top-conten">
        <div class="title-recruitment">
            <ul class="information pt-3">
                <li class=""><img src="./image/user.svg" alt="">&emsp;
                    <span data-model="お名前1"></span><span data-model="お名前2"></span>（<span data-model="フリガナ1"></span><span
                        data-model="フリガナ2"></span>）
                </li>
                <li><img src="./image/telephone.svg" alt=""><span data-model="固定電話x"></span></li>
                <li><img src="./image/phone.svg" alt=""><span data-model="携帯電話x"></span></li>
            </ul>
        </div>
        <div class="menu-content">
            <ul>
                <li>
                    <a class="color-menu" href="./US20"> 基本情報</a>
                </li>
                <li>
                    <a href="./US30?user_id={{ request()->get('user_id') }}"> 申込一覧</a>
                </li>
                <li>
                    <a href="./US40?user_id={{ request()->get('user_id') }}"> 投資一覧 </a>
                </li>
                <li>
                    <a href="./US50?user_id={{ request()->get('user_id') }}"> メッセージ</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-conten">
        <form id="form" class="row-conten g-3 h-adr" onsubmit="return false" autocomplete="off">
            <div class="title-main-conten">
                <p><img src="./image/user.svg" alt="">&emsp; 基本情報</p>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">個人・法人</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 pdl-1">
                    <div id="rates-1">
                        <input id="1-option" value="個人" name="個人・法人" type="radio"> <label for="1-option">個人</label>
                        <input id="2-option" value="法人" name="個人・法人" type="radio"> <label for="2-option">法人</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label for="メールアドレス" class="form-label">メールアドレス</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <div class="w30">
                        <input class="form-control w30" name="メールアドレス" placeholder="aa@cccc.com" type="email">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label for="マイナンバー" class="form-label">マイナンバー</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <div class="w30">
                        <input class="form-control w30" name="マイナンバー" placeholder="00000000000" type="number" min="0">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label for="お名前" class="form-label">お名前</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <div class="w14">
                        <input class="form-control w14" name="お名前1" placeholder="伊藤" type="text">
                    </div>
                    <div class="w14">
                        <input class="form-control w14" name="お名前2" placeholder="裕子" type="text">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">フリガナ</label>
                    <div class="nhan">必須</div>

                </div>
                <div class="coll-md-8 edit-padding">
                    <div class="w14">
                        <input class="form-control w14" name="フリガナ1" placeholder="イトウ" type="text">
                    </div>
                    <div class="w14">
                        <input class="form-control w14" name="フリガナ2" placeholder="ユウコ" type="text">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">生年月日</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <div class="w14 ">
                        <select class="form-select w14" name="生年月日_year" id="year">
                            <option selected="">年</option>
                            <option value="2010">2010</option>
                            <option value="2009">2009</option>
                            <option value="2008">2008</option>
                            <option value="2007">2007</option>
                            <option value="2006">2006</option>
                            <option value="2005">2005</option>
                            <option value="2004">2004</option>
                            <option value="2003">2003</option>
                            <option value="2002">2002</option>
                            <option value="2001">2001</option>
                            <option value="2000">2000</option>
                            <option value="1999">1999</option>
                            <option value="1998">1998</option>
                            <option value="1997">1997</option>
                            <option value="1996">1996</option>
                            <option value="1995">1995</option>
                            <option value="1994">1994</option>
                            <option value="1993">1993</option>
                            <option value="1992">1992</option>
                            <option value="1991">1991</option>
                            <option value="1990">1990</option>
                            <option value="1989">1989</option>
                            <option value="1988">1988</option>
                            <option value="1987">1987</option>
                            <option value="1986">1986</option>
                            <option value="1985">1985</option>
                            <option value="1984">1984</option>
                            <option value="1983">1983</option>
                            <option value="1982">1982</option>
                            <option value="1981">1981</option>
                            <option value="1980">1980</option>
                            <option value="1979">1979</option>
                            <option value="1978">1978</option>
                            <option value="1977">1977</option>
                            <option value="1976">1976</option>
                            <option value="1975">1975</option>
                            <option value="1974">1974</option>
                            <option value="1973">1973</option>
                            <option value="1972">1972</option>
                            <option value="1971">1971</option>
                            <option value="1970">1970</option>
                            <option value="1969">1969</option>
                            <option value="1968">1968</option>
                            <option value="1967">1967</option>
                            <option value="1966">1966</option>
                            <option value="1965">1965</option>
                            <option value="1964">1964</option>
                            <option value="1963">1963</option>
                            <option value="1962">1962</option>
                            <option value="1961">1961</option>
                            <option value="1960">1960</option>
                            <option value="1959">1959</option>
                            <option value="1958">1958</option>
                            <option value="1957">1957</option>
                            <option value="1956">1956</option>
                            <option value="1955">1955</option>
                            <option value="1954">1954</option>
                            <option value="1953">1953</option>
                            <option value="1952">1952</option>
                            <option value="1951">1951</option>
                            <option value="1950">1950</option>
                        </select>
                    </div>
                    <div class="w14 ">
                        <select class="form-select w14" name="生年月日_month" id="month">
                            <option selected="">月</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="w14">
                        <select class="form-select w14" name="生年月日_day" id="day">
                            <option selected="">日</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label edit-center">郵便番号</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <span class="p-country-name" style="display:none;">Japan</span>
                    <div class="w14">
                        <input id="郵便番号" type="text" min="0" id="post" name="郵便番号" placeholder="346-0016"
                            class="p-postal-code form-control w14" size="8" maxlength="8">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">都道府県</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <div class="w14">
                        <input type="text" name="都道府県" id="city" placeholder="埼玉県" class="p-region form-control w14" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">住所</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <input class="form-control p-locality p-street-address" name="住所" id="address"
                        placeholder="久喜市久喜東 2丁目 4-1">
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">建物名</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding" onclick="date2()">
                    <input name="建物名" class="form-control" placeholder="久喜ビル 1F">
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3" style="flex-direction: column; align-items: flex-start;">
                    <label class="form-label">電話番号</label>
                    <p class="attention">※どちらかは必ずご入力ください</p>
                </div>
                <div class="coll-md-8 edit-padding1">
                    <div class="Fixed-line">
                        <label class="Fixed-line-left" for="固定電話">固定電話</label>
                        <input class="form-control" name="固定電話" id="電話番号_固定電話" placeholder="000-000-000" type="text"
                            maxlength="11">
                        <div class="required-label">必須</div>
                    </div>
                    <div class="Fixed-line">
                        <label class="Fixed-line-left" for="携帯電話">携帯電話</label>
                        <input class="form-control " name="携帯電話" id="電話番号_携帯電話" placeholder="090-1111-2222" type="text"
                        maxlength="13">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">金融資産</label>
                    <div class="nhan">必須</div>

                </div>
                <div class="coll-md-8 edit-padding">
                    <select class="form-select" name="金融資産" id="finance">
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
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">投資目的</label>
                    <div class="nhan">必須</div>

                </div>
                <div class="coll-md-8 edit-padding">
                    <select class="form-select" name="投資目的" id="purpose">
                        <option value="">選択してください</option>
                        <option value="指定なし">指定なし</option>
                        <option value="余剰資金の運用">余剰資金の運用</option>
                        <option value="将来のための資産形成">将来のための資産形成</option>
                        <option value="ポートフォリオの分散">ポートフォリオの分散</option>
                        <option value="小口不動産への関心">小口不動産への関心</option>
                        <option value="その他">その他</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">取引開始のきっかけ</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <select class="form-select" name="取引開始のきっかけ" id="activated">
                        <option value="">選択してください</option>
                        <option value="指定なし">指定なし</option>
                        <option value="ご紹介">ご紹介</option>
                        <option value="セミナー">セミナー</option>
                        <option value="ホームページ">ホームページ</option>
                        <option value="新聞・雑誌">新聞・雑誌</option>
                        <option value="インターネット">インターネット</option>
                        <option value="テレビ・ラジオ">テレビ・ラジオ</option>
                        <option value="その他">その他</option>
                    </select>

                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">職業</label>
                    <div class="nhan">必須</div>

                </div>
                <div class="coll-md-8 edit-padding">
                    <select class="form-select" name="職業" id="profession">
                        <option value="">選択してください</option>
                        <option value="指定なし">指定なし</option>
                        <option value="会社役員（上場）">会社役員（上場）</option>
                        <option value="会社役員（未上場）">会社役員（未上場）</option>
                        <option value="会社員（上場）">会社員（上場）</option>
                        <option value="会社員（未上場）">会社員（未上場）</option>
                        <option value="官公庁職員">官公庁職員</option>
                        <option value="公務員">公務員</option>
                        <option value="教職員">教職員</option>
                        <option value="医師">医師</option>
                        <option value="弁護士">弁護士</option>
                        <option value="司法書士/行政書士">司法書士/行政書士</option>
                        <option value="公認会計士・税理士">公認会計士・税理士</option>
                        <option value="農業・漁業・林業">農業・漁業・林業</option>
                        <option value="自営業">自営業</option>
                        <option value="パート・アルバイト">パート・アルバイト</option>
                        <option value="派遣社員">派遣社員</option>
                        <option value="契約社員">契約社員</option>
                        <option value="専業主婦">専業主婦</option>
                        <option value="学生">学生</option>
                        <option value="無職">無職</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">勤務先</label>
                </div>
                <div class="coll-md-8 edit-padding">
                    <input class="form-control" name="勤務先" id="Workplace" placeholder="株式会社フジハウジング">
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">年収（年金所得も含む）</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <select class="form-select" name="年収（年金所得も含む）" id="annual-income">
                        <option value="">選択してください</option>
                        <option value="100万円未満">100万円未満</option>
                        <option value="400万円未満">400万円未満</option>
                        <option value="800万円未満">800万円未満</option>
                        <option value="1000万円未満">1000万円未満</option>
                        <option value="1500万円未満">1500万円未満</option>
                        <option value="3000万円未満">3000万円未満</option>
                        <option value="3000万円以上">3000万円以上</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">余剰資金の運用である</label>
                    <div class="nhan">必須</div>

                </div>
                <div class="coll-md-8 pdl-1">
                    <input id="3-option" value="はい" name="余剰資金の運用である" type="radio"> <label for="3-option">はい</label>
                    <input id="4-option" value="いいえ" name="余剰資金の運用である" type="radio"> <label for="4-option">いいえ</label>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3">
                    <label class="form-label">元本が毀損した場合、<br> 生活に支障が出るかどうか</label>
                    <div class="nhan mt-2">必須</div>
                </div>
                <div class="coll-md-8 pdl-1">
                    <input id="5-option" value="はい" name="元本が毀損した場合、生活に支障が出るかどうか" type="radio">
                    <label for="5-option">はい</label>
                    <input id="6-option" value="いいえ" name="元本が毀損した場合、生活に支障が出るかどうか" type="radio"> <label
                        for="6-option">いいえ</label>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3">
                    <label class="form-label">金融に係る業務の経験</label>
                    <div class="nhan">必須</div>

                </div>
                <div class="coll-md-8 pdl-1">
                    <input id="7-option" value="はい" name="金融に係る業務の経験" type="radio"> <label for="7-option">
                        はい</label>
                    <input id="8-option" value="いいえ" name="金融に係る業務の経験" type="radio"> <label for="8-option">
                        いいえ</label>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">投資方針</label>
                    <div class="nhan">必須</div>

                </div>
                <div class="coll-md-8 edit-padding">
                    <select class="form-select" name="投資方針">
                        <option value="">選択してください</option>
                        <option value="短期利益追求">短期利益追求</option>
                        <option value="長期安定保有">長期安定保有</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">投資経験（年数）</label>
                    <div class="nhan">必須</div>

                </div>
                <div class="coll-md-8 edit-padding">

                    <select class="form-select" name="投資経験（年数）">
                        <option value="">選択してください</option>
                        <option value="なし">なし</option>
                        <option value="1年未満">1年未満</option>
                        <option value="3年未満">3年未満</option>
                        <option value="5年未満">5年未満</option>
                        <option value="10年未満">10年未満</option>
                        <option value="10年以上">10年以上</option>
                    </select>
                </div>
            </div>
            <!--  -->

            <div class="title-main-conten">
                <p><img src="./image/hop.svg" alt=""> 銀行口座</p>
            </div>
            <div class="form-group">
                <div class="coll-md-3" style="flex-direction: column; align-items: flex-start;">
                    <label class="form-label">振込先の銀行</label>
                    <p class="attention">※全てご入力ください</p>
                </div>
                <div class="coll-md-8 edit-padding1">

                    <div class="Fixed-line">
                        <label class="Fixed-line-left" for="金融機関名">金融機関名</label>
                        <input class="form-control" name="金融機関名" placeholder="みずほ銀行" type="text">
                        <div class="required-label">必須</div>
                    </div>
                    <div class="Fixed-line">
                        <label class="Fixed-line-left" for="支店名">支店名</label>
                        <input class="form-control" name="支店名" placeholder="中央支店" type="text">
                    </div>
                    <div class="Fixed-line" style="width: 77%;">
                        <label class="Fixed-line-left" for="">口座種別</label>
                        <input id="9-option" class="mt-3" value="普通預金口座" name="口座種別" type="radio"> <label
                            class="option9 mt-1" for="9-option">&ensp;普通預金口座</label>
                        <input id="10-option" class="mt-3" value="当座預金口座" name="口座種別" type="radio"> <label
                            class="option9 mt-1" for="10-option">&ensp;当座預金口座</label>
                    </div>
                    <div class="Fixed-line">
                        <label class="Fixed-line-left" for="">口座番号</label>
                        <input class="form-control" name="口座番号" placeholder="0000000000" type="number" min="0">
                    </div>
                    <div class="Fixed-line">
                        <label class="Fixed-line-left" for="">口座名義人</label>
                        <input class="form-control" name="口座名義人" placeholder="イトウユウコ" type="text">
                    </div>
                    <p class="attention1">※氏名の間にスペースを入れずにご入力ください</p>
                </div>
            </div>

            <div class="title-main-conten">
                <p><img src="./image/hop1.svg" alt=""> その他</p>
            </div>

            <div class="form-group">
                <div class="coll-md-3 ">
                    <label for="本人確認方法" class="form-label">本人確認方法</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 pdl-1">
                    <input id="11-option" value="本人限定受取郵便" name="本人確認方法" type="radio"> <label for="11-option">
                        本人限定受取郵便</label>
                    <input id="12-option" value="面談（場所：弊社）" name="本人確認方法" type="radio"> <label for="12-option">
                        面談（場所：弊社)</label>
                    <input id="13-option" value="面談（場所：お客様ご自宅）" name="本人確認方法" type="radio"> <label for="13-option">
                        面談（場所：お客様ご自宅）</label>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label for="本人確認コード" class="form-label">本人確認コード</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <p style="padding-left: 0.5rem;">{{optional($params['user']->verification_code)->code}}</p>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label for="本人確認コード入力日" class="form-label">本人確認コード入力日</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <p style="padding-left: 0.5rem;">{{$params['user']['本人確認コード入力日']}}</p>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label for="メモ" class="form-label">メモ</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <textarea class=" form-control" name="メモ" placeholder="メモを入力" type="text"></textarea>

                </div>
            </div>
            <div class="col-md-12">
                <div class="option1 text-end">
                    <br />
                    <a href="">退会させる</a>
                    <br />
                    <br />
                    <a href="">完全に削除する</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="button-submit">
                    <button id="submit_form" type="button" class="base-button submit-button">保存</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
function loadDetailInformation(USER_ID) {
    /**
     * Get data for edit.
     */
    $.get(`/ajax/user.detail.${USER_ID}`, function(data) {
        bindDataForForm(data);
    });
}

$(document).ready(function() {
    setUserHeaderData();
    let USER_ID = $.urlParam('user_id');

    loadDetailInformation(USER_ID);
    $("#submit_form").click(function() {
        let btn = $(this);
        btn.addClass('disabled');

        let data = getDataFromForm();

        /**
         * Filter out empty data
         */
        data = data.filter(function(item) {
            return item.value && item.value.length > 0;
        });

        $.ajax({
                url: `/ajax/user.update.${USER_ID}`,
                data: JSON.stringify(data),
                type: 'POST',
                contentType: 'application/json',
            })
            .done(function() {
                showMessageSaveSuccessfully();
                btn.removeClass('disabled');
            })
            .fail(function(error) {
                showErrorMessage(error.responseJSON);
                btn.removeClass('disabled');
            });

    });
});
</script>
@endsection
@extends('layout.q_admin')

@section('breadcrumb')
<div id="breadcrumbs">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/FD10">ファンド一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">ファンド編集</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="main-conten fund-screen">
    <div class="title-recruitment">
        <div class="recruitment-left">
            <div class="nhan-recruitment">
                <p data-model="ファンドステータス"></p>
            </div>
            <div class="text-recruitment">
                <p data-model="ファンド名"></p>
            </div>
        </div>
        <div class="recruitment-right">
            <ul>
                <li>
                    <span>募集期間</span>&emsp;&emsp; <a data-model="募集期間（日時）_from">-</a> ~ <a data-model="募集期間（日時）_to">-<a>
                </li>
                <li>
                    <span>運用期間</span>&emsp;&emsp; <a data-model="運用期間_from">-</a> ~ <a data-model="運用期間_to">-<a>
                </li>
            </ul>
        </div>
    </div>
    <div class="menu-content">
        <ul>
            <li>
                <a class="color-menu" href="FD30?fund_id={{ request()->get('fund_id') }}"> ファンド情報</a>
            </li>
            <li>
                <a href="FD40?fund_id={{ request()->get('fund_id') }}">申込一覧</a>
            </li>
            <li>
                <a href="FD50?fund_id={{ request()->get('fund_id') }}"> 投資一覧 </a>
            </li>
            <li>
                <a href="FD60?fund_id={{ request()->get('fund_id') }}"> メッセージ</a>
            </li>
        </ul>
    </div>
    <form class="row-conten" id="form" onsubmit="return false" autocomplete="off">

        <div class="title-main-conten">
            <p>ファンド概要</p>

            <div class="option">
                <button id="preview_fund_button" class="base-button submit-button" for="">プレビュー</button>
                <button id="public_fund_button"
                    class="base-button action-button {{$params['show_button'] ? 'submit_form' : 'disabled'}}"
                    style="height: 4rem;" for="">{{ $params['button_text'] }}</button>
            </div>
        </div>
        <div class="form-group" style="margin-top: 1rem;">
            <div class="coll-md-3 ">
                <label class="form-label">ファンドステータス</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding text-binding" style="margin-left: 10px;">
                <p>{{$params['fund_status']}}</p>
                <!-- <div class="w30">
                    <select class="form-select w30" name="ファンドステータス">
                        <option value="作成中"> 作成中</option>
                        <option value="募集前">募集前</option>
                        <option value="募集中">募集中</option>
                        <option value="募集終了">募集終了</option>
                        <option value="不成立">不成立</option>
                        <option value="運用中">運用中</option>
                        <option value="運用終了">運用終了</option>
                    </select>
                </div> -->
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="ファンド名" class="form-label">ファンド名</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="ファンド名" placeholder="アルファアセットファンド京都祇園第4回" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="新規／継続" class="form-label">新規／継続</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8" style="margin-left: 10px;">
                <input id="1-option" value="新規" name="新規／継続" type="radio"> <label for="1-option"> 新規</label>
                <input id="2-option" value="継続" name="新規／継続" type="radio"> <label for="2-option"> 継続</label>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="予定分配率" class="form-label">予定分配率</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input class="form-control w30" name="予定分配率" placeholder="数字を入力" type="number" min="0">
                </div>
                <div class="or">%</div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">募集金額</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input data-for-calculating="true" class="form-control w30" name="募集金額" placeholder="開始日を入力"
                        type="number" min="0">
                </div>
                <div class="or">円</div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">投資単位（1口）</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input data-for-calculating="true" class="form-control w30" name="投資単位（1口）" placeholder="数字を入力"
                        type="number" min="0">
                </div>
                <div class="or">円</div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label edit-center">一人あたり<br>投資可能口数</label>
                <div class="nhan" style="margin-top: 6px;">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input class="form-control w30" name="一人あたり投資可能口数_from" placeholder="数字を入力" type="number" min="0">
                </div>
                <div class="or"> 以上</div>
                <div class="w30">
                    <input class="form-control w30" name="一人あたり投資可能口数_to" placeholder="数字を入力" type="number" min="0">
                </div>
                <div class="or">以下</div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">運用期間</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding datetime-picker">
                <div class="w30">
                    <input class="form-control w30" name="運用期間_from" placeholder="🗓&emsp; 開始日を入力">
                </div>
                <div class="or">〜</div>
                <div class="w30">
                    <input class="form-control w30" name="運用期間_to" placeholder="🗓&emsp; 終了日を入力">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">配当日</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding datetime-picker">
                <div class="w30">
                    <input class="form-control w30" name="配当日" id="txtdate" placeholder="🗓&emsp; 配当日を入力">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">募集期間（日時）</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input class="form-control w30" id="募集期間（日時）_from" name="募集期間（日時）_from" placeholder="🗓&emsp; 開始日時を入力">
                </div>
                <div class="or">〜</div>
                <div class="w30">
                    <input class="form-control w30" id="募集期間（日時）_to" name="募集期間（日時）_to" placeholder=" 🗓&emsp; 終了日時を入力">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">募集種別</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <select class="form-select" name="募集種別" style="width: 85.5%;">
                    <option value="">募集種別を選択</option>
                    <option value="匿名組合型">匿名組合型</option>
                </select>
            </div>
        </div>
        <div class="form-group" style="align-items: flex-start; margin-top: 2rem;">
            <div class="coll-md-3">
                <label class="form-label">メイン画像</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8">
                <div class="image-file-select" style="padding-left: 0.5rem;" id="メイン画像_img_upload">
                    <div class="image-upload-placeholder">
                        <label for="メイン画像_image_input_file" class="input-image-placeholder"></label>
                        <input type="file" id="メイン画像_image_input_file" accept="image/*" name="メイン画像" hidden />
                    </div>
                </div>
                <p class="center25" style="padding-left: 2.5rem; font-size: 12px;">※ファイルサイズ25MBまで</p>
            </div>
        </div>
        <div class="form-group" style="align-items: flex-start; margin-top: 2rem;">
            <div class="coll-md-3 ">
                <label class="form-label edit-center">サブ画像(5つまで)</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8">
                <div class="image-file-select" style="padding-left: 0.5rem;" id="サブ画像_img_upload">
                    <div class="image-upload-placeholder">
                        <label for="サブ画像_image_input_file" class="input-image-placeholder"></label>
                        <input type="file" id="サブ画像_image_input_file" accept="image/*" name="サブ画像" hidden />
                    </div>
                </div>
                <p class="center25" style="padding-left: 2.5rem; font-size: 12px;">※ファイルサイズ25MBまで</p>
            </div>
        </div>

        <div class="title-main-conten">
            <p>物件チラシ</p>
        </div>
        <div class="form-group" style="align-items: flex-start; margin-top: 2rem;">
            <div class="coll-md-3 ">
                <label class="form-label edit-center">チラシ画像</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8">
                <div class="image-file-select" style="padding-left: 0.5rem;" id="チラシ画像_img_upload">
                    <div class="image-upload-placeholder">
                        <label for="チラシ画像_image_input_file" class="input-image-placeholder"></label>
                        <input type="file" id="チラシ画像_image_input_file" accept="image/*" name="チラシ画像" hidden />
                    </div>
                </div>
                <p class="center25" style="padding-left: 2.5rem; font-size: 12px;">※ファイルサイズ25MBまで</p>
            </div>
        </div>

        <div class="title-main-conten">
            <p>物件詳細</p>
        </div>
        <div class="title-main-item">
            <p>物件概要</p>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="物件名称" class="form-label">物件名称</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="物件名称" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="所在地" class="form-label">所在地</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="所在地" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="交通" class="form-label">交通</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="交通" placeholder="入力してください" type="text">
            </div>
        </div>

        <div class="title-main-item">
            <p>土地</p>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="地目" class="form-label">地目</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="地目" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="面積" class="form-label">面積</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="面積" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="権利" class="form-label">権利</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="権利" placeholder="入力してください" type="text">
            </div>
        </div>


        <div class="title-main-item">
            <p>建物</p>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="地目" class="form-label">構造</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" id="地目" name="構造" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="床面積" class="form-label">床面積</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="床面積" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="築年月" class="form-label">築年月</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="築年月" placeholder="入力してください" type="text">
            </div>
        </div>


        <div class="title-main-item">
            <p>法令</p>
        </div>

        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="地目" class="form-label">用途地域</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class=" form-control" name="用途地域" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="面積" class="form-label">建ぺい率</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class=" form-control" name="建ぺい率" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="容積率" class="form-label">容積率</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="容積率" placeholder="入力してください" type="text">
            </div>
        </div>

        <div class="title-main-item">
            <p>賃貸借契約の概要</p>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="貸主" class="form-label">貸主</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class=" form-control" name="貸主" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="借主" class="form-label">借主</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class=" form-control" name="借主" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="契約形態" class="form-label">契約形態</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class=" form-control" name="契約形態" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">現契約期間</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding datetime-picker">
                <div class="w30">
                    <input id="txtfrom3" class="form-control w30" name="現契約期間_from" placeholder="🗓&emsp; 開始日を入力">
                </div>
                <div class="or">〜</div>
                <div class="w30">
                    <input class="form-control w30" id="txtto3" name="現契約期間_to" placeholder="🗓&emsp; 終了日を入力">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="賃料月額" class="form-label">賃料月額</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input class="form-control w30" name="賃料月額" placeholder="数字を入力" type="number" min="0">
                </div>
                <div class="or">円</div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="敷金" class="form-label">敷金</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input class="form-control w30" name="敷金" placeholder="数字を入力" type="number" min="0">
                </div>
                <div class="or">円</div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="契約更改の方法" class="form-label">契約更改の方法</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <textarea class="form-control" name="契約更改の方法" placeholder="入力してください" type="comment"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="その他重要な事項" class="form-label">その他重要な事項</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <textarea class="form-control" name="その他重要な事項" placeholder="入力してください" type="text"></textarea>
            </div>
        </div>

        <div class="title-main-conten">
            <p>想定収支スキーム</p>
        </div>
        <div class="title-main-item">
            <p>出資金の内訳</p>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="物件価格" class="form-label">物件価格</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input data-for-calculating="true" class="form-control w30" name="物件価格" placeholder="数字を入力"
                        type="number" min="0">
                </div>
                <div class="or">円</div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">出資総額</label>
            </div>
            <div class="coll-md-8 edit-padding text-binding">
                <p data-model="出資総額" data-calculating-result="true" data-output-format="number">0</p> <span
                    style="margin-left: 5px;">円</span>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">募集金額</label>
            </div>
            <div class="coll-md-8 edit-padding text-binding">
                <p data-model="募集金額" data-calculating-result="true" data-output-format="number">0</p>
                <span style="margin-left: 5px;">円</span>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">劣後出資額</label>
            </div>
            <div class="coll-md-8 edit-padding text-binding">
                <p data-model="劣後出資額" data-calculating-result="true" data-output-format="number">0</p> <span
                    style="margin-left: 5px;">円</span>
            </div>
        </div>

        <div class="title-main-item">
            <p>想定収支（収入）</p>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="賃料収入" class="form-label">賃料収入</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input data-for-calculating="true" class="form-control w30" name="賃料収入" placeholder="数字を入力"
                        type="number" min="0">
                </div>
                <div class="or">円</div>
            </div>
        </div>


        <div class="title-main-item">
            <p>想定収支（支出）</p>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="維持管理費" class="form-label">維持管理費</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input data-for-calculating="true" class="form-control w30" name="維持管理費" placeholder="数字を入力"
                        type="number" min="0">
                </div>
                <div class="or">円</div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="修繕積立金" class="form-label">修繕積立金</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input data-for-calculating="true" class="form-control w30" name="修繕積立金" placeholder="数字を入力"
                        type="number" min="0">
                </div>
                <div class="or">円</div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="公租公課" class="form-label">公租公課</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input data-for-calculating="true" class="form-control w30" name="公租公課" placeholder="数字を入力"
                        type="number" min="0">
                </div>
                <div class="or">円</div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="火災保険料" class="form-label">火災保険料</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input data-for-calculating="true" class="form-control w30" name="火災保険料" placeholder="数字を入力"
                        type="number" min="0">
                </div>
                <div class="or">円</div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="PMフィー" class="form-label">PMフィー</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input data-for-calculating="true" class="form-control w30" name="PMフィー" placeholder="数字を入力"
                        type="number" min="0">
                </div>
                <div class="or">円</div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="税理士報酬 " class="form-label">税理士報酬</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input data-for-calculating="true" class="form-control w30" name="税理士報酬" placeholder="数字を入力"
                        type="number" min="0">
                </div>
                <div class="or">円</div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="その他" class="form-label">その他</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input data-for-calculating="true" class="form-control w30" name="その他" placeholder="数字を入力"
                        type="number" min="0">
                </div>
                <div class="or">円</div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="合計" class="form-label">合計</label>
            </div>
            <div class="coll-md-8 edit-padding text-binding">
                <p data-model="合計" data-calculating-result="true" data-output-format="number">0</p> <span
                    style="margin-left: 5px;">円</span>
            </div>
        </div>


        <div class="title-main-item">
            <p>分配金の内訳</p>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="分配原資" class="form-label">分配原資</label>
            </div>
            <div class="coll-md-8 edit-padding text-binding">
                <p data-model="分配原資" data-calculating-result="true" data-output-format="number">0</p> <span
                    style="margin-left: 5px;">円</span>
            </div>
        </div>


        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="全体口数" class="form-label">全体口数</label>
            </div>
            <div class="coll-md-8 edit-padding text-binding">
                <p data-model="全体口数" data-calculating-result="true" data-output-format="number">0</p>
            </div>
        </div>

        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="優先出資分配金" class="form-label">優先出資分配金</label>
            </div>
            <div class="coll-md-8 edit-padding text-binding">
                <p data-model="優先出資分配金" data-calculating-result="true" data-output-format="number">0</p>
                <span style="margin-left: 5px;">円</span>
            </div>
        </div>

        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="1口あたり" class="form-label">1口あたり</label>
            </div>

            <div class="coll-md-8 edit-padding text-binding">
                <p data-model="1口あたり" data-calculating-result="true" data-output-format="number">0</p> <span
                    style="margin-left: 5px;">円</span>
            </div>
        </div>

        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="劣後出資分配金（営業者）" class="form-label">劣後出資分配金（営業者）</label>
            </div>
            <div class="coll-md-8 edit-padding text-binding">
                <p data-model="劣後出資分配金（営業者）" data-calculating-result="true" data-output-format="number">0</p><span
                    style="margin-left: 5px;">円</span>
            </div>
        </div>

        <div class="title-main-item">
            <p>営業者</p>
        </div>

        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="商号" class="form-label">商号</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class=" form-control" name="商号" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="登録" class="form-label">登録</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <textarea class=" form-control" name="登録" placeholder="入力してください" type="text"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="郵便番号" class="form-label">郵便番号</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <input class="form-control w30" name="郵便番号" placeholder="数字を入力" type="text">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">都道府県</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8 edit-padding">
                <div class="w30">
                    <select class="form-select w30" name="都道府県">
                        <option value="" selected>----</option>
                        <option value="北海道">北海道</option>
                        <option value="青森県">青森県</option>
                        <option value="岩手県">岩手県</option>
                        <option value="宮城県">宮城県</option>
                        <option value="秋田県">秋田県</option>
                        <option value="山形県">山形県</option>
                        <option value="福島県">福島県</option>
                        <option value="茨城県">茨城県</option>
                        <option value="栃木県">栃木県</option>
                        <option value="群馬県">群馬県</option>
                        <option value="埼玉県">埼玉県</option>
                        <option value="千葉県">千葉県</option>
                        <option value="東京都">東京都</option>
                        <option value="神奈川県">神奈川県</option>
                        <option value="新潟県">新潟県</option>
                        <option value="富山県">富山県</option>
                        <option value="石川県">石川県</option>
                        <option value="福井県">福井県</option>
                        <option value="山梨県">山梨県</option>
                        <option value="長野県">長野県</option>
                        <option value="岐阜県">岐阜県</option>
                        <option value="静岡県">静岡県</option>
                        <option value="愛知県">愛知県</option>
                        <option value="三重県">三重県</option>
                        <option value="滋賀県">滋賀県</option>
                        <option value="京都府">京都府</option>
                        <option value="大阪府">大阪府</option>
                        <option value="兵庫県">兵庫県</option>
                        <option value="奈良県">奈良県</option>
                        <option value="和歌山県">和歌山県</option>
                        <option value="鳥取県">鳥取県</option>
                        <option value="島根県">島根県</option>
                        <option value="岡山県">岡山県</option>
                        <option value="広島県">広島県</option>
                        <option value="山口県">山口県</option>
                        <option value="徳島県">徳島県</option>
                        <option value="香川県">香川県</option>
                        <option value="愛媛県">愛媛県</option>
                        <option value="高知県">高知県</option>
                        <option value="福岡県">福岡県</option>
                        <option value="佐賀県">佐賀県</option>
                        <option value="長崎県">長崎県</option>
                        <option value="熊本県">熊本県</option>
                        <option value="大分県">大分県</option>
                        <option value="宮崎県">宮崎県</option>
                        <option value="鹿児島県">鹿児島県</option>
                        <option value="沖縄県">沖縄県</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="住所" class="form-label">住所</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="住所" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="建物名" class="form-label">建物名</label>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="建物名" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="代表者" class="form-label">代表者</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="代表者" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="電話番号" class="form-label">電話番号</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="電話番号" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="主な事業" class="form-label">主な事業</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <textarea class="form-control" name="主な事業" placeholder="入力してください" type="text"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="資本金" class="form-label">資本金</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="資本金" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="設立年月日" class="form-label">設立年月日</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="設立年月日" placeholder="入力してください" type="text">
            </div>
        </div>
        <div class="button-submit" style="text-align: center;">
            <button id="submit_form" type="submit" class="base-button submit-button submit_form">
                {{$params['fund_published'] ? '保存' : '一時保存'}}</button>
        </div>
    </form>
</div>

<!-- popup confirm-->
<div class="modal" id="popup_confirm">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center" style="height: 50px;">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body confirm-text">
                <p id="popup_confirm_text"></p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="base-button popup-cancel-btn">キャンセル</button>
                <button id="popup_confirm_submit_button" type="button" class="base-button popup-submit-btn">はい</button>
            </div>
        </div>
    </div>
</div>
<!-- ./ popup confirm-->



<script src="/admin/js/image-file-uploader.js"></script>
<script>
function loadFundDetailInformation(FUND_ID) {
    /**
     * Get data for edit.
     */
    $.get(`/ajax/fund.detail.${FUND_ID}`, function(data) {
        bindDataForForm(data);

        let subImageUrls = [];

        $('#募集期間（日時）_from').datetimepicker({
            format: 'Y-m-d H:i',
        });

        $('#募集期間（日時）_to').datetimepicker({
            format: 'Y-m-d H:i',
        });

        /**
         * Initial data for block サブ画像
         */
        for (let i = 1; i <= 5; i++) {
            let item = getFormDataByFieldName(data, 'サブ画像_' + i);

            if (item && item.value) {
                subImageUrls.push(item.value);
            }
        }
        initialImageFileUploader('サブ画像_img_upload', subImageUrls, 5);

        /**
         * Inital data for block メイン画像
         */
        let img2 = getFormDataByFieldName(data, 'メイン画像');
        initialImageFileUploader('メイン画像_img_upload', img2 && img2.value ? [img2.value] : [], 1);

        /**
         * Inital data for block チラシ画像
         */
        let img3 = getFormDataByFieldName(data, 'チラシ画像');
        initialImageFileUploader('チラシ画像_img_upload', img3 && img3.value ? [img3.value] : [], 1);
    });
}

$(document).ready(function() {
    initFilterInputNumber();

    let FUND_ID = $.urlParam('fund_id');
    setFundHeaderData();
    loadFundDetailInformation(FUND_ID);

    /**
     * Auto saving data when user focus out of fields for calculating
     */
    $('[data-for-calculating="true"]').focusout(function(event) {
        let data = getDataFromForm();
        let element = event.target;

        data = data.filter(function(item) {
            return item.column_name == $(element).attr('name');
        });

        $.ajax({
                url: `/ajax/fund.update.${FUND_ID}`,
                data: JSON.stringify(data),
                type: 'POST',
                contentType: 'application/json',
            })
            .done(function() {
                $.get(`/ajax/fund.detail.${FUND_ID}`, function(data) {
                    let target_update_fields = [];

                    $('[data-calculating-result="true"]').each(function(index,
                        element) {
                        target_update_fields.push(element.dataset.model);
                    });

                    data = data.filter(function(item) {
                        return target_update_fields.includes(item.column_name);
                    });

                    bindDataForForm(data);
                });
            })
            .fail(function(error) {
                showErrorMessage(error.responseJSON);
            });
    });

    $('#preview_fund_button').click(function() {
        window.open(`/fund/detail?fund_id=${FUND_ID}&mode=preview`);
    });

    $(".submit_form").click(function() {
        let btn = $(this);
        btn.addClass('disabled');

        let data = getDataFromForm();

        let query_param = '';
        let mode = 'update';
        let popupConfirmText = ''

        if (btn.text() == '公開') {
            query_param = 'do_validate=true&do_public_fund=true';
            mode = 'public_fund';
        } else if (btn.text() == 'ファンド不成立') {
            mode = 'set_fund_failed';
        }

        /**
         * Handle data for block サブ画像
         */
        let subImages = getDataFromImageFileUploader('サブ画像_img_upload');
        for (let i = 1; i <= 5; i++) {
            if (subImages[i - 1]) {
                data.push({
                    'column_name': `サブ画像_${i}`,
                    'data_type': subImages[i - 1].dataType,
                    'value': subImages[i - 1].file,
                    'file_name': subImages[i - 1].name,
                });
            } else {
                data.push({
                    'column_name': `サブ画像_${i}`,
                    'data_type': 'text',
                    'value': '',
                    'allow_empty': true
                });
            }
        }

        /**
         * Handle data for block メイン画像
         */
        let img2 = getDataFromImageFileUploader('メイン画像_img_upload');
        if (img2[0]) {
            data.push({
                'column_name': `メイン画像`,
                'data_type': img2[0].dataType,
                'value': img2[0].file,
                'file_name': img2[0].name,
            });
        } else {
            data.push({
                'column_name': `メイン画像`,
                'data_type': 'text',
                'value': '',
                'allow_empty': true
            });
        }

        /**
         * Handle data for block チラシ画像
         */
        let img3 = getDataFromImageFileUploader('チラシ画像_img_upload');
        if (img3[0]) {
            data.push({
                'column_name': `チラシ画像`,
                'data_type': img3[0].dataType,
                'value': img3[0].file,
                'file_name': img3[0].name,
            });
        } else {
            data.push({
                'column_name': `チラシ画像`,
                'data_type': 'text',
                'value': '',
                'allow_empty': true
            });
        }

        clearFormValidation();

        if (mode == 'public_fund') {
            popupConfirmText = 'ファンドを公開してもよろしいですか？';
        }

        if (mode == 'set_fund_failed') {
            popupConfirmText = 'ファンドステータスを「不成立」に変更してもよろしいですか？';
        }


        if (mode == 'set_fund_failed' || mode == 'public_fund') {
            var modal = new bootstrap.Modal(document.getElementById('popup_confirm'));
            modal.show();

            $('#popup_confirm_text').text(popupConfirmText);

            $("#popup_confirm_submit_button").unbind("click");
            $('#popup_confirm_submit_button').click(function() {
                if (mode == 'set_fund_failed') {
                    data.push({
                        'column_name': `failed_at`,
                        'data_type': 'text',
                        'value': moment().format('YYYY-MM-DD hh:mm:ss'),
                    });
                }

                $.ajax({
                        url: `/ajax/fund.update.${FUND_ID}?${query_param}`,
                        data: JSON.stringify(data),
                        type: 'POST',
                        contentType: 'application/json',
                    })
                    .done(function() {
                        setFundHeaderData();
                        showMessageSaveSuccessfully('ステータスを変更しました。');

                        btn.removeClass('disabled');

                        loadFundDetailInformation(FUND_ID);

                        setTimeout(function() {
                            location.reload();
                        }, 2000);

                        modal.hide();
                    })
                    .fail(function(error) {
                        showErrorMessage(error.responseJSON, 5000);

                        if (error.responseJSON.error_code == 'required_fields') {
                            displayFormValidation(error.responseJSON.error_fields);
                        }

                        modal.hide();
                        btn.removeClass('disabled');
                    });
            });
        } else {
            $.ajax({
                    url: `/ajax/fund.update.${FUND_ID}?${query_param}`,
                    data: JSON.stringify(data),
                    type: 'POST',
                    contentType: 'application/json',
                })
                .done(function() {
                    setFundHeaderData();
                    showMessageSaveSuccessfully();
                    btn.removeClass('disabled');

                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                })
                .fail(function(error) {
                    showErrorMessage(error.responseJSON, 5000);

                    if (error.responseJSON.error_code == 'required_fields') {
                        displayFormValidation(error.responseJSON.error_fields);
                    }

                    btn.removeClass('disabled');
                });
        }
    });
});
</script>
@endsection
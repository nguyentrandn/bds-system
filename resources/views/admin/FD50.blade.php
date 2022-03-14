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
                <a href="FD30?fund_id={{ request()->get('fund_id') }}"> ファンド情報</a>
            </li>
            <li>
                <a href="FD40?fund_id={{ request()->get('fund_id') }}">申込一覧</a>
            </li>
            <li>
                <a class="color-menu" href="FD50?fund_id={{ request()->get('fund_id') }}"> 投資一覧 </a>
            </li>
            <li>
                <a href="FD60?fund_id={{ request()->get('fund_id') }}"> メッセージ</a>
            </li>
        </ul>
    </div>

    <!-- Phan Contten ben phai  -->
    <form name="myform" onsubmit="return false" class="search-form">
        <div class="container">
            <div class="row table-action-button-group">
                <button class="base-button action-button dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    CSVアップロード
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="width: 149px">
                    <li><a class="dropdown-item" id="POPUP_UPLOAD_DEPOSIT_open_popup"
                            style="font-size: 1.4rem; padding-top: 1rem; padding-bottom: 1rem; cursor: pointer;">入金登録</a></li>
                    <li><a class="dropdown-item" id="POPUP_UPLOAD_WITHDRAWAL_open_popup"
                            style="font-size: 1.4rem; padding-top: 1rem; padding-bottom: 1rem; cursor: pointer;">出金登録</a></li>
                </ul>

                <button id="button_download_csv" class="base-button action-button">CSVダウンロード</button>
            </div>

            <div class="row tb">
                <table class="table table-bordered" id="table_data">
                    <tr>
                        <th style="width: 80px;">入金状況</th>
                        <th style="width: 120px; text-align: center;">申込日 <br> 抽選日</th>
                        <th style="width: 80px; text-align: left;">お名前</th>
                        <th style="width: 110px; text-align: right;">投資金額 <br> （口数）</th>
                        <th style="width: 120px; text-align: center;">入金期限 <br> 入金日</th>
                        <th style="width: 70px; text-align: center;">分配日</th>
                        <th style="width: 70px; text-align: left;">摘要</th>
                        <th style="width: 100px; text-align: right;">出金額 <br> （税引前）</th>
                        <th class="option"></th>
                    </tr>
                </table>
            </div>
        </div>
    </form>
    <!-- Ket thuc phan Contten  -->
</div>


<!-- FD51 Edit deposit -->
<div class="modal" id="FD51_popup_edit_deposit">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title w-100">入金登録</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class="row-conten g-3" id="deposit_form" onsubmit="return false">
                    <div class="form-group">
                        <div class="coll-md-3">
                            <label class="form-label" style="width: auto;">お名前</label>
                        </div>
                        <div class="coll-md-8 fixed-text" data-model="お名前">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="coll-md-3 ">
                            <label for="抽選結果" class="form-label" style="width: auto;">投資金額</label>
                        </div>
                        <div class="coll-md-8 fixed-text">
                            <b data-model="投資金額"></b>
                        </div>
                    </div>
                    <div class="form-group datetime-picker">
                        <div class="coll-md-3">
                            <label class="form-label" style="width: auto;">入金日</label>
                        </div>
                        <div class="coll-md-8 edit-padding">
                            <div class="w30">
                                <input style="margin-left: -0.1rem;" class="form-control w30" name="入金日" id="txtdate"
                                    placeholder="🗓&emsp; 日付を入力">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="base-button popup-cancel-btn" data-bs-dismiss="modal">キャンセル</button>
                <button id="update_deposit_button" type="button" class="base-button popup-submit-btn">保存</button>
            </div>
        </div>
    </div>
</div>
<!-- ./ FD51 Edit deposit  -->


<!-- FD52 Edit withdrawal -->
<div class="modal" id="FD52_popup_edit_withdrawal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title w-100">出金登録アップロード</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class="row-conten g-3" id="withdrawal_form" onsubmit="return false">
                    <div class="form-group">
                        <div class="coll-md-3">
                            <label class="form-label" style="width: auto;">お名前</label>
                        </div>
                        <div class="coll-md-8 fixed-text" data-model="お名前">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="coll-md-3 ">
                            <label for="抽選結果" class="form-label" style="width: auto;">摘要</label>
                            <div class="nhan">必須</div>
                        </div>
                        <div class="coll-md-8 edit-padding">
                            <div class="w30">
                                <select style="margin-left: -0.3rem;" class="form-select w30" name="摘要">
                                    <option value="" selected>選択してください</option>
                                    <option value="分配金">分配金</option>
                                    <option value="分配金＋投資金額">分配金＋投資金額</option>
                                    <option value="投資金額">投資金額</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group datetime-picker">
                        <div class="coll-md-3">
                            <label class="form-label" style="width: auto;">入金日</label>
                        </div>
                        <div class="coll-md-8 edit-padding">
                            <div class="w30">
                                <input style="margin-left: -0.3rem;" class="form-control w30" name="出金登日"
                                    placeholder="🗓&emsp; 日付を入力">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="coll-md-3 ">
                            <label for="郵便番号" class="form-label">金額</label>
                        </div>
                        <div class="coll-md-8 edit-padding">
                            <div class="w30">
                                <input type="number" style="margin-left: -0.3rem;" class="form-control w30" name="金額"
                                    placeholder="数字を入力" />
                            </div>
                            <div class="or">円</div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="base-button popup-cancel-btn" data-bs-dismiss="modal">キャンセル</button>
                <button type="button" id="update_withdrawal_button" class="base-button popup-submit-btn">保存</button>
            </div>
        </div>
    </div>
</div>
<!-- ./ FD52 Edit withdrawal -->


<!-- FD55 Popup upload deposit -->
<div class="modal" id="POPUP_UPLOAD_DEPOSIT">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title w-100" id="POPUP_UPLOAD_DEPOSIT_header">入金登録アップロード</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" style="margin-top: 30px; min-height: 300px;">
                <div id="POPUP_UPLOAD_DEPOSIT_step_input">
                    <div class="container-fluid" style="width: 650px;">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-6">Step１．アップロード用CSVファイルを取得</div>
                            <div class="col-md-6" style="padding-left: 13rem;">
                                <a href="/ajax/deposit/csv/get_upload_format">ファイルのダウンロード</a>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center" style="padding-top: 5rem;">
                            <div class="col-md-6">Step2．対象のCSVファイルを選択</div>
                            <div class="col-md-6" style="padding-left: 13rem;">
                                <input id="POPUP_UPLOAD_DEPOSIT_file_input" type="file" />
                            </div>
                        </div>
                        <div class="row d-flex align-items-center" style="padding-top: 5rem;">
                            <div class="col-md-6">Step3．アップロード</div>
                            <div class="col-md-6" style="padding-left: 13rem;">
                                <button id="POPUP_UPLOAD_DEPOSIT_upload_button" type="button"
                                    class="base-button popup-submit-btn">アップロード</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="POPUP_UPLOAD_DEPOSIT_on_success" class="text-center d-none">
                    <br />
                    <br />
                    <br />
                    <p class="">更新が完了しました</p>
                    <br />
                    <br />
                    <br />
                    <button style="margin-top: 7rem;" type="button" class="base-button popup-submit-btn"
                        data-bs-dismiss="modal">閉じる</button>
                    <br />
                    <br />
                </div>

                <div id="POPUP_UPLOAD_DEPOSIT_on_failed" class="d-none">
                    <div class="container-fluid">
                        <div class="row p-3 d-flex align-items-center" style="margin-left: 20%;">
                            <p style="font-weight: 700; line-height: 2.5rem;">
                                アップロードが失敗しました。<br />
                                ファイルの形式やヘッダーに間違えがないかご確認ください。
                            </p>
                        </div>
                        <div class="row p-3 d-flex align-items-center" style="margin-left: 16%;">
                            <p style="line-height: 2.5rem;">
                                ＜よくあるエラー原因＞<br />
                                ・ヘッダーがない<br />
                                ・ヘッダーの名前が間違っている（アップロード用ファイルをお使いください）<br />
                                ・利用できない項目名が使われている（ステータス名の間違い）<br />
                                ・日付形式が間違っている（yyyy-mm-ddの形式でない）<br />
                            </p>
                        </div>
                        <div class="row d-flex" style="margin-top: 2rem; justify-content: center;">
                            <button type="button" class="base-button popup-submit-btn"
                                data-bs-dismiss="modal">閉じる</button>
                        </div>
                        <br />
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ./ FD55 Popup upload deposit -->

<!-- FD56 Popup upload withdrawal -->
<div class="modal" id="POPUP_UPLOAD_WITHDRAWAL">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title w-100" id="POPUP_UPLOAD_WITHDRAWAL_header">出金登録アップロード</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" style="margin-top: 30px; min-height: 300px;">
                <div id="POPUP_UPLOAD_WITHDRAWAL_step_input">
                    <div class="container-fluid" style="width: 650px;">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-6">Step１．アップロード用CSVファイルを取得</div>
                            <div class="col-md-6" style="padding-left: 13rem;">
                                <a href="/ajax/withdrawal/csv/get_upload_format">ファイルのダウンロード</a>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center" style="padding-top: 5rem;">
                            <div class="col-md-6">Step2．対象のCSVファイルを選択</div>
                            <div class="col-md-6" style="padding-left: 13rem;">
                                <input id="POPUP_UPLOAD_WITHDRAWAL_file_input" type="file" />
                            </div>
                        </div>
                        <div class="row d-flex align-items-center" style="padding-top: 5rem;">
                            <div class="col-md-6">Step3．アップロード</div>
                            <div class="col-md-6" style="padding-left: 13rem;">
                                <button id="POPUP_UPLOAD_WITHDRAWAL_upload_button" type="button"
                                    class="base-button popup-submit-btn">アップロード</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="POPUP_UPLOAD_WITHDRAWAL_on_success" class="text-center d-none">
                    <br />
                    <br />
                    <br />
                    <p class="">更新が完了しました</p>
                    <br />
                    <br />
                    <br />
                    <button style="margin-top: 7rem;" type="button" class="base-button popup-submit-btn"
                        data-bs-dismiss="modal">閉じる</button>
                    <br />
                    <br />
                </div>

                <div id="POPUP_UPLOAD_WITHDRAWAL_on_failed" class="d-none">
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center" style="margin-left: 20%;">
                            <p style="font-weight: 700; line-height: 2.5rem;">
                                アップロードが失敗しました。<br />
                                ファイルの形式やヘッダーに間違えがないかご確認ください。
                            </p>
                        </div>
                        <div class="row d-flex align-items-center" style="margin-left: 16%;">
                            <p style="line-height: 2.5rem;">
                                ＜よくあるエラー原因＞<br />
                                ・ヘッダーがない<br />
                                ・ヘッダーの名前が間違っている（アップロード用ファイルをお使いください）<br />
                                ・利用できない項目名が使われている（ステータス名の間違い）<br />
                                ・日付形式が間違っている（yyyy-mm-ddの形式でない）<br />
                            </p>
                        </div>
                        <div class="row d-flex" style="margin-top: 2rem; justify-content: center;">
                            <button type="button" class="base-button popup-submit-btn"
                                data-bs-dismiss="modal">閉じる</button>
                        </div>
                        <br />
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ./ FD56 Popup upload withdrawal -->


<script>
function loadTableData(conditions) {
    if (!conditions) {
        conditions = [];
    }

    conditions.push({
        column_name: 'fund_id',
        search_operator: '=',
        value: $.urlParam('fund_id')
    });

    $.ajax({
            url: "/ajax/investor/list",
            data: JSON.stringify(conditions),
            type: 'POST',
            contentType: 'application/json',
        })
        .done(function(data) {
            let items = '';

            data.result.forEach(function(data) {
                let period_date = '';

                items += `
                <tr>
                    <td style="width: 80px;">${data['入金状況']}</td>
                    <td style="width: 120px; text-align: center; line-height: 2rem;">${data['申込日']  || '-'} <br/> ${data['抽選日'] || '-'} </td>
                    <td style="width: 80px; text-align: left;">${data['お名前']}</td>
                    <td style="width: 110px; text-align: right; line-height: 2rem;">${data['投資金額'] || '-'}<br/> (${data['当選口数']})</td>
                    <td style="width: 120px; text-align: center; line-height: 2rem;">${data['入金期限'] || '-'}<br/> ${data['入金日'] || '-'}</td>
                    <td style="width: 120px; text-align: center;">${data['分配日' || '-']}</td>
                    <td style="width: 70px; text-align: left;">${data['摘要'] || '-'}</td>
                    <td style="width: 70px; text-align: right;">${data['出金額（税引前）'] || '-'}</td>
                    <td style="text-align: center;">
                        <button data-deposit-amount="${data['投資金額'] || '-'}" data-user-id="${data['user_id']}" class="base-button table-action-button deposit-registration-btn mb-3" name="入金登録 ">入金登録</button>
                        <button data-user-id="${data['user_id']}" class="base-button table-action-button withdrawal-registration-btn" name="出金登録 ">出金登録</button>
                    </td>
                </tr>
                `
            });

            $("#table_data").find("tr:gt(0)").remove();
            $('#table_data').append(items);

            /**
             * Popup edit deposit
             */
            $('.deposit-registration-btn').click(function(event) {
                let USER_ID = event.target.dataset.userId;
                let FUND_ID = $.urlParam('fund_id');
                let DEPOSIT_AMOUNT = event.target.dataset.depositAmount;

                $('#deposit_form')[0].reset();

                var myModal = new bootstrap.Modal(document.getElementById(
                    'FD51_popup_edit_deposit'));
                myModal.show();

                /**
                 * Get data for edit.
                 */
                $.get(`/ajax/deposit/detail/${FUND_ID}/${USER_ID}`, function(data) {
                    bindDataForForm(data, '#deposit_form');
                    $('[data-model="投資金額"]').text(DEPOSIT_AMOUNT);

                    /**
                     * Binding save action to button.
                     */
                    $("#update_deposit_button").unbind("click");
                    $('#update_deposit_button').click(function() {
                        let btn = $(this);
                        btn.addClass('disabled');

                        let data = getDataFromForm('#deposit_form');

                        data.push({
                            "column_name": "入金状況",
                            "data_type": "text",
                            "value": '入金済',
                        });

                        $.ajax({
                                url: `/ajax/deposit/update/${FUND_ID}/${USER_ID}`,
                                data: JSON.stringify(data),
                                type: 'POST',
                                contentType: 'application/json',
                            })
                            .done(function() {
                                showMessageSaveSuccessfully();
                                loadTableData();

                                var to = setTimeout(() => {
                                    myModal.hide();
                                    clearTimeout(to);
                                    btn.removeClass('disabled');
                                }, 2000);
                            })
                            .fail(function(error) {
                                showErrorMessage(error.responseJSON);
                                btn.removeClass('disabled');
                            });
                    });
                });
            });

            /**
             * Popup edit withdrawal
             */
            $('.withdrawal-registration-btn').click(function(event) {
                let USER_ID = event.target.dataset.userId;
                let FUND_ID = $.urlParam('fund_id');

                $('#withdrawal_form')[0].reset();

                var myModal = new bootstrap.Modal(document.getElementById(
                    'FD52_popup_edit_withdrawal'));
                myModal.show();


                /**
                 * Get data for edit.
                 */
                $.get(`/ajax/withdrawal/detail/${FUND_ID}/${USER_ID}`, function(data) {
                    bindDataForForm(data, '#withdrawal_form');

                    /**
                     * Binding save action to button.
                     */
                    $("#update_withdrawal_button").unbind("click");
                    $('#update_withdrawal_button').click(function() {
                        let btn = $(this);
                        btn.addClass('disabled');

                        let data = getDataFromForm('#withdrawal_form');

                        $.ajax({
                                url: `/ajax/deposit/update/${FUND_ID}/${USER_ID}`,
                                data: JSON.stringify(data),
                                type: 'POST',
                                contentType: 'application/json',
                            })
                            .done(function() {
                                showMessageSaveSuccessfully();
                                loadTableData();

                                var to = setTimeout(() => {
                                    myModal.hide();
                                    clearTimeout(to);
                                    btn.removeClass('disabled');
                                }, 2000);
                            })
                            .fail(function(error) {
                                showErrorMessage(error.responseJSON);
                                btn.removeClass('disabled');
                            });
                    });
                });
            });
        })
        .fail(function(error) {
            showErrorMessage(error.responseJSON);
        });
}


$(document).ready(function() {
    setFundHeaderData();
    loadTableData();

    /**
     * Deposit Upload
     */
    let deposit_upload_popup_base_name = 'POPUP_UPLOAD_DEPOSIT';

    $(`#${deposit_upload_popup_base_name}_open_popup`).click(function() {
        var myModal = new bootstrap.Modal(document.getElementById(deposit_upload_popup_base_name));

        $(`#${deposit_upload_popup_base_name}_step_input`).show();
        $(`#${deposit_upload_popup_base_name}_on_success`).hide();
        $(`#${deposit_upload_popup_base_name}_on_failed`).hide();
        $(`#${deposit_upload_popup_base_name}_file_input`).val(null);

        myModal.show();
    });

    let fund_deposit_file;

    $(`#${deposit_upload_popup_base_name}_file_input`).on('change', function(input) {
        if (input.target.files && input.target.files[0]) {
            fund_deposit_file = input.target.files[0];
        }
    });

    $(`#${deposit_upload_popup_base_name}_upload_button`).click(function() {
        let btn = $(this);
        if (!fund_deposit_file) return;

        let FUND_ID = $.urlParam('fund_id');

        var formData = new FormData();
        formData.append('file', fund_deposit_file);

        btn.addClass('disabled');
        $.ajax({
                url: "/ajax/deposit/csv/upload/" + FUND_ID,
                method: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
            })
            .done(function() {
                $(`#${deposit_upload_popup_base_name}_step_input`).hide();
                $(`#${deposit_upload_popup_base_name}_on_success`).removeClass('d-none').fadeIn();

                loadTableData();
                btn.removeClass('disabled');
            })
            .fail(function() {
                $(`#${deposit_upload_popup_base_name}_step_input`).hide();
                $(`#${deposit_upload_popup_base_name}_on_failed`).removeClass('d-none').fadeIn();
                btn.removeClass('disabled');
            });
    });
    /**
     * ---------------------------------------------------------------------------------------
     */


    /**
     * Withdrawal Upload
     */
    let withdrawal_upload_popup_base_name = 'POPUP_UPLOAD_WITHDRAWAL';

    $(`#${withdrawal_upload_popup_base_name}_open_popup`).click(function() {
        var myModal = new bootstrap.Modal(document.getElementById(withdrawal_upload_popup_base_name));

        $(`#${withdrawal_upload_popup_base_name}_step_input`).show();
        $(`#${withdrawal_upload_popup_base_name}_on_success`).hide();
        $(`#${withdrawal_upload_popup_base_name}_on_failed`).addClass('d-none').hide();
        $(`#${withdrawal_upload_popup_base_name}_file_input`).val(null);

        myModal.show();
    });

    let fund_withdrawal_file;

    $(`#${withdrawal_upload_popup_base_name}_file_input`).on('change', function(input) {
        if (input.target.files && input.target.files[0]) {
            fund_withdrawal_file = input.target.files[0];
        }
    });

    $(`#${withdrawal_upload_popup_base_name}_upload_button`).click(function() {
        let btn = $(this);
        if (!fund_withdrawal_file) return;

        let FUND_ID = $.urlParam('fund_id');

        var formData = new FormData();
        formData.append('file', fund_withdrawal_file);

        btn.addClass('disabled');
        $.ajax({
                url: "/ajax/withdrawal/csv/upload/" + FUND_ID,
                method: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
            })
            .done(function() {
                $(`#${withdrawal_upload_popup_base_name}_step_input`).hide();
                $(`#${withdrawal_upload_popup_base_name}_on_success`).removeClass('d-none')
                    .fadeIn();

                loadTableData();
                btn.removeClass('disabled');
            })
            .fail(function() {
                $(`#${withdrawal_upload_popup_base_name}_step_input`).hide();
                $(`#${withdrawal_upload_popup_base_name}_on_failed`).removeClass('d-none').fadeIn();
                btn.removeClass('disabled');
            });
    });
    /**
     * ---------------------------------------------------------------------------------------
     */

    $('#button_download_csv').click(function() {
        let conditions = [];
        conditions.push({
            column_name: 'fund_id',
            search_operator: '=',
            value: $.urlParam('fund_id')
        });

        downloadCSV('/ajax/investor/csv/download', conditions);
    });
});
</script>
@endsection
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
                <a class="color-menu" href="FD40?fund_id={{ request()->get('fund_id') }}">申込一覧</a>
            </li>
            <li>
                <a href="FD50?fund_id={{ request()->get('fund_id') }}"> 投資一覧 </a>
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
                <button id="button_upload_csv_fund_results" class="base-button action-button">CSVアップロード</button>
                <button id="button_download_csv" class="base-button action-button">CSVダウンロード</button>
            </div>

            <div class="row tb">
                <table class="table table-bordered" id="table_data">
                    <caption></caption>
                    <tr>
                        <th style="width: 100px; text-align: left;">抽選<br/>ステータス</th>
                        <th style="width: 150px; text-align: center;">申込日</th>
                        <th style="width: 150px; text-align: left;">お名前</th>
                        <th style="width: 180px; text-align: right;">申込金額 <br> (申込口数)</th>
                        <th style="width: 180px; text-align: right;">当選金額 <br> (当選口数)</th>
                        <th class="tbdate">キャンセル日</th>
                        <th class="option"></th>
                    </tr>
                </table>
            </div>
        </div>
    </form>
    <!-- Ket thuc phan Contten  -->
</div>


<!-- FD41 Input Lottery Result Popup -->
<div class="modal" id="FD41_input_lottery_result_modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title w-100">抽選管理</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class="row-conten g-3" id="form" onsubmit="return false">
                    <div class="form-group">
                        <div class="coll-md-3">
                            <label class="form-label" style="width: auto;">お名前</label>
                        </div>
                        <div class="coll-md-8 fixed-text" data-model="お名前">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="coll-md-3 ">
                            <label for="抽選結果" class="form-label" style="width: auto;">抽選結果</label>
                            <div class="nhan">必須</div>
                        </div>
                        <div class="coll-md-8 ">
                            <input id="1-option" value="当選" name="抽選結果" type="radio"> <label for="1-option">
                                当選</label>
                            <input id="2-option" value="落選" name="抽選結果" type="radio"> <label for="2-option">
                                落選</label>
                            <input id="2-option" value="再当選" name="抽選結果" type="radio"> <label for="2-option">
                                再当選</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="coll-md-3 ">
                            <label class="form-label" style="width: auto;">口数</label>
                        </div>
                        <div class="coll-md-8 edit-padding">
                            <div class="w30">
                                <input style="margin-left: -0.3rem;" class="form-control w30" name="当選口数"
                                    placeholder="数字を入力" type="number" min="0">
                            </div>
                            <span style="padding: 0;" class="mark-text">※当選／再当選の場合のみ必須</span>
                        </div>
                    </div>
                    <div class="form-group datetime-picker">
                        <div class="coll-md-3">
                            <label class="form-label" style="width: auto;">入金期限</label>
                        </div>
                        <div class="coll-md-8 edit-padding">
                            <div class="w30">
                                <input style="margin-left: -0.3rem;" class="form-control w30" name="入金期限" id="txtdate"
                                    placeholder="🗓&emsp; 日付を入力 ">
                            </div>
                            <span style="padding: 0;" class="mark-text">※当選／再当選の場合のみ必須</span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" id="cancel_application_button" class="base-button popup-cancel-btn"
                    data-bs-dismiss="modal">キャンセル</button>
                <button type="button" id="update_lottery_result_button" class="base-button popup-submit-btn">保存</button>
            </div>
        </div>
    </div>
</div>
<!-- ./ FD41 Input Lottery Result Popup -->


<!-- Popup confirm cancel application -->
<div class="modal" id="popup_confirm_cancel_application">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center" style="height: 50px;">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body confirm-text">
                <p>キャンセルしてもよろしいですか？</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="base-button popup-cancel-btn">キャンセル</button>
                <button id="confirm_cancel_application_button" type="button"
                    class="base-button popup-submit-btn">はい</button>
            </div>
        </div>
    </div>
</div>
<!-- ./ Popup confirm cancel application -->

<!-- Popup upload CSV fun results | FD45_ファンド（結果アップロード） -->
<div class="modal" id="popup_upload_fund_results">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title w-100" id="popup_upload_fund_results_header">当選結果アップロード</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" style="margin-top: 4rem; min-height: 300px;">
                <div id="popup_upload_fund_results_step_input">
                    <div class="container-fluid" style="width: 650px;">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-6">Step１．アップロード用CSVファイルを取得</div>
                            <div class="col-md-6" style="padding-left: 13rem;">
                                <a href="/ajax/fund_application/csv/get_upload_format">ファイルのダウンロード</a>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center" style="padding-top: 5rem;">
                            <div class="col-md-6">Step2．対象のCSVファイルを選択</div>
                            <div class="col-md-6" style="padding-left: 13rem;">
                                <input id="fund_result_file_input" type="file" />
                            </div>
                        </div>
                        <div class="row d-flex align-items-center" style="padding-top: 5rem;">
                            <div class="col-md-6">Step3．アップロード</div>
                            <div class="col-md-6" style="padding-left: 13rem;">
                                <button id="upload_fund_result_btn" type="button"
                                    class="base-button popup-submit-btn">アップロード</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="popup_upload_fund_results_on_success" class="text-center d-none">
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

                <div id="popup_upload_fund_results_on_failed" class="d-none">
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
<!-- Popup upload CSV fun results | FD45_ファンド（結果アップロード） -->

<script>
function loadTableData() {
    let conditions = [];
    conditions.push({
        column_name: 'fund_id',
        search_operator: '=',
        value: $.urlParam('fund_id')
    });

    $.ajax({
            url: "/ajax/fund_application/list",
            data: JSON.stringify(conditions),
            type: 'POST',
            contentType: 'application/json',
        })
        .done(function(data) {
            let items = '';

            data.result.forEach(function(data) {
                let period_date = '';

                let btnCancel = `
                    <button data-user-id="${data['user_id']}" class="base-button table-action-button cancel-application-btn mb-3" name="キャンセル ">キャンセル</button>
                `;

                let btnEdit = `
                    <button data-user-id="${data['user_id']}" class="base-button table-action-button edit-lottery-result-btn" name="抽選結果入力 ">抽選結果入力</button>
                `;

                if (data['抽選ステータス'] == 'キャンセル') {
                    btnCancel =
                        '<button class="base-button table-action-button mb-3 disabled" name="キャンセル ">キャンセル</button>';
                    btnEdit =
                        '<button class="base-button table-action-button disabled" name="抽選結果入力 ">抽選結果入力</button>';
                }

                items += `
                <tr>
                    <td style="width: 100px; text-align: left;">${data['抽選ステータス'] || '申込'}</td>
                    <td style="width: 150px; text-align: center;">${data['申込日']  || '-'}</td>
                    <td style="width: 150px; text-align: left;">${data['お名前']}</td>
                    <td style="width: 180px; text-align: right;">${data['申込金額'] || '-'}<br/> (${data['申込口数']})</td>
                    <td style="width: 180px; text-align: right;">${data['当選金額'] || '-'}<br/> (${data['当選口数']})</td>
                    <td class="tbdate">${data['キャンセル日']}</td>
                    <td class="option" style="text-align: center;">
                        ${btnCancel}
                        ${btnEdit}
                    </td>
                </tr>
                `
            });

            $("#table_data").find("tr:gt(0)").remove();
            $('#table_data').append(items);

            /**
             * Popup mamage lottery information
             */
            $('.edit-lottery-result-btn').click(function(event) {
                let USER_ID = event.target.dataset.userId;
                let FUND_ID = $.urlParam('fund_id');


                var myModal = new bootstrap.Modal(document.getElementById(
                    'FD41_input_lottery_result_modal'));
                $('#form')[0].reset();

                myModal.show();

                /**
                 * Get data for edit.
                 */
                $.get(`/ajax/fund_application/detail/${FUND_ID}/${USER_ID}`, function(data) {
                    bindDataForForm(data, 'form');

                    /**
                     * Binding save action to button.
                     */
                    $("#update_lottery_result_button").unbind("click");
                    $('#update_lottery_result_button').click(function() {
                        let btn = $(this);
                        btn.addClass('disabled');

                        let data = getDataFromForm('form');

                        data.push({
                            "column_name": "抽選日",
                            "data_type": "text",
                            "value": moment().format('YYYY-MM-DD'),
                        });

                        $.ajax({
                                url: `/ajax/fund_application/update/${FUND_ID}/${USER_ID}`,
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
             * Cacel application
             */
            $('.cancel-application-btn').click(function() {
                let USER_ID = event.target.dataset.userId;
                let FUND_ID = $.urlParam('fund_id');

                var myModal = new bootstrap.Modal(document.getElementById(
                    'popup_confirm_cancel_application'));
                myModal.show();

                /**
                 * Binding save action to button.
                 */
                $("#confirm_cancel_application_button").unbind("click");
                $('#confirm_cancel_application_button').click(function() {
                    let btn = $(this);
                    btn.addClass('disabled');

                    /**
                     * Set cancel time
                     */
                    var data = [{
                            "column_name": "キャンセル日",
                            "data_type": "text",
                            "value": moment().format('YYYY-MM-DD hh:mm:ss'),
                        },
                        {
                            "column_name": "抽選結果",
                            "data_type": "text",
                            "value": 'キャンセル',
                        },
                    ];

                    $.ajax({
                            url: `/ajax/fund_application/update/${FUND_ID}/${USER_ID}`,
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
        })
        .fail(function(error) {
            showErrorMessage(error.responseJSON);
        });
}


$(document).ready(function() {
    setFundHeaderData();
    loadTableData();

    /**
     * Open popup upload CSV fun results application
     */
    $('#button_upload_csv_fund_results').click(function() {
        var myModal = new bootstrap.Modal(document.getElementById('popup_upload_fund_results'));

        $('#popup_upload_fund_results_step_input').show();
        $('#popup_upload_fund_results_on_success').hide();
        $('#popup_upload_fund_results_on_failed').hide();
        $('#fund_result_file_input').val(null);

        myModal.show();
    });

    let fund_result_file;

    $('#fund_result_file_input').on('change', function(input) {
        if (input.target.files && input.target.files[0]) {
            fund_result_file = input.target.files[0];
        }
    });

    $('#upload_fund_result_btn').click(function() {
        let btn = $(this);
        if (!fund_result_file) return;

        let FUND_ID = $.urlParam('fund_id');

        var formData = new FormData();
        formData.append('file', fund_result_file);

        btn.addClass('disabled');
        $.ajax({
                url: "/ajax/fund_application/csv/upload/" + FUND_ID,
                method: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
            })
            .done(function() {
                $('#popup_upload_fund_results_step_input').hide();
                $('#popup_upload_fund_results_on_success').removeClass('d-none').fadeIn();
                loadTableData();
                btn.removeClass('disabled');
            })
            .fail(function() {
                $('#popup_upload_fund_results_step_input').hide();
                $('#popup_upload_fund_results_on_failed').removeClass('d-none').fadeIn();
                btn.removeClass('disabled');
            });
    });

    $('#button_download_csv').click(function() {
        let conditions = [];
        conditions.push({
            column_name: 'fund_id',
            search_operator: '=',
            value: $.urlParam('fund_id')
        });

        downloadCSV('/ajax/fund_application/csv/download', conditions);
    });
});
</script>
@endsection
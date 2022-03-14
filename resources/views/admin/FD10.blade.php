@extends('layout.q_admin')

@section('breadcrumb')
<div id="breadcrumbs">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>ファンド一覧</a></li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<form id="form" name="myform" onsubmit="return false ">
    <div class="container search-form">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <label class="col-lg-4 fw col-form-label">ファンド名</label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" placeholder="入力してください" name="ファンド名" autocomplete="off"
                            data-search-operator="like" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row datetime-picker">
                    <label class="col col-lg-3">募集期間</label>
                    <div class="col col-lg-4">
                        <input class="form-control w30" placeholder="🗓&emsp;開始日を入力" type="text" name="募集期間（日時）_from"
                            autocomplete="off" data-search-operator="<=" />
                    </div>
                    <div class="col col-lg-1 divison-icon">~</div>
                    <div class="col col-lg-4">
                        <input class="form-control" placeholder="🗓&emsp;終了日を入力" type="text" name="募集期間（日時）_to"
                            autocomplete="off" data-search-operator=">=" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <label for="inputState" class="form-label col-lg-4">ファンドステータス</label>
                    <div class="col-lg-7">
                        <select id="inputState" class="form-select" name="ファンドステータス" data-search-operator="=">
                            <option value="" selected>選択してください</option>
                            <option value="作成中"> 作成中</option>
                            <option value="募集前">募集前</option>
                            <option value="募集中">募集中</option>
                            <option value="募集終了">募集終了</option>
                            <option value="不成立">不成立</option>
                            <option value="運用中">運用中</option>
                            <option value="運用終了">運用終了</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row action-button-group">
            <button type="reset" class="base-button cancel-button" id="reset_form_button" name="クリア">クリア</button>
            <button class="base-button submit-button" id="search_button" name="検索">検索</button>
        </div>

        <div class="row table-action-button-group">
            <button class="base-button action-button" onclick="location.href='/admin/FD20'">新規作成</button>
            <button class="base-button action-button" id="button_download_csv" name="CSVダウンロード ">CSVダウンロード</button>
        </div>

        <div class="row">
            <table class="table table-bordered" id="table_data">
                <tr>
                    <th class="name">ファンド名</th>
                    <th class="text-center" style="width: 100px;">ステータス</th>
                    <th class="time">募集期間</th>
                    <th class="text-center" style="width: 100px;">残り日数</th>
                    <th style="width: 150px; text-align: right;">応募金額<br>（口数/人数)</th>
                    <th style="width: 150px; text-align: right;">募集金額</th>
                    <th class="text-center" style="width: 50px;"></th>
                </tr>
            </table>
        </div>
    </div>
</form>

<script>
function loadListFunds(conditions) {

    $.ajax({
            url: "/ajax/fund.list",
            data: JSON.stringify(conditions),
            type: 'POST',
            contentType: 'application/json',
        })
        .done(function(data) {
            let items = '';

            data.result.forEach(function(data) {
                let cR = '';
                let fundName = `
                    <td class="name"><a href="/admin/FD30?fund_id=${data['id']}">${data['ファンド名'] || '下書き'}</a></td>
                `;

                if (!data['ファンド名']) {
                    fundName = `
                        <td class="name" style="color: #dd4b39;">下書き</td>
                    `;
                    cR =
                    `onclick="location.href='/admin/FD30?fund_id=${data['id']}'" style="cursor: pointer;"`;
                }

                items += `
                <tr ${cR}>
                    ${fundName}
                    <td style="width: 100px; text-align: center;"><span style="background-color: ${getFundStatusColorByName(data['ファンドステータス'])};" class="fund-status-label">${data['ファンドステータス']  || '-'}</span></td>
                    <td style="width: 200px; text-align: center;">${data['募集期間'] || '-'}</td>
                    <td style="width: 100px; text-align: center;">${data['残り日数']  || '-'}</td>
                    <td style="width: 150px; text-align: right;">${data['応募金額']} <br/> (${data['口数'] || '-'}/${data['人数'] || '-'})</td>
                    <td style="width: 150px; text-align: right;">${data['募集金額']}</td>
                    <td style="width: 100px;" class="text-center">
                        <a title="コピーして新規作成する" class="copy_and_create_new_button">
                            <img data-fund-id="${data['id']}" style="width: 20px; cursor: pointer;" src="/admin/image/copy_and_create_new.svg" />
                        </a>
                    </td>
                </tr>
                `
            });

            $("#table_data").find("tr:gt(0)").remove();
            $('#table_data').append(items);


            $('.copy_and_create_new_button').click(function(event) {
                let btn = $(this);
                let FUND_ID = event.target.dataset.fundId;
                
                btn.addClass('disabled');
                event.preventDefault();

                $.ajax({
                        url: '/ajax/fund.clone.' + FUND_ID,
                        type: 'POST',
                        contentType: 'application/json',
                    })
                    .done(function(response) {
                        showMessageCreateSuccessfully();
                        loadListFunds();
                        btn.removeClass('disabled');
                    })
                    .fail(function(error) {
                        showErrorMessage(error.responseJSON);
                        btn.removeClass('disabled');
                    });;
            });
        })
        .fail(function(error) {
            showErrorMessage(error.responseJSON);
        });
}

function doSearch() {
    let search_conditions = getDataFromForm('form');
    loadListFunds(search_conditions);
}

$(document).ready(function() {
    loadListFunds();

    /**
     * Handle press enter key
     */
    $(document).on('keypress', function(e) {
        if (e.which == 13) {
            doSearch();
        }
    });

    $('#reset_form_button').click(function() {
        loadListFunds();
    });

    $('#search_button').click(function() {
        doSearch();
    });

    $('#button_download_csv').click(function() {
        let search_conditions = getDataFromForm('form');
        downloadCSV('/ajax/fund/csv/download', search_conditions);
    });
});
</script>
@endsection
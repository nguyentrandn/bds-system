@extends('layout.q_admin')

@section('breadcrumb')
<div id="breadcrumbs">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>お知らせ一覧</a></li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<form id="form" name="myform" onsubmit="return false">
    <div class="container search-form">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <label for="inputEmail3" class="col-lg-3 fw col-form-label">タイトル</label>
                    <div class="col-lg-7">
                        <input type="text" class=" form-control" placeholder="入力してください" name="タイトル" data-search-operator="like" />
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row datetime-picker">
                    <label class="col col-lg-3">公開期間</label>
                    <div class="col col-lg-4">
                        <input class="form-control" placeholder="🗓&emsp;開始日を入力" type="text" name="公開期間_from"
                            data-search-operator="<=" />
                    </div>
                    <div class="col col-lg-1 divison-icon">~</div>
                    <div class="col col-lg-4">
                        <input class="form-control" placeholder="🗓&emsp;終了日を入力" type="text" name="公開期間_to" 
                        data-search-operator=">=" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 2rem;">
            <label for="inputState" class="col-lg-2 fw col-form-label" style="width: 13%;">宛先</label>
            <div class="col-lg-10 d-flex align-items-center" style="padding-left: 0;">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="宛先"
                        value="全員（マイページ＋TOPページ）" data-search-operator="=">
                    <label style="padding-top: 6px;" class="form-check-label" for="inlineCheckbox1">全員（マイページ＋TOPページ）</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="宛先" 
                        value="会員マイページのみ" data-search-operator="=">
                    <label style="padding-top: 6px;" class="form-check-label" for="inlineCheckbox2">会員マイページのみ</label>
                </div>
            </div>
        </div>

        <div class="row action-button-group">
            <button id="reset_form_button" type="reset" class="base-button cancel-button" name="クリア">クリア</button>
            <button class="base-button submit-button" name="検索" id="search_button">検索</button>
        </div>

        <div class="row table-action-button-group">
            <button  onclick="location.href='/admin/NE20'" class="base-button action-button" name="新規作成">新規作成</button>
        </div>

        <div class="row tb">
            <table class="table table-bordered" id="table_data">
                <tr>
                    <th style="width: 150px; text-align: left;">公開期間</th>
                    <th style="width: 250px; text-align: left;">宛先</th>
                    <th style="width: 250px; text-align: left;">タイトル</th>
                </tr>
            </table>
        </div>
    </div>
</form>

<script>
function loadTableData(conditions) {
    $.ajax({
            url: "/ajax/notice/list",
            data: JSON.stringify(conditions),
            type: 'POST',
            contentType: 'application/json',
        })
        .done(function(data) {
            let items = '';

            data.result.forEach(function(data) {
                items += `
                <tr onclick="location.href='./NE20?notice_id=${data['id']}'" style="cursor: pointer;">
                    <td style="width: 150px; text-align: left;">${data['公開期間']}</td>
                    <td style="width: 250px; text-align: left;">${data['宛先']}</td>
                    <td style="width: 250px; text-align: left;">${data['タイトル']}</td>
                </tr>
                `
            });

            $("#table_data").find("tr:gt(0)").remove();
            $('#table_data').append(items);
        })
        .fail(function(error) {
            showErrorMessage(error.responseJSON);
        });
}

function doSearch() {
    let search_conditions = getDataFromForm('form');
    loadTableData(search_conditions);
}

$(document).ready(function() {
    loadTableData();

    /**
     * Handle press enter key
     */
    $(document).on('keypress', function(e) {
        if (e.which == 13) {
            doSearch();
        }
    });

    $('#reset_form_button').click(function() {
        loadTableData();
    });

    $('#search_button').click(function() {
        doSearch();
    });
});
</script>
@endsection
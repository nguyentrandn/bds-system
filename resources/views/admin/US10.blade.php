@extends('layout.q_admin')
@section('breadcrumb')
<div id="breadcrumbs">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>顧客一覧</a></li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<form onsubmit="return false" id="form">
    <div class="container search-form">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <label for="inputEmail3" class="col-lg-3 fw col-form-label">お名前</label>
                    <div class="col-lg-8 fw">
                        <input type="text" class="form-control" placeholder="氏名またはメールアドレスまたは電話番号を入力" name="お名前,メールアドレス,住所,固定電話,携帯電話,建物名,フリガナ"
                            data-search-operator="like" data-search-multiple-column="true">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row datetime-picker">
                    <label class="col col-lg-3" style="padding-left: 2rem;">登録日</label>
                    <div class="col col-lg-4">
                        <input class="form-control" placeholder="🗓 日付を選択" type="text" name="created_from" data-search-operator=">=">
                    </div>
                    <div class="col col-lg-1 divison-icon">~</div>
                    <div class="col col-lg-4">
                        <input class="form-control" placeholder="🗓 日付を選択" type="text" name="created_to" data-search-operator="<=">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col col-lg-3">
                        <label for="inputState" class="form-label">本人確認</label>
                    </div>
                    <div class="col-lg-8">
                        <div class="row pt-2 checker" id="checker" style="margin-left: -5px;">
                            <div class="col col-lg-3"><input type="radio" value="未" name="本人確認" id="NotYet" data-search-operator="=">
                                <label for="NotYet" class="ps-2" style="font-weight: 400;">未</label>
                            </div>
                            <div class="col col-lg-3"><input type="radio" value="済" name="本人確認" id="Already" data-search-operator="=">
                                <label for="Already" class="ps-2" style="font-weight: 400;">済</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row action-button-group">
            <button type="reset" class="base-button cancel-button" id="reset_form_button" name="クリア">クリア</button>
            <button class="base-button submit-button" id="search_button" name="検索">検索</button>
        </div>

        <div class="row table-action-button-group">
            <button class="base-button action-button" id="button_download_csv" name="CSVダウンロード ">CSVダウンロード</button>
        </div>

        <div class="row tb">
            <table class="table table-bordered" id="table_data">
                <tr>
                    <th class="name">お名前</th>
                    <th class="text-center">固定電話番号</th>
                    <th class="text-center">携帯電話番号</th>
                    <th class="text-center">本人確認日</th>
                    <th class="text-center">登録日</th>
                    <th class="text-center">申込数合計</th>
                    <th class="text-center">投資数合計
                    </th>
                </tr>
            </table>
        </div>
    </div>
</form>

<script>
function loadListUsers(conditions) {
    $.ajax({
            url: "/ajax/user.list",
            data: JSON.stringify(conditions),
            type: 'POST',
            contentType: 'application/json',
        })
        .done(function(data) {
            let items = '';

            data.result.forEach(function(data) {
                items += `
                <tr>
                    <td><a href="/admin/US20?user_id=${data['id']}">${data['お名前'] || '未定義'}</a></td>
                    <td class="text-center">${data['固定電話番号'] || '-'}</td>
                    <td class="text-center">${data['携帯電話番号'] || '-'}</td>
                    <td class="text-center">${data['本人確認日'] || '-'}</td>
                    <td class="text-center">${data['登録日'] || '-'}</td>
                    <td class="text-center">${data['申込数合計']}</td>
                    <td class="text-center">${data['投資数合計']}</td>
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
    loadListUsers(search_conditions);
}

$(document).ready(function() {
    loadListUsers();

    /**
     * Handle press enter key
     */
    $(document).on('keypress', function(e) {
        if (e.which == 13) {
            doSearch();
        }
    });

    $('#reset_form_button').click(function() {
        loadListUsers();
    });

    $('#search_button').click(function() {
        doSearch();
    });

    $('#button_download_csv').click(function() {
        let search_conditions = getDataFromForm('form');
        downloadCSV('/ajax/user/csv/download', search_conditions);
    });
});
</script>
@endsection
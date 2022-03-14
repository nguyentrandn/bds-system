@extends('layout.q_admin')

@section('breadcrumb')
<div id="breadcrumbs">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>アカウント一覧</a></li>
        </ol>
    </nav>
</div>
@endsection


@section('content')
<!-- Phan Contten ben phai  -->
<form name="myform" onsubmit="return false" id="form">
    <div class="container search-form">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <label for="inputEmail3" class="col-lg-4 fw col-form-label">氏名</label>
                    <div class="col-lg-7">
                        <input type="text" class=" form-control" placeholder="氏名を入力" name="氏名" data-search-operator="like" />
                    </div>
                </div>

                <div class="row">
                    <label for="inputEmail3" class="col-lg-4 fw col-form-label">メールアドレス</label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" placeholder="メールアドレスを入力" name="メールアドレス" data-search-operator="like">
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row">
                    <label for="inputState" class="col col-lg-3" style="padding-left: 3rem;">権限</label>
                    <div class="col-lg-9">
                        <select id="inputState" class="form-select" name="権限" data-search-operator="=">
                            <option value="" selected>権限を選択</option>
                            <option value="管理者">管理者</option>
                            <option value="担当者">担当者</option>
                        </select>
                    </div>
                </div>

                <div class="row datetime-picker">
                    <label class="col col-lg-3" style="padding-left: 3rem;">登録日</label>
                    <div class="col col-lg-4">
                        <input class="form-control" placeholder="🗓&emsp;開始日を入力" type="text" name="created_from" data-search-operator=">=" />
                    </div>
                    <div class="col col-lg-1 divison-icon">~</div>
                    <div class="col col-lg-4">
                        <input class="form-control" placeholder="🗓&emsp;終了日を入力" type="text" name="created_to" data-search-operator="<=" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row action-button-group">
            <button type="reset" class="base-button cancel-button" id="reset_form_button" name="クリア">クリア</button>
            <button class="base-button submit-button" id="search_button" name="検索">検索</button>
        </div>

        <div class="row table-action-button-group">
            <button  onclick="location.href='/admin/AC20'" class="base-button action-button" name="新規作成">新規作成</button>
        </div>

        <div class="row tb">
            <table class="table table-bordered" id="table_data">
                <tr>
                    <th style="width: 140px; text-align: left;">氏名</th>
                    <th style="width: 250px; text-align: left;">メールアドレス</th>
                    <th style="width: 100px; text-align: center;">権限</th>
                    <th style="width: 140px; text-align: center;">登録日</th>
                    <th style="width: 140px; text-align: center;">最終更新者</th>
                </tr>
            </table>
        </div>
    </div>
</form>


<script>
function loadTableData(conditions) {
    $("#table_data").find("tr:gt(0)").remove();
		$('#table_data').append(`
		<tr class="in" style="border-bottom: 0.1rem solid #D6D6D6; ">
			<td colspan="8" style="padding: 0;  text-align: center;"><img style="width: 60px; height:  60px;" src="/assets/img/loading.svg" /></td>
		</tr>
		`);
    $.ajax({
            url: "/ajax/admin.list",
            data: JSON.stringify(conditions),
            type: 'POST',
            contentType: 'application/json',
        })
        .done(function(data) {
            let items = '';

            data.result.forEach(function(data) {
                items += `
                <tr>
                    <td style="width: 140px; text-align: left;"><a href="/admin/AC30?admin_id=${data['id']}">${data['氏名'] || '-'}</a></td>
                    <td style="width: 250px; text-align: left;">${data['メールアドレス'] || '-'}</td>
                    <td style="width: 100px; text-align: center;">${data['権限'] || '-'}</td>
                    <td style="width: 140px; text-align: center;">${data['登録日'] || '-'}</td>
                    <td style="width: 140px; text-align: center;">${data['最終更新者'] || '-'}</td>
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
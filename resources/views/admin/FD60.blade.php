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
                <a href="FD50?fund_id={{ request()->get('fund_id') }}"> 投資一覧 </a>
            </li>
            <li>
                <a class="color-menu"  href="FD60?fund_id={{ request()->get('fund_id') }}"> メッセージ</a>
            </li>
        </ul>
    </div>

    <!-- Phan Contten ben phai  -->
    <form name="myform" onsubmit="return false" class="search-form">
        <div class="container">
            <div class="row table-action-button-group">
                <button onclick="location.href='/admin/FD61?fund_id={{ request()->get('fund_id') }}'"
                    class="base-button action-button" name="新規作成">新規作成</button>
            </div>

            <div class="row tb">
                <table class="table table-bordered" id="table_data">
                    <tr>
                        <th style="width: 100px;">送信日時</th>
                        <th style="width: 350px; text-align: left;">タイトル</th>
                    </tr>
                </table>
            </div>
        </div>
    </form>
    <!-- Ket thuc phan Contten  -->
</div>


<script>
function loadTableData() {
    let FUND_ID = $.urlParam('fund_id');

    let conditions = [];
    conditions.push({
        column_name: 'fund_id',
        search_operator: '=',
        value: FUND_ID
    });

    $.ajax({
            url: "/ajax/fund-message/list",
            data: JSON.stringify(conditions),
            type: 'POST',
            contentType: 'application/json',
        })
        .done(function(data) {
            let items = '';

            data.result.forEach(function(data) {
                items += `
                <tr style="cursor: pointer;" onclick="location.href='./FD61?message_id=${data['id']}&fund_id=${FUND_ID}'">
                    <td style="width: 100px; text-align: left;">${data['送信日時']}</td>
                    <td style="width: 350px; text-align: left;">${data['タイトル']}</td>
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

$(document).ready(function() {
    setFundHeaderData();
    loadTableData();
});
</script>
@endsection
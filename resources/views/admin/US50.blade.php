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
                    <a href="./US20?user_id={{ request()->get('user_id') }}"> 基本情報</a>
                </li>
                <li>
                    <a href="./US30?user_id={{ request()->get('user_id') }}"> 申込一覧</a>
                </li>
                <li>
                    <a href="./US40?user_id={{ request()->get('user_id') }}"> 投資一覧 </a>
                </li>
                <li>
                    <a class="color-menu" href="./US50?user_id={{ request()->get('user_id') }}"> メッセージ</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container search-form">
        <div class="row table-action-button-group">
            <button style="width: 175px;" class="base-button action-button" onclick="location.href='./US51?user_id={{ request()->get('user_id') }}'">新規メッセージ作成</button>
        </div>

        <div class="row tb">
            <table class="table table-bordered" id="table_data">
                <tr>
                    <th style="width: 100px; text-align: left;">送信日時</th>
                    <th style="width: 350px; text-align: left;">タイトル</th>
                </tr>
            </table>
        </div>
    </div>
</div>

<script>
function loadTableData() {
    let USER_ID = $.urlParam('user_id');

    let conditions = [];
    conditions.push({
        column_name: 'user_id',
        search_operator: '=',
        value: USER_ID
    });

    $.ajax({
            url: "/ajax/user-message/list",
            data: JSON.stringify(conditions),
            type: 'POST',
            contentType: 'application/json',
        })
        .done(function(data) {
            let items = '';

            data.result.forEach(function(data) {
                items += `
                <tr style="cursor: pointer;" onclick="location.href='./US51?message_id=${data['id']}&user_id=${USER_ID}'">
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
    setUserHeaderData();
    loadTableData();
});
</script>
@endsection
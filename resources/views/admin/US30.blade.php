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
                    <span data-model="お名前1"></span><span data-model="お名前2"></span>（<span data-model="フリガナ1"></span><span data-model="フリガナ2"></span>）
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
                    <a class="color-menu" href="./US30?user_id={{ request()->get('user_id') }}"> 申込一覧</a>
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

    <div class="container">

        <div class="row pt-4 tb">
            <table class="table table-bordered" id="table_data">
                <tr>
                    <th style="width: 90px; text-align: left;">抽選<br/>ステータス</th>
                    <th style="width: 130px; text-align: center;">申込日</th>
                    <th style="width: 280px; text-align: left;">ファンド名</th>
                    <th style="width: 150px; text-align: right;">申込金額</br>（申込口数）</th>
                    <th style="width: 150px; text-align: right;">当選金額<br>（当選口数)</th>
                    <th style="width: 130px; text-align: center;">抽選日</th>
                    <th style="width: 130px; text-align: center;">キャンセル日</th>
                </tr>
            </table>
        </div>
    </div>
</div>
<script>
function loadTableData() {
    let conditions = [];
    conditions.push({
        column_name: 'user_id',
        search_operator: '=',
        value: $.urlParam('user_id')
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

                items += `
                <tr>
                    <td style="width: 90px; text-align: left;">${data['抽選ステータス'] || '-'}</td>
                    <td style="width: 130px; text-align: center;">${data['申込日'] || '-'}</td>
                    <td style="width: 280px; text-align: left;">${data['ファンド名'] || '-'}</td>
                    <td style="width: 170px; text-align: right;">${data['申込金額']  || '-'} <br/> (${data['申込口数'] || '-'})</td>
                    <td style="width: 170px; text-align: right;">${data['当選金額']  || '-'}<br/> (${data['当選口数'] || '-'})</td>
                    <td style="width: 130px; text-align: center;">${data['抽選日'] || '-'}</td>
                    <td style="width: 130px; text-align: center;">${data['キャンセル日'] || '-'}</td>
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
@extends('layout.q_admin')

@section('breadcrumb')
<div id="breadcrumbs">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/US10">顧客一覧</a></li>
            <li class="breadcrumb-item" aria-current="page"><a
                    href="/admin/US50?user_id={{ request()->get('user_id') }}">顧客情報詳細</a></li>
            <li class="breadcrumb-item active" aria-current="page">メッセージ</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="conten user-detail-screen NE20" style="margin-bottom: 6rem;">
    <div class="title-top-conten">
        <div class="title-recruitment">
            <ul class="information pt-3">
                <li class=""><img src="./image/user.svg" alt="">&emsp;
                    <span data-model="お名前1"></span><span data-model="お名前2"></span>（<span data-model="フリガナ1"></span><span
                        data-model="フリガナ2"></span>）
                </li>
                <li><img src="./image/telephone.svg" alt=""><span data-model="固定電話"></span></li>
                <li><img src="./image/phone.svg" alt=""><span data-model="携帯電話"></span></li>
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
    <div class="main-conten">
        <!-- điền form -->
        <form class="row-conten g-3" id="form" onsubmit="return false">
            <div class="option">
                <button id="open_popup_preview" class="option-left base-button submit-button">
                    プレビュー
                </button>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label for="タイトル" class="form-label">タイトル</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <input class="form-control " name="タイトル" placeholder="タイトルを入力してください" type="text">
                </div>
            </div>
            <div class="form-group" style="align-items: baseline;">
                <div class="coll-md-3 ">
                    <label for="本文" class="form-label">本文</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <div class="h70">
                        <textarea class="form-control h70" name="本文" placeholder="タイトルを入力してください" type="text"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">添付ファイル</label>
                </div>
                <div class="coll-md-8 edit-padding">
                    <div class="form-both1 attactment-file-select" style="margin-left: 5px;"
                        id="添付ファイル_file_attachment">
                        <div class="file-upload-placeholder">
                            <label for="添付ファイル_input_file" class="input-file-placeholder"></label>
                            <input type="file" id="添付ファイル_input_file" name="メイン画像" hidden />
                            <span>※ファイルサイズ25MBまで</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="coll-md-3 ">
                    <label class="form-label">送信日時</label>
                    <div class="nhan">必須</div>
                </div>
                <div class="coll-md-8 edit-padding">
                    <div class="w30">
                        <input class="form-control w30" name="送信日時" placeholder="🗓&emsp; 日時を入力"
                            id="送信日時_input_datetime">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="coll-md-3 ">
                    <label for="メールでの通知" class="form-label">メールでの通知</label>
                </div>
                <div class="coll-md-8 ">
                    <input style="min-height: auto;
                                margin-left: 25px;
                                width: 15px;
                                min-width: auto;
                                padding: 0;
                                display: inline-block;" id="2-option" value="メールでも通知する" name="メールでの通知" type="checkbox">
                    <label for="2-option">メールでも通知する</label>
                </div>
            </div>

            <div class="col-md-12 d-none" id="delete_button_block">
                <div class="mt-3 text-end">
                    <a style="cursor: pointer;" id="remove_button">
                        <img style="margin-top: -5px;" src="/admin/image/Garbage.svg"> 削除する
                    </a>
                </div>
            </div>

            <div class="button-submit">
                <button id="submit_form" type="button" class="base-button submit-button">保存</button>
            </div>
        </form>
    </div>
</div>

<!-- popup preview -->
<div class="modal" id="popup_review_notice">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="min-height: 80vh;">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="container">
                <div class="row pop-close m-0 float-end"><label><img id="closeimg" class="p-4" src="/image/x.svg"
                            alt=""></label></div>
                <div class="row pop_contai m-0 px-4">
                    <div class="row pop_title ">
                        <h3 class="col col-lg-12"><b id="notice_title"></b></h3>
                        <p class="col col-4" id="notice_time"></p>
                        <hr>
                    </div>
                    <div class="row pop_conten ps-3 px-2 pb-5">
                        <p id="notice_content" style="white-space: pre-wrap;"></p>

                        <!-- attachment preview -->
                        <div class="d-none" style="padding-top: 2rem; padding-bottom: 4rem; position: relative;"
                            id="attachment_preview">
                            <p style="margin-bottom: 1rem;">添付:</p>
                            <ul style=" position: absolute;
                                        top: 2rem;
                                        left: 5rem;">
                            </ul>
                        </div>
                        <!-- attachment preview -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ./ popup preview -->


<!-- popup confirm delete -->
<div class="modal" id="popup_confirm_delete">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center" style="height: 50px;">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body confirm-text">
                <p>【<span id="removed_item_name"></span>】アカウントを削除して</p>
                <p>キャンセルしてもよろしいですか？</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="base-button popup-cancel-btn">キャンセル</button>
                <button id="confirm_delete_button" type="button" class="base-button popup-submit-btn">はい</button>
            </div>
        </div>
    </div>
</div>
<!-- popup confirm delete -->


<script src="/admin/js/image-file-uploader.js"></script>
<script>
function loadDetailInformation(ID) {
    /**
     * Get data for edit.
     */
    $.get(`/ajax/user-message/detail/${ID}`, function(data) {
        bindDataForForm(data);

        // Get name for confirm delete later.
        subject_name = $('[name="タイトル"]')[0].value;

        let attachment = [];
        try {
            attachment = JSON.parse(getFormDataByFieldName(data, '添付ファイル').value);
        } catch (err) {
            console.log(err);
        }

        initialAttacmentFileUploader('添付ファイル_file_attachment', attachment || []);

        $('#送信日時_input_datetime').datetimepicker({
            format: 'Y-m-d H:i',
        });
    });
}

$(document).ready(function() {
    setUserHeaderData();

    let USER_ID = $.urlParam('user_id');
    let ID = $.urlParam('message_id');
    let mode = 'create';

    if (ID) {
        loadDetailInformation(ID);
        mode = 'edit';
        $('#delete_button_block').removeClass('d-none');
    } else {
        initialAttacmentFileUploader('添付ファイル_file_attachment', []);
    }

    /**
     * Open preview popup
     */
    $('#open_popup_preview').click(function() {
        var modal = new bootstrap.Modal(document.getElementById(
            'popup_review_notice'));

        $('#notice_title').text($('[name="タイトル"]')[0].value);
        $('#notice_content').text($('[name="本文"]')[0].value);

        /**
         * Show preview attachment
         */
        $('#attachment_preview').addClass('d-none');
        $('#attachment_preview').find('ul').html('');
        let files = getDataFromAttachmentFileUploader('添付ファイル_file_attachment');

        files.forEach(function(item) {
            let li =
                `<li style="margin-bottom: 0.75rem;"><a href="${item.file}">${item.name}</a></li>`;
            $('#attachment_preview').find('ul').append(li);
        });

        if (files.length > 0) {
            $('#attachment_preview').removeClass('d-none');
        }

        modal.show();
    });

    /**
     * Submit data
     */
    $('#submit_form').click(function() {
        let btn = $(this);
        btn.addClass('disabled');

        let data = getDataFromForm();

        let files = getDataFromAttachmentFileUploader('添付ファイル_file_attachment');

        let attactment = {
            'column_name': `添付ファイル`,
            'data_type': 'attachment',
            'value': [],
        };

        files.forEach(function(item) {
            attactment.value.push(item);
        });

        data.push(attactment);

        if (mode === 'create') {

            let data_user_id = {
                'column_name': `user_id`,
                'data_type': 'number',
                'value': USER_ID,
            };
            data.push(data_user_id);

            $.ajax({
                    url: `/ajax/user-message/create`,
                    data: JSON.stringify(data),
                    type: 'POST',
                    contentType: 'application/json',
                })
                .done(function() {
                    showMessageCreateSuccessfully();
                    let to = setTimeout(() => {
                        clearTimeout(to);
                        window.location.assign('/admin/US50?user_id=' + USER_ID);
                    }, 2000);
                })
                .fail(function(error) {
                    showErrorMessage(error.responseJSON);
                    btn.removeClass('disabled');
                });
        } else {
            $.ajax({
                    url: `/ajax/user-message/update/${ID}`,
                    data: JSON.stringify(data),
                    type: 'POST',
                    contentType: 'application/json',
                })
                .done(function() {
                    showMessageSaveSuccessfully();
                    let to = setTimeout(() => {
                        clearTimeout(to);
                        window.location.assign('/admin/US50?user_id=' + USER_ID);
                    }, 2000);
                    btn.removeClass('disabled');
                })
                .fail(function(error) {
                    showErrorMessage(error.responseJSON);
                    btn.removeClass('disabled');
                });
        }
    });

    /**
     * Open confirm delete popup
     */
    $('#remove_button').click(function() {
        var modal = new bootstrap.Modal(document.getElementById(
            'popup_confirm_delete'));

        $('#removed_item_name').text(subject_name);
        modal.show();

        /**
         * Binding delete action to button
         */
        $("#confirm_delete_button").unbind("click");
        $('#confirm_delete_button').click(function() {
            let btn = $(this);
            btn.addClass('disabled');

            $.ajax({
                    url: `/ajax/user-message/delete/${ID}`,
                    type: 'DELETE',
                    contentType: 'application/json',
                })
                .done(function() {
                    modal.hide();
                    showMessageSaveSuccessfully();
                    let to = setTimeout(() => {
                        clearTimeout(to);

                        /**
                         * Should replace and clear history to avoid browser back
                         */
                        window.location.replace('/admin/US50?user_id=' + USER_ID);
                    }, 2000);
                    btn.removeClass('disabled');
                })
                .fail(function(error) {
                    showErrorMessage(error.responseJSON);
                    btn.removeClass('disabled');
                });
        });
    });
});
</script>
@endsection
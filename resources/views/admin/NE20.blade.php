@extends('layout.q_admin')

@section('breadcrumb')
<div id="breadcrumbs">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/NE10">お知らせ一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">お知らせ編集</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="main-conten NE20" style="margin-bottom: 6rem;">
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
        <div class="form-group" style="align-items: flex-start;">
            <div class="coll-md-3 ">
                <label class="form-label">添付ファイル</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <div class="form-both1 attactment-file-select" style="margin-left: 5px;" id="添付ファイル_file_attachment">
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
                <label class="form-label">公開期間</label>
            </div>
            <div class="coll-md-8 edit-padding datetime-picker">
                <div class="w30">
                    <input class="form-control w30" name="公開期間_from" placeholder="🗓&emsp; 開始日を入力" id="txtfrom">
                </div>
                <div class="or">〜</div>
                <div class="w30">
                    <input class="form-control w30" name="公開期間_to" placeholder=" 🗓&emsp; 終了日を入力" id="txtto">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="coll-md-3 ">
                <label for="公開先" class="form-label">公開先</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8" style="padding-left: 1rem;">
                <input id="1-option" value="全員（マイページ＋TOPページ）" name="公開先" type="radio">
                <label for="1-option">全員（マイページ＋TOPページ）</label>

                <input id="2-option" value="会員マイページのみ" name="公開先" type="radio">
                <label for="2-option">会員マイページのみ</label>
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
<!-- message -->

<!-- popup preview notice -->
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
                        <div class="d-none" style="padding-top: 2rem; padding-bottom: 4rem; position: relative;" id="attachment_preview">
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
<!-- ./ popup preview notice -->


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
    $.get(`/ajax/notice/detail/${ID}`, function(data) {
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
    });
}

$(document).ready(function() {
    let ID = $.urlParam('notice_id');
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
        $('#notice_time').text($('[name="公開期間_from"]')[0].value + ' ~ ' + $('[name="公開期間_to"]')[0]
            .value);
        $('#notice_content').text($('[name="本文"]')[0].value);

        /**
         * Show preview attachment
         */
        $('#attachment_preview').addClass('d-none');
        $('#attachment_preview').find('ul').html('');

        let files = getDataFromAttachmentFileUploader('添付ファイル_file_attachment');

        files.forEach(function(item) {
            let li = `<li style="margin-bottom: 0.75rem;"><a href="${item.file}">${item.name}</a></li>`;
            $('#attachment_preview').find('ul').append(li);
        });

        if(files.length > 0) {
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
            $.ajax({
                    url: `/ajax/notice/create`,
                    data: JSON.stringify(data),
                    type: 'POST',
                    contentType: 'application/json',
                })
                .done(function() {
                    showMessageCreateSuccessfully();
                    let to = setTimeout(() => {
                        clearTimeout(to);
                        window.location.assign('/admin/NE10');
                    }, 2000);
                })
                .fail(function(error) {
                    showErrorMessage(error.responseJSON);
                    btn.removeClass('disabled');
                });
        } else {
            $.ajax({
                    url: `/ajax/notice/update/${ID}`,
                    data: JSON.stringify(data),
                    type: 'POST',
                    contentType: 'application/json',
                })
                .done(function() {
                    showMessageSaveSuccessfully();
                    let to = setTimeout(() => {
                        clearTimeout(to);
                        window.location.assign('/admin/NE10');
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
                    url: `/ajax/notice/delete/${ID}`,
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
                        window.location.replace('/admin/NE10');
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
@extends('layout.q_admin')

@section('breadcrumb')
<div id="breadcrumbs">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/AC10">アカウント一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">アカウント編集</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="main-conten">
    <form class="row-conten g-3 " onsubmit="return false" id="form">
        <div class="title-main-conten" style="margin-top: 0;">
            <p> アカウント情報</p>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">氏名</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input class="form-control" name="氏名" placeholder="井田 佳子" type="text" />
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">メールアドレス</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input id="email_address" name="email" class="form-control" placeholder="ida@bibi.com" type="email">
            </div>
        </div>

        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">権限</label>
                <div class="nhan">必須</div>

            </div>
            <div class="coll-md-8 edit-padding">
                <select class="form-select" name="role">
                    <option value="" selected>権限を選択</option>
                    <option value="管理者">管理者</option>
                    <option value="担当者">担当者</option>
                </select>
            </div>
        </div>

        <div class="col-md-12">
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


<script>
var subject_name = '';

function loadDetailInformation(ID) {
    /**
     * Get data for edit.
     */
    $.get(`/ajax/admin.detail.${ID}`, function(data) {
        bindDataForForm(data);

        // Get name for confirm delete later.
        subject_name = $('[name="氏名"]')[0].value;
    });
}

$(document).ready(function() {
    let ID = $.urlParam('admin_id');
    loadDetailInformation(ID);

    /**
     * Submit data
     */
    $('#submit_form').click(function() {
        /**
         * Validate form
         */
        if(!validate_email( $('#email_address')[0].value )) {
            $('#email_address').addClass('required-field');
            return;
        } 

        let btn = $(this);
        btn.addClass('disabled');

        let data = getDataFromForm();

        clearFormValidation();
        $.ajax({
                url: `/ajax/admin.update.${ID}`,
                data: JSON.stringify(data),
                type: 'POST',
                contentType: 'application/json',
            })
            .done(function() {
                showMessageSaveSuccessfully();
                let to = setTimeout(() => {
                    clearTimeout(to);
                    window.location.assign('/admin/AC10');
                }, 2000);
                btn.removeClass('disabled');
            })
            .fail(function(error) {
                showErrorMessage(error.responseJSON, 3000);
                btn.removeClass('disabled');

                if (error.responseJSON.error_code == 'required_fields') {
                    displayFormValidation(error.responseJSON.error_fields);
                }
            });
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
                    url: `/ajax/admin.delete.${ID}`,
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
                        window.location.replace('/admin/AC10');
                    }, 2000);
                    btn.removeClass('disabled');
                })
                .fail(function(error) {
                    showErrorMessage(error.responseJSON);
                    btn.removeClass('disabled');
                });
        });
    });

    $('#email_address').focusout(function(event) {
        if(!validate_email(event.target.value)) {
            $(event.target).addClass('required-field');
        } else {
            $(event.target).removeClass('required-field');
        }
    });
});
</script>

@endsection
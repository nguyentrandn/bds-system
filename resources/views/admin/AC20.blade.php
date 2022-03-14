@extends('layout.q_admin')

@section('breadcrumb')
<div id="breadcrumbs">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/AC10">アカウント一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">アカウント新規作成</li>
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
                <input class="form-control" name="氏名" placeholder="氏名を入力">
            </div>
        </div>
        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">メールアドレス</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <input id="email_address" name="email" class="form-control" placeholder="メールアドレスを入力" type="email">
            </div>
        </div>

        <div class="form-group">
            <div class="coll-md-3 ">
                <label class="form-label">権限</label>
                <div class="nhan">必須</div>
            </div>
            <div class="coll-md-8 edit-padding">
                <select class="form-select" name="role" style="width: 100px;">
                    <option value="管理者" selected>管理者</option>
                    <option value="担当者">担当者</option>
                </select>
            </div>
        </div>

        <div class="button-submit">
            <button id="submit_form" type="submit" class="base-button submit-button">招待メールを送る</button>
        </div>
    </form>
</div>


<script>
$(document).ready(function() {
    /**
     * Submit data
     */
    $('#submit_form').click(function(event) {
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
                url: `/ajax/admin.create`,
                data: JSON.stringify(data),
                type: 'POST',
                contentType: 'application/json',
            })
            .done(function() {
                showMessageCreateSuccessfully();
                let to = setTimeout(() => {
                    clearTimeout(to);
                    window.location.assign('/admin/AC10');
                }, 2000);
            })
            .fail(function(error) {
                showErrorMessage(error.responseJSON, 3000);

                if (error.responseJSON.error_code == 'required_fields') {
                    displayFormValidation(error.responseJSON.error_fields);
                }

                btn.removeClass('disabled');
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/admin/css/CP10.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"
        integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
        integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="/admin/js/app.js?v={{rand(10,1000)}}"></script>
    <title>パスワード変更</title>
</head>

<body>
    <div class="login">
        <div class="title">
            <p>パスワード変更</p>
        </div>
        <form class="row-conten g-3" onsubmit="return false" id="form" style="margin-top: 1rem;">
            <div class="form-group">
                <div class="col-md-3" style="display: flex;align-items: center; width: 140px;margin-left: -5px;">
                    <label class="pt-1 form-label">メールアドレス</label>
                </div>
                <div class="col-md-8 edit-padding">
                    <input class="form-control" placeholder="メールアドレスを入力" type="text" name="" id="email_address">
                </div>
            </div>

            <div class="col-md-12">
                <div class="btn">
                    <button id="submit_form" class="submit">
                        <p>メールを送信</p>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal" id="popup_done_send_email">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modall-header text-center">
                    <button type="button" class="btn_close" data-bs-dismiss="modal"><img src="./image/x.svg"
                            alt=""></button>
                </div>

                <div class="container">
                    <div class="row pop_contai m-0 px-4">
                        <div class="row pop_title ">
                            <div class="col col-lg-12">
                                <h3 class="mg-0" style="font-size:1.5rem;"><b> パスワード変更 </b></h3>
                            </div>
                            <div class="col col-lg-12 pt-lg-5">
                                <h5 class="w50 mg-0">パスワードの再設定ページへのリンクを 登録したメールアドレスに送信しました。</h5>
                            </div>

                        </div>
                        <div class="btn_group ps-3 px-2 pb-5 pt-lg-5">
                            <button class="btn1" data-bs-dismiss="modal">
                                キャンセル
                            </button>
                            <button class="btn2 ">
                                はい
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
$(document).ready(function() {
    $('#submit_form').click(function(event) {
        /**
         * Validate form
         */
        if (!validate_email($('#email_address')[0].value)) {
            $('#email_address').addClass('required-field');
            return;
        }

        let btn = $(this);
        btn.addClass('disabled');

        event.preventDefault();

        var data = {
            email: $('#email_address')[0].value,
        };

        clearFormValidation();
        $.ajax({
                url: `/ajax/admin.forgot_password`,
                data: JSON.stringify(data),
                type: 'POST',
                contentType: 'application/json',
            })
            .done(function() {
                var modal = new bootstrap.Modal(document.getElementById('popup_done_send_email'));
                modal.show();
            })
            .fail(function(error) {
                showErrorMessage(error.responseJSON, 3000);
                btn.removeClass('disabled');
            });
    });


    $('#email_address').focusout(function(event) {
        if (!validate_email(event.target.value)) {
            $(event.target).addClass('required-field');
        } else {
            $(event.target).removeClass('required-field');
        }
    });
});
</script>

</html>
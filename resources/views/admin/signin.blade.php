<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap -->
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


    <!-- Postal code library -->
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="/admin/js/app.js?v={{rand(10,1000)}}"></script>

    <link rel="stylesheet" href="/admin/css/LG10.css">
    <title>ログイン</title>
</head>

<body>
    <div class="login">
        <div class="title">
            <p>ログイン</p>
        </div>
        <form class="row-conten g-3" id="form" onsubmit="return false">
            <div class="form-group">
                <div class="col-md-3" style="display: flex;align-items: center;">
                    <label class="pt-1 form-label">メールアドレス</label>
                </div>
                <div class="col-md-8">
                    <input class="form-control" placeholder="メールアドレスを入力" type="email" name="email" id="email">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3" style="display: flex;align-items: center;">
                    <label class="pt-1 form-label">パスワード</label>
                </div>
                <div class="col-md-8">
                    <input class="form-control" placeholder="パスワードを入力" type="password" name="password" id="password">
                </div>
            </div>
            <div class="col-md-11 text-end">
                <a href="/admin/forgot-password" style="margin-right: -5px; font-weight: 500; font-size: 14px;">
                    パスワードをお忘れですか？
                </a>
            </div>
            <div class="col-md-12">
                <div class="btn">
                    <button id="submit_button" type="button" class="submit">
                        <p>ログイン</p>
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>

<script>
function doLogin(event) {
    let btn = $(event);
    btn.addClass('disabled');

    var data = {
        email: $('#email')[0].value,
        password: $('#password')[0].value,
    };

    $.ajax({
            url: `/ajax/admin.signin`,
            data: JSON.stringify(data),
            type: 'POST',
            contentType: 'application/json',
        })
        .done(function(response) {
            if (response.success) {
                window.location.replace('/admin/FD10');
            }
        })
        .fail(function(error) {
            showErrorMessage(error.responseJSON);
            btn.removeClass('disabled');
        });
}

$(document).ready(function() {
    $('#submit_button').click(function() {
        doLogin(this);
    });

    /**
     * Handle press enter key
     */
    $(document).on('keypress', function(e) {
        if (e.which == 13) {
            doLogin();
        }
    });
});
</script>

</html>
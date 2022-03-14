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

    <!-- JQuery datetime picker  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"
        integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"
        integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="/admin/js/app.js?v={{rand(10,1000)}}"></script>
    <link rel="stylesheet" href="/admin/css/layout.css?v={{rand(10,1000)}}">

    @yield('stylesheet')
    <title>Fujihousing Admin</title>
</head>

<body>
    <header id="header">
        <nav class="navigation">
            <img id="logo_img" src="./image/logo.svg" alt="logo" />

            <li id="user_info_dropdown" class="nav-item dropdown">
                <a class="nav-link">
                    {{$admin->氏名}} ({{$admin->role}})
                </a>
            </li>
        </nav>
    </header>

    <div id="warper">
        <div id="sidebar">
            <div class="list-group">
                <a href="/admin/US10" data-target-screen="US10,US20,US30,US40,US50,US51"
                    class="list-group-item list-group-item-action" aria-current="true">
                    顧客情報
                </a>
                <a href="/admin/FD10" data-target-screen="FD10,FD20,FD30,FD40,FD50,FD60,FD61"
                    class="list-group-item">ファンド</a>
                <a href="/admin/NE10" data-target-screen="NE10,NE20,NE30" class="list-group-item">お知らせ</a>
                <a href="/admin/AC10" data-target-screen="AC10,AC20,AC30" class="list-group-item">アカウント管理</a>
                <a id="signout_button" class="list-group-item" style="cursor: pointer;">ログアウト</a>
            </div>
        </div>

        <div id="page">
            @yield('breadcrumb')

            <main id="page-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="/admin/js/datetime-picker.js?v={{rand(10,1000)}}"></script>

    <script>
    $(document).ready(function() {
        $('#sidebar .list-group a').each(function(index, element) {
            if (element.dataset && element.dataset.targetScreen) {
                let targetScreens = element.dataset.targetScreen.split(',');
                targetScreens.forEach(function(item) {
                    if (window.location.href.search(item) !== -1) {
                        $(element).addClass('active');
                    }
                });
            }
        });
    });

    $('#signout_button').click(function() {
        $.ajax({
                url: `/ajax/admin.signout`,
                type: 'POST',
                contentType: 'application/json',
            })
            .done(function(response) {
                if (response.success) {
                    window.location.replace('/admin/signin');
                }
            })
            .fail(function(error) {
                showErrorMessage(error.responseJSON);
                btn.removeClass('disabled');
            });
    });
    </script>
</body>

</html>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
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

    <script src="/admin/js/app.js?v={{rand(10,1000)}}"></script>

    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/common-form.css">
    <link rel="stylesheet" href="./css/common-popup.css">
    <link rel="stylesheet" href="./css/common-table.css">

    @yield('stylesheet')

    <title>Fujihousing Admin</title>
</head>

<body>
    <div class="row-top">
        <div class="header">
            <div class="top-left">

                <img src="./image/logo.svg" alt="">

            </div>
            <div class="top-right">
                <div class="admin">
                    <ul>
                        <li><img src="./image/admin.svg" alt=""></li>
                        <li class="admin-text">
                            <p>藤田 田
                            </p>
                        </li>
                        <li class="admin-text"><svg width="10" height="9" viewBox="0 0 13 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.5 12L0.00480938 0.75L12.9952 0.75L6.5 12Z" fill="black" />
                            </svg></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class=" container-main">
        <div class="container-main-item">
            <div class="menu" onclick="menu()">
                <img class="close-img" id="btn_close" src="./image/close.svg" alt="">
                <div class="open-img"><i id="btn_open" class="fas fa-bars"></i> <i class="far fa-chevron-right"></i>
                </div>
                <ul class="item-menu">
                    <li>
                        <a href="/admin/US10" data-target-screen="US10,US20"> 顧客情報 </a>
                    </li>
                    <li>
                        <a href="/admin/FD10" data-target-screen="FD10,FD20,FD30,FD40"> ファンド</a>
                    </li>
                    <li>
                        <a href="/admin/NE10" data-target-screen="NE10,NE20,NE30"> お知らせ</a>
                    </li>
                    <li>
                        <a href="/admin/AC10" data-target-screen="AC10,AC20,AC30"> アカウント管理</a>
                    </li>
                    <li>
                        <a href=""> ログアウト</a>
                    </li>
                </ul>
            </div>
            @yield('content')
        </div>
    </div>

    <script src="/admin/js/datetime-picker.js?v={{rand(10,1000)}}"></script>
    <script src="/admin/js/menu.js?v={{rand(10,1000)}}"></script>

    <script>
    $(document).ready(function() {
        $('.item-menu li a').each(function(index, element) {
            if (element.dataset && element.dataset.targetScreen) {
                let targetScreens = element.dataset.targetScreen.split(',');
                targetScreens.forEach(function(item) {
                    if (window.location.href.search(item) !== -1) {
                        $(element).parent().addClass('active');
                    }
                });
            }
        });
    });
    </script>
</body>

</html>
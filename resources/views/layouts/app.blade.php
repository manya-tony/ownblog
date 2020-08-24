<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- description -->
    <meta name="description" content="わたしだけが見られる、わたしだけのブログサービス">
    <!-- keyword -->
    <meta name=”keywords” content=”ブログ,日記,趣味”>
    <!-- title -->
    <title>@yield('title') | {{ config('app.name') }}</title>
    <!-- styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="wrapper">

    <!-- =================================
        ヘッダー
    ================================= -->
    @unless(Request::is('/'))
        <header class="header">
            <div class="container">
                <div class="header-item">
                    @if(Auth::check())
                        <h1 class="header-item_title"><a href="{{ route('art.index') }}">OWN Blog</a></h1>
                    @else
                        <h1 class="header-item_title"><a href="{{ route('top') }}">OWN Blog</a></h1>
                    @endif
                    <nav class="header-item_nav">
                            @if(Auth::check())
                                <span class="header-item_text">ようこそ、{{ Auth::user()->name }}さん /
                                    <a href="{{ route('art.create') }}">create</a> / 
                                    <a href="#" id="js-logout">logout</a>
                                    <form action="{{ route('logout') }}" method="post" style="display: none;" id="js-logout-form">@csrf</form>
                                </span>
                            @else
                                <span class="header-item_text"><a href="{{ route('login') }}">login</a> / <a href="{{ route('register') }}">register</a></span>
                            @endif
                    </nav>
                </div>
            </div>
        </header>
    @endunless
    
    <!-- =================================
        メインコンテンツ
    ================================= -->
    <main class="main">
        <!-- フラッシュメッセージ -->
        @if(session('flash_message'))
            <div class="flash">
                {{ session('flash_message') }}
            </div>
        @endif
        @yield('content')
    </main>
    
    <!-- =================================
        フッター
    ================================= -->
    <footer>
        <div class="container">
            @if(Auth::check())
                <ul>
                    <li><a href="{{ route('mypage.profile') }}">プロフィール編集</a></li>
                    <!-- <li><a href="#">パスワード変更</a></li> -->
                    <li><a href="{{ route('mypage.unsubscribe') }}">退会</a></li>
                </ul>
            @endif
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}</p>
        </div>
    </footer>

</div>

<!-- IE＆Edgeのobject-fit対応 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/object-fit-images/3.2.3/ofi.js"></script>
<script>objectFitImages();</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}"></script>
<!-- ログアウト -->
@if(Auth::check())
    <script>
        document.getElementById('js-logout').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('js-logout-form').submit();
        });
    </script>
@endif
<!-- フラッシュメッセージ -->
<script>
    $(function(){
        var $flash = $(".flash");
        $flash.fadeIn(300);
        setTimeout(function(){
            $flash.fadeOut(300);
        }, 5000);
    });
</script>
@yield('scripts')
</body>
</html>
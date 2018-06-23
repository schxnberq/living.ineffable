<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("title")</title>
        <link rel="icon" href="/imgs/1x/Asset 19wx.png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">
        <link rel="icon" href="/imgs/1x/Asset19x.png">
    </head>
    <body>
        <div id="app">
            @include ("partials.nav")
            <main class="page-content">
                @include ("partials.alerts")
                <div class="site @if(Route::is('home'))home @endif"> 
                    @yield("content")
                </section>
            </main>
            @include ("partials.footer")
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
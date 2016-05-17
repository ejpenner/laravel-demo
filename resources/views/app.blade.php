<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lara5Demo Application</title>

        {!! Html::style('css/bootstrap.css') !!}
        {!! Html::script('jquery-2.2.0.min.js') !!}
        {!! Html::script('js/bootstrap.js') !!}
        {!! Html::script('js/app.js') !!}
        {!! Html::style('css/app.css') !!}
    </head>

    <body id="main">
    <div>
        <div class="container">
            @include('partials._messages')
            <div class="jumbotron bannerTop">
                <h1>Articles <small>the application</small></h1>
                <h4>It sort of works</h4>
            </div>
        </div>

        <div class="container mainPage">
            @yield('content')
        </div>

        <div class="container">
            @include('errors.list')
            @yield('footer')
        </div>
    </div>
    </body>
</html>
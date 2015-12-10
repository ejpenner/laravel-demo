<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lara5Demo Application</title>
        {!! Html::style('css/app.css') !!}
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
    </head>

    <body>


        <div class="container">
            @include('partials._messages')
            <div class="jumbotron">
                <h1>Articles <small>the application</small></h1>
                <h4>It sort of works</h4>
            </div>
            @yield('content')
        </div>

        <div class="container">
            @include('errors.list')
            @yield('footer')
        </div>
l
    </body>
</html>
@extends('app')

@section('content')
    <h1>Laravel Demo Website</h1>
    <hr>
    <nav>
        @include('auth.partials._login')
        {!! link_to('articles', 'Article Demo',['class' => 'btn btn-info'] ) !!}
        {!! link_to('about', 'About',['class' => 'btn btn-info'] ) !!}
        {!! link_to('phpinfo', 'PHP Config',['class' => 'btn btn-info'] ) !!}
    </nav>
@endsection
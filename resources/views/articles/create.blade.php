@extends('app');

@section('content')
    <h1>Write a new Article</h1>
    <hr>
    {!! Form::open(['url'=>'articles','files'=>true,'method' => 'POST']) !!}
       @include('articles.partials._form', ['submitText' => 'Create Article'])
    {!! Form::close() !!}
@stop
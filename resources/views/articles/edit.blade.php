@extends('app')

@section('content')
    <h1>Edit: {!! $article->title !!}</h1>

    {!! Form::model($article,  ['method' => 'PATCH', 'files'=>true, 'action'=>['ArticlesController@update', $article->id]]) !!}
        @include('articles.partials._form', ['submitText' => 'Update Article', 'tagList' => $article->getTagListAttribute()])
    {!! Form::close() !!}
@stop

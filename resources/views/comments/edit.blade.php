@extends('app')

@section('content')
    {!! Form::model($comment, ['method'=>'PATCH', 'route'=>['articles.comments.update', $article->id, $comment->id]]) !!}
        @include('comments.partials._form',['submitText'=>'Edit Comment'])
    {!! Form::close() !!}
@stop
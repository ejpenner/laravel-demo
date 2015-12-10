@extends('app')

@section('content')
    {!! Form::model(new App\Comment, ['route'=>['articles.comments.store', $article->id]]) !!}
    {{--{!! Form::hidden('user_id',$article->user_id) !!}--}}
        @include('comments.partials._form',['submitText'=>'Post Comment'])
    {!! Form::close() !!}
@stop
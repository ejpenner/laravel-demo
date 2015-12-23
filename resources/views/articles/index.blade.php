@extends('app')

@section('content')
@if(!Auth::guest())
    <p><b>Welcome, {{Auth::user()->name}}</b></p>
@endif
@include('auth.partials._login')
{!! link_to('/', 'Back', ['class' => 'btn btn-info']) !!} {!! link_to('articles/create', 'Make a new article', ['class' => 'btn btn-info']) !!}

@if (count($articles))
    <div class="container">
        <div class="row">
            @foreach(array_chunk($articles->getCollection()->all(), 2) as $row)
                 <div class="row">
                     @foreach($row as $article)
                        <div class="article">
                            <div class="col-md-1">
                                <h5><small><b>Published by:<br>{{ $article->user->name }} on {{ $article->created_at->format('m/d/y') }}</b></small></h5>
                            </div>
                            <div class="col-md-5">
                                <h3><a href="{{ action('ArticlesController@show', [$article->id]) }}">{{ $article->title }}</a></h3><br>
                                {!! Html::image($article->getThumbnail(), '', ['class' => 'articleImage']) !!}
                            </div>
                        </div>
                     @endforeach
                 </div>
            @endforeach
            <div class="container">
                {!! $articles->render() !!}
            </div>
        </div>
    </div>
@else
    <h2>No articles here...</h2>
@endif
@stop
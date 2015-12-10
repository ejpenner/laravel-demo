@extends('app')

@section('content')
            @if(!Auth::guest())
                <b>Welcome, {{Auth::user()->name}}</b>
            @endif
            @include('auth.partials._login')
            {!! link_to('/', 'Back', ['class' => 'btn btn-info']) !!} {!! link_to('articles/create', 'Make a new article', ['class' => 'btn btn-info']) !!}
        @if (count($articles))
            @for($i=0; $i<1; $i++)
                <div class="row">
                    @foreach($articles as $article)
                        @if($i % 2 <= 1)
                            <div class="col-md-1" style="padding:10px">
                                <h5><small><b>Published by:<br>{{ $article->user->name }} on {{ $article->created_at->format('m/d/y') }}</b></small></h5>
                            </div>
                            <div class="col-md-5">
                                <h3><a href="{{ action('ArticlesController@show', [$article->id]) }}">{{ $article->title }}</a></h3><br>
                                {!! Html::image($article->getThumbnail(), '', ['style' => 'border: solid black 1px; padding:1px;']) !!}
                            </div>
                         @endif
                    @endforeach
                </div>
            @endfor
        @else
            <h2>No articles here...</h2>
            <div class="column"></div>
        @endif
@stop
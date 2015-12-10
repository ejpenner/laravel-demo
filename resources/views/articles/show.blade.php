@extends('app')

@section('content')
    <h1>{{ $article->title }}</h1>

    <div class="container" style="padding:10px;">
        {!! link_to_route('articles.index', 'Back', null, ['class' => 'btn btn-info']) !!} | {{ $article->created_at->format('M-d-Y h:ia') }} | <small>{{ $article->created_at->diffForHumans() }}</small> <br><br>
        @if(!Auth::guest())
            @if (Auth::user()->id == $article->user_id)
                {!! Form::open(['class' => 'form-inline', 'method' => 'DELETE', 'route' => ['articles.destroy', $article->id]]) !!}
                {!! link_to_route('articles.edit', 'Edit', $article->id, ['class' => 'btn btn-info']) !!}
                |
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endif
        @endif
        <hr>
        <p>
            {{ $article->body }}
        </p>
        {!! Html::image($article->getImage(), '', ['style' => 'border: solid black 1px; padding:1px;']) !!}
    </div>

    @unless($article->tags->isEmpty())
        <h5>Tags:</h5>
        <div class="list-group">
            <ul style="display:inline-block;">
                @foreach($article->tags as $tag)
                    <li>{{$tag->name }}</li>
                @endforeach
            </ul>
        </div>
    @endunless

    @include('articles.partials._comments')
@stop
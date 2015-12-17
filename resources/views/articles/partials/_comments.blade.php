<div class="container">
    @if(!Auth::guest())
        {!! link_to_route('articles.comments.create', 'Comment', $article->id, ['class' => 'btn btn-info']) !!}
    @endif
    <hr>
    <div class="container">
        @foreach($article->comments as $comment)
            <div class="row">
                <div class="col-md-1">
                    <h4><b>{{ $comment->getUsername() }}</b> <i>posted:</i></h4>
                    @if (Auth::user()->id == $comment->user_id)
                        {!! Form::open(['class' => 'form-inline', 'method' => 'DELETE', 'route' => ['articles.comments.destroy', $article->id, $comment->id]]) !!}
                        {!! link_to_route('articles.comments.edit', 'Edit', [$article->id, $comment->id], ['class' => 'btn btn-info']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
                <div class="col-md-8" style="padding-top:20px;">
                    {{ $comment->body }}
                </div>
            </div>
        @endforeach
    </div>
</div>
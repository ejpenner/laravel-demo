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
                        {!! link_to_route('articles.comments.edit', 'Edit', [$article->id, $comment->id], ['class' => 'btn btn-info']) !!}
                    @endif
                </div>
                <div class="col-md-8" style="padding-top:20px;">
                    {{ $comment->body }}
                </div>
            </div>
        @endforeach
    </div>
</div>
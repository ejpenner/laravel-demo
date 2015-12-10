<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('published_at', 'Published at:', ['class' => 'control-label']) !!}
    {!! Form::input('datetime', 'published_at', date('Y-m-d h:i:s'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('file', 'File:') !!}
    {!! Form::file('image', null) !!}
</div>
<div class="form-group">
    {!! Form::label('taglist', 'Tags:') !!}
    {!! Form::select('taglist[]', $tags, $tagList, ['class' => 'form-control', 'multiple']) !!}
</div>
<div class="form-group">
    {!! Form::submit($submitText, ['class' => 'btn btn-primary form-control']) !!}
</div>
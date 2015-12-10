@extends('app')

@section('content')
    <div class="container">
        <form method="POST" action="/auth/login">
            {!! csrf_field() !!}

            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password:') !!}
                {!! Form::text('password', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('remember', 'Remember Me') !!}
                {!! Form::checkbox('remember', '1', null) !!}
            </div>

            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
@stop
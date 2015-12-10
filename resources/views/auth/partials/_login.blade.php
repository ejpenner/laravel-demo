@if(!Auth::guest())
    {!! link_to('auth/logout', 'Log Out',['class'=>'btn btn-info']) !!}
@else
    {!! link_to('auth/login', 'Log In',['class'=>'btn btn-info']) !!} | {!! link_to('auth/register', 'Register',['class' => 'btn btn-info'] ) !!}
@endif
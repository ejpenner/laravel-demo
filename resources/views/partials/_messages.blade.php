@if (Session::has('message'))
    <div class="alert alert-info">
        <p>{{ Session::get('message') }}</p>
    </div>
@endif
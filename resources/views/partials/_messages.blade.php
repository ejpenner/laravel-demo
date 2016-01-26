@if (Session::has('message'))
    <div id="alert" class="alert alert-info">
        <p>{{ Session::get('message') }}</p>
    </div>
    <script>
        $(document).ready(function(){
            $('#alert').delay(2000).fadeOut(400);
        });
    </script>
@endif
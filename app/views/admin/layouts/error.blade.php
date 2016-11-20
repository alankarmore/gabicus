@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{{ Session::get('error') }}</li>
        </ul>
    </div>
@endif
@if(Session::has('success_message'))
    <div class="alert alert-success">
        <ul>
            <li>{{ Session::get('success_message') }}</li>
        </ul>
    </div>
@endif
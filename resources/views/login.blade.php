<h2>Login</h2>
<div>
    <button style="cursor:pointer" type="button" onclick="window.location='{{ route("registration") }}'">Registration</button>
</div>

@if( Session::has('message') )
<div>
    <ul>
        <li>{{ Session::get('message') }}</li>
    </ul>
</div>
@endif

<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
<form method="POST" action="/">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="email">Email:</label>
        <input class="form-control" id="email" name="email">
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <div class="form-group">
        <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>
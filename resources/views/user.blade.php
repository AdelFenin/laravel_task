<h2>My Account</h2>
<div>
    <button style="cursor:pointer" type="button" onclick="window.location='{{ route("logout") }}'">Logout</button>
</div>
@if( Session::has('message') )
<div>
    <ul>
        <li>{{ Session::get('message') }}</li>
    </ul>
</div>
@endif

<h4>My Info</h4>
<div>
    <label for="name">Email: {{ Auth::user()->email }}</label>
</div>

<form method="POST" action="/user/my">
    @method('PATCH')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
    </div>

    <div class="form-group">
        <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<h4>Change Password</h4>

<form method="POST" action="/user/my/password">
    @method('PATCH')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="password">Old Password:</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <div class="form-group">
        <label for="password_new">New Password:</label>
        <input type="password" class="form-control" id="password_new" name="password_new">
    </div>

    <div class="form-group">
        <label for="password_new_confirmation">Password Confirmation:</label>
        <input type="password" class="form-control" id="password_new_confirmation" name="password_new_confirmation">
    </div>

    <div class="form-group">
        <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<h4>Addition Info</h4>

<div>
    <label for="name">Status:
        @if(Auth::user()->verified)
        Verified
        @else
        Not Verified
        @endif
    </label>
</div>
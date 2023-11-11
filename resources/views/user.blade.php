<h2>My Account</h2>

<div>
    <label for="name">Email: {{ Auth::user()->email }}</label>
</div>

<form method="POST" action="/registration">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="'{{ Auth::user()->name }}'">
    </div>
</form>

@if(Auth::user()->verified)
<div>Verified</div>
@else
<div>Not Verified</div>
@endif
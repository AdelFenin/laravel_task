<div>USER</div>
<div>{{ Auth::user()->email }}</div>
@if(Auth::user()->verified)
<div>Verified</div> 
@else
<div>Not Verified</div>
@endif

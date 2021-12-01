<form class="search" type="get" action="{{ route('searchAdminPage') }}">
    @csrf     
  <div class="input-group md-form form-sm form-1 pl-0">
    <div class="input-group-prepend">
      <span class="input-group-text purple lighten-3" id="basic-text1"><i class="fas fa-search text-danger" aria-hidden="true"></i></span>
    </div>
    <input class="form-control my-0 py-1" name="query" type="search" placeholder="Zoek" aria-label="Search">
  </div>
</form>

@foreach ($search as $s)
<div class="">
    <a> name:{{ $s->name }} </a><br>
    <a> email:{{ $s->email }}</a><br>
    <a> role:{{ $s->user_role }}</a><br>
    @if ($s->id == auth()->id())
        <a>You cannot change your own account</a><br>
        <a href="{{ route('destroyUserPage', [$s->id]) }}">Delete your own account!</a><br>
    @else
        <a href="{{ route('changeUserForm', [$s->id]) }}"> Change this user role</a><br>
        <a href="{{ route('destroyUserPage', [$s->id]) }}">Delete this user</a><br>
    @endif
    

    <a>-------------------</a><br>
</div>

@endforeach   
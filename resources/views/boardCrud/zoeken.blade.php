

<form class="search" type="get" action="{{ route('search', $board_id) }}">
        @csrf        
    <div class="input-group md-form form-sm form-1 pl-0">
      <div class="input-group-prepend">
        <span class="input-group-text purple lighten-3" id="basic-text1"><i class="fas fa-search text-danger"
            aria-hidden="true"></i></span>
      </div>
      <input class="form-control my-0 py-1" name="query" type="search" placeholder="Zoek" aria-label="Search">
    </div>
</form>


 @foreach ($search as $s)
 <a class="card-title" href="{{route("addToBoard" , [$board_id, $s['id']])}}"> {{$s['name']}} </a>

@endforeach   


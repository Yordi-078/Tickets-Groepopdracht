@extends('layouts.app')

@section('content')
<div class="form-container">

    <div class="form-header">
        Alle gebruikers:
    </div>

    <div class="form-body">
        @foreach($allUsers as $allUsersThisBoard)
            {{$allUsersThisBoard["name"]}}
            <br><hr><br>
        @endforeach
    </div>

</div>
@endsection

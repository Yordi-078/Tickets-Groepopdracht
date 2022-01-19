@extends('layouts.app')

@section('content')
<div class="form-container">

    <div class="form-header">
        <h1>Alle gebruikers:</h1>
    </div>

    <div class="form-body">
        @foreach($allUsers as $allUsersThisBoard)
            {{$allUsersThisBoard["name"]}}
            <br><br>
        @endforeach
    </div>

</div>
@endsection

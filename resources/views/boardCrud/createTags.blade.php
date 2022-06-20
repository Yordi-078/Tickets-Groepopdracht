@extends('layouts.app')

@section('content')
<div class="form-container">
    <div class="form-header">
        <div class="form-header-image"><i class="fa fa-clipboard-list"></i></div>
        <h1>maak een tag aan</h1>
    </div>
    <form class="make-card-form" method="POST" action="{{ url('storeTag', $board_id) }}">
    @csrf
        <div class="">
            <label class="label" for="name">naam: </label>
            <input class="form-input-container input @error('name') is-danger @enderror" type="text" name="name" maxlength="10" value="{{ old('name') }}">
            
            @error('name')
                <p class="help is-danger">{{ $errors->first('name') }}</p>
            @enderror
        </div>
       
        <button class="form-submit-button is-link" type="submit">Toevoegen</button> 
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="form-container">
    <div class="form-header">
        <div class="form-header-image"><i class="fa fa-clipboard-list"></i></div>
        <h1>Leskaart aanmaken</h1>
    </div>
    <form class="make-card-form" method="POST" action="{{ url('storeLessonCard', $board_id) }}">
    @csrf
        <div class="">
            <label class="label" for="name">Naam: </label>    
            <input class="form-input-container input @error('name') is-danger @enderror" type="text" name="name" id="" value="{{ old('name') }}">
            
            @error('name')
                <p class="help is-danger">{{ $errors->first('name') }}</p>
            @enderror
        </div>

        <div class="">
            <label class="label" for="description">Beschrijving: </label>  
            <textarea class="form-input-container input @error('description') is-danger @enderror" type="text" name="description" id="" maxlength="69" value="{{ old('description') }}"></textarea>
        
            @error('description')
                <p class="help is-danger">{{ $errors->first('description') }}</p>
            @enderror
        </div>

        <div class="">
            <label class="label" for="start_time">Starttijd: </label>    
            <input class="form-input-container input @error('description') is-danger @enderror" type="datetime-local" name="start_time" id="" value="{{ old('start_time') }}">
            
            @error('description')
                <p class="help is-danger">{{ $errors->first('start_time') }}</p>
            @enderror
        </div>
        <button class="form-submit-button is-link" type="submit">Aanmaken</button> 
    </form>
</div>
@endsection
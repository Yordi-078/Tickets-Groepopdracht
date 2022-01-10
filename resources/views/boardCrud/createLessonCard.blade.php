@extends('layouts.app')

@section('content')
<div class="form-container">
    <div class="form-header">
        <h1>maak een lesson card aan</h1>
    </div>
    <form method="POST" action="{{ url('storeLessonCard', $board_id) }}">
    @csrf
        <div>
            <label class="label" for="name">Name: </label>    
            <input class="input @error('name') is-danger @enderror" type="text" name="name" id="" value="{{ old('name') }}">
            
            @error('name')
                <p class="help is-danger">{{ $errors->first('name') }}</p>
            @enderror
        </div>

        <div>
            <label class="label" for="description">description: </label>  
            <input class="input @error('description') is-danger @enderror" type="text" name="description" id="" value="{{ old('description') }}">
        
            @error('description')
                <p class="help is-danger">{{ $errors->first('description') }}</p>
            @enderror
        </div>

        <div>
            <label class="label" for="start_time">start_time: </label>    
            <input class="input @error('description') is-danger @enderror" type="datetime-local" name="start_time" id="" value="{{ old('start_time') }}">
            
            @error('description')
                <p class="help is-danger">{{ $errors->first('start_time') }}</p>
            @enderror
        </div>
        <button class="form-submit-button is-link" type="submit">Submit</button> 
    </form>
</div>
@endsection
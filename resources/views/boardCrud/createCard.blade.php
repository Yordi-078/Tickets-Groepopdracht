@extends('layouts.app')

@section('content')
<div class="form-container">
    <div class="form-header">
        <h1>maak een card aan</h1>
    </div>
    <form method="POST" action="{{ url('storeCard', $board_id) }}">
    @csrf
        <div class="">
            <label class="label" for="name">name: </label>
            <input class="input @error('name') is-danger @enderror" type="text" name="name" value="{{ old('name') }}">
            
            @error('name')
                <p class="help is-danger">{{ $errors->first('name') }}</p>
            @enderror
        </div>
        <div class="">
            <label class="label" for="description">description: </label>   
            <input class="input @error('description') is-danger @enderror" type="text" name="description" value="{{ old('description') }}">
            
            @error('description')
                <p class="help is-danger">{{ $errors->first('description') }}</p>
            @enderror
        </div>
        <button class="form-submit-button is-link" type="submit">Submit</button> 
    </form>
</div>
@endsection

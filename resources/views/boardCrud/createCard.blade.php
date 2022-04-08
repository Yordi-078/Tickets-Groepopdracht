@extends('layouts.app')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<style type="text/css"></style>
@section('content')
<div class="form-container">
    <div class="form-header">
        <div class="form-header-image"><i class="fa fa-clipboard-list"></i></div>
        <h1>maak een card aan</h1>
    </div>
    <form class="make-card-form" method="POST" action="{{ url('storeCard', $board_id) }}">
    @csrf
        <div class="">
            <label class="label" for="name">name: </label>
            <input class="form-input-container input @error('name') is-danger @enderror" type="text" name="name" value="{{ old('name') }}">
            
            @error('name')
                <p class="help is-danger">{{ $errors->first('name') }}</p>
            @enderror
        </div>
        <div class="">
            <label class="label" for="description">description: </label>   
            <textarea class="form-input-container input @error('description') is-danger @enderror" type="text" name="description" maxlength="69" value="{{ old('description') }}"></textarea>
            
            @error('description')
                <p class="help is-danger">{{ $errors->first('description') }}</p>
            @enderror
      

        <div class="">
        <select class="selectpicker" name="tag_id[]" id="tag_id" multiple>
            @foreach ($tags as $tag)
            <option  value="{{$tag->id}}"> {{$tag->name}}</option>
            @endforeach 
            </select>
        </div>



        <button class="form-submit-button is-link" type="submit">Submit</button> 
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').selectpicker();
    });
</script>

@endsection

@extends('layouts.app')

@section('content')
<div class="form-container">
<div class="form-header">
        <h1>maak een board aan</h1>
    </div>
<form  method="POST" action="{{url('/home')}}">
    @csrf
    <label for="name">name</label>
    <input type="text" id="name" name="name" required>

    
    <div style="display: none;">
    <input type="text" id="madeby_id" name="madeby_id" value="{{ Auth::user()->id }}">
    </div>  

    
    <label for="description">description</label>
    <input type="text" id="description" name="description">

    <button type="submit" class="form-submit-button">Maak board aan</button>
  </form>
  
</div>
@endsection

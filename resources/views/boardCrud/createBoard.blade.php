@extends('layouts.app')

@section('content')
<div class="form-container">
  <div class="form-header">
    <div class="form-header-image"><i class="fa fa-chalkboard"></i></div>
    <h2>maak een board aan</h2>
  </div>

  <form  method="POST" action="{{url('/home')}}" class="create-board-form">
    @csrf
    <div class="form-input-container">
      <label for="name"><i class="fas fa-user"></i></label>
      <input type="text" id="name" name="name" class="form-input" required>
    </div>
    
    <div style="display: none;">
    <input type="text" id="madeby_id" name="madeby_id" value="{{ Auth::user()->id }}">
    </div>  

    
    <div class="form-input-container">
      <label for="description"><i class="fa fa-align-center"></i></label>
      <textarea type="description" id="description" name="description" class="form-input" maxlength="200"></textarea>
    </div>
    <button type="submit" class="form-submit-button">Maak board aan</button>
  </form>
  
</div>
@endsection

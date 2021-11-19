<form  method="POST" action="{{url('/home')}}">
    @csrf
    <label for="name">name</label>
    <input type="text" id="name" name="name">

    
    <div style="display: none;">
    <input type="text" id="madeby_id" name="madeby_id" value="{{ Auth::user()->id  }}">
    </div>  

    
    <label for="description">description</label>
    <input type="text" id="description" name="description">

    <button type="submit" class="btn">Maak board aan</button>
  </form>
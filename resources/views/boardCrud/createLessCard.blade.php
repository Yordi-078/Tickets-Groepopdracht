<form method="POST" action="{{ url('storeLessonCard', $board_id) }}">
    @csrf
        <div class="field">
            <label class="label" for="name">Name: </label>

            <div class="control">    
                <input class="input @error('name') is-danger @enderror" type="text" name="name" id="" value="{{ old('name') }}">
            
            @error('name')
                <p class="help is-danger">{{ $errors->first('name') }}</p>
            @enderror
            </div>

            <div class="field">
            <label class="label" for="description">description: </label>

            <div class="control">    
                <input class="input @error('description') is-danger @enderror" type="text" name="description" id="" value="{{ old('description') }}">
            
            @error('description')
                <p class="help is-danger">{{ $errors->first('description') }}</p>
            @enderror
            </div>

            <div class="field">
                <label class="label" for="start_time">start_time: </label>
    
                <div class="control">    
                    <input class="input @error('description') is-danger @enderror" type="text" name="start_time" id="" value="{{ old('start_time') }}">
                
                @error('description')
                    <p class="help is-danger">{{ $errors->first('start_time') }}</p>
                @enderror
                </div>
        </div>

            <div class="field is-grouped">
            <div class="control">
                <button class="button is-link" type="submit">Submit</button>
            </div>
        </div> 

    </form>
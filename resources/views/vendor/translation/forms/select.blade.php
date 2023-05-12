<div class="select-group ml-3 mr-3" >

    <select class="custom-select" style="width:200px;" name="{{ $name }}" @if(isset($submit) && $submit) v-on:change="submit" @endif>
         @foreach($items as $key => $value)
            @if(is_numeric($key))
                <option value="{{ $value }}" @if(isset($selected) && $selected === $value) selected="selected" @endif>{{ $value }}</option>
            @else
                <option value="{{ $key }}" @if(isset($selected) && $selected === $key) selected="selected" @endif>{{ $value }}</option>
            @endif
        @endforeach
    </select>


</div>
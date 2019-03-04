<div class="result_title">
    <h3>{{isset($h3) ? $h3 : ''}}</h3>
    @if(count($errors) > 0)
        <div class="mark">
            @foreach($errors->all() as $error)
                <p> {{$error}}</p>
            @endforeach
        </div>
    @endif
</div>
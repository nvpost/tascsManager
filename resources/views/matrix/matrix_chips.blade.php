

@foreach($field as $f)
    <div class="chip tasc_item " draggable="true" data-id="{{$f['id']}}"  @click="getTascData({{$f['id']}})">
        {{$f['label']}}
    </div>
@endforeach





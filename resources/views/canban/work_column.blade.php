<div class="column work_column" data-field={{$board['id']}} data-position={{$board['position']}} id='col_{{$board['id']}}'>
    <span class="material-icons close_icon active_icons" onclick="deleteColumn({{$board['id']}})">
        close
    </span>
    <h4 class="board_header">{{$board['name']}} ({{$board['position']}})</h4>

        @foreach($tascs as $tasc)
            @if(isset($tasc['tascs']))
                @include('canban.tasc_item', ['tasc'=>$tasc['tascs']])
            @endif
        @endforeach


</div>

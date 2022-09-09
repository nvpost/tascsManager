<div class="column first_board" data-field='0'>
    <h4>Все задачи</h4>
    @if($tascs)
        @foreach($tascs as $tasc)
            @include('canban.tasc_item', ['tasc'=>$tasc])
        @endforeach
    @endif
</div>

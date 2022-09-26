@extends('layout')
@section('title')
    Канбан
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js" integrity="sha512-zYXldzJsDrNKV+odAwFYiDXV2Cy37cwizT+NkuiPGsa9X1dOz04eHvUWVuxaJ299GvcJT31ug2zO4itXBjFx4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



@section('main_content')
    @php
        $project = $projects->firstWhere('id', $id);
    @endphp

    <h3>Канбан {{$project? $project->label : ''}}</h3>
@include('matrix.select')
<div class="modal_tascs_app">
@if(count($canbans)>0)
    @foreach($canbans as $canban)
        <div class="canban_line">
        <h4>{{$canban['name']}}</h4>
            <div class="boards_field">
                        <div class="boards_line row">
                            @include('canban.first_canban_column', ['tascs'=>$tascs])

                            @php
                            $sorted_boards = $canban['boards'];

                            function compare_weights($a, $b) {
                                if($a['position'] == $b['position']) {
                                    return 0;
                                }
                                return ($a['position'] < $b['position']) ? -1 : 1;
                            }
                            usort($sorted_boards, 'compare_weights');

                            @endphp
                            @foreach($sorted_boards as $key=>$board)
                                @include('canban.work_column', ['tascs'=>$board['tascs_canban_meta'], 'board'=>$board])
                            @endforeach
                                @include('canban.add_board_modal', ['canban'=>$canban])
                        </div>
            </div>
        </div>
    @endforeach

    @include('parts.vue_tasc_modal')
@endif
</div>
<div class="add_btn">
@if($id)
    <div class="add_canban_actions">
    @include('canban.add_canban')
    </div>
@endif
</div>

@endsection





@section('scripts')
    <script>

        let headers = {
            "X-CSRF-Token":"{{csrf_token()}}",
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        }

        document.addEventListener('DOMContentLoaded', function() {

            const board = document.querySelector(".boards_line");
            new Sortable(board, {
                group: "colums",
                filter: '.board_header, tasc_item',
                cursor: "pointer",
                animation: 150,
                ghostClass: "blue-background-class"
            })

            var columns_items = document.querySelectorAll(".column")

            columns_items.forEach((item) => {
                item.addEventListener('dragend', setBoardPosition);
            })

            const column = document.querySelectorAll(".column");
            column.forEach((column, idx) => {
                new Sortable(column, {
                    group: "tascs",
                    filter: '.board_header',
                    cursor: "pointer",
                    animation: 150,
                    ghostClass: "blue-background-class"
                })
            })

            var tasc_items = document.querySelectorAll(".tasc_item")

            tasc_items.forEach((item) => {
                item.addEventListener('dragend', setMatrixField);
            })

        })




        function setMatrixField(e){

            e.preventDefault();
            let tasc_id = e.currentTarget.getAttribute('data-id')
            let board_id = e.currentTarget.parentNode.getAttribute('data-field')

            fetch("{{route('user.setCanbanStatus')}}", {
                method: "POST",
                headers: headers,
                body: JSON.stringify({tasc_id, board_id})
            }).then(res=>res.json())
                .then((data=>console.log(data)))

        }

        function goToProject(e){
            let v = e.target.value
            if(v == 'all'){
                window.location.href = '/canban';
            }else{
                window.location.href = '/canban/'+v;
            }
        }


        function deleteColumn(id){

            column = document.querySelector('#col_'+id)
            tascs = column.querySelectorAll('.tasc_item')
            if(tascs.length > 0){
                alert('Есть задачи, сначала переместите их')
            }else{
                fetch("{{route('user.deleteBoard')}}", {
                    method: "POST",
                    headers: headers,
                    body: JSON.stringify({id})
                }).then(res=>res.json())
                    .then((data=>console.log(data)))
            }
        }

        function setBoardPosition(e){

            if(!e.target.classList.contains('work_column')){
                return false
            }

            let nd = document.querySelectorAll('.work_column')
            let wc = Array.prototype.slice.call(nd, 0)

            let new_positions = []
            wc.forEach((i, idx) => {
                new_positions.push({'id': i.getAttribute('data-field'), 'position': idx})

            })

            fetch("{{route('user.changePosition')}}", {
                method: "POST",
                headers: headers,
                body: JSON.stringify({new_positions})
            }).then(res=>res.json())
                .then((data=>console.log(data)))


        }


    </script>
    @include('parts.vue_tasc_modal_app')
@endsection

@extends('layout')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"
        integrity="sha512-zYXldzJsDrNKV+odAwFYiDXV2Cy37cwizT+NkuiPGsa9X1dOz04eHvUWVuxaJ299GvcJT31ug2zO4itXBjFx4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>




@section('main_content')

    @php
        $f1=[]; $f2=[]; $f3=[]; $f4=[];


        foreach ($tascs as $tasc){
            if($tasc->MatrixMeta==null){
                array_push($f4, $tasc);
                continue;
            }
            if($tasc->MatrixMeta->matrix_id == 1){
                array_push($f1, $tasc);
                continue;
            }
            if($tasc->MatrixMeta->matrix_id == 2){
                array_push($f2, $tasc);
                continue;
            }
            if($tasc->MatrixMeta->matrix_id == 3){
                array_push($f3, $tasc);
                continue;
            }
            if($tasc->MatrixMeta->matrix_id == 4){
                array_push($f4, $tasc);
                continue;
            }

        }

        $field_texts = [
            ['text' => 'Важно и срочно', 'color'=>'red darken-1'],
            ['text' => 'Важно и не срочно', 'color'=>'blue darken-1'],
            ['text' => 'Не важно и срочно', 'color'=>'green darken-1'],
            ['text' => 'Неважно и не срочно', 'color'=>'lime darken-1'],
            ];


    @endphp

    <h3>Матрица Эйзенхауэра. {{ $id ? $projects->firstWhere('id', $id)->label : '' }}</h3>


    @include('matrix.select', ['route'=>'matrix'])

    <div class="matrix_board modal_tascs_app">


        @foreach(range(1, 4) as $i)
            <div class="matrix_field {{ $field_texts[$i-1]['color'] }}" data-field="{{$i}}">
                <div class="matrix_header">{{$field_texts[$i-1]['text']}}</div>
                @include('matrix.matrix_chips', ['field' => ${'f'.$i}, 'style' => $field_texts[$i-1]])


            </div>
        @endforeach

        @include('parts.vue_tasc_modal')
    </div>

@endsection

@section('scripts')
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const columns = document.querySelectorAll(".matrix_field");

            columns.forEach((column, idx) => {
                new Sortable(column, {
                    group: "shared",
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

        function setMatrixField(e) {
            e.preventDefault();
            let tasc_id = e.currentTarget.getAttribute('data-id')
            let matrix_id = e.currentTarget.parentNode.getAttribute('data-field')

            console.log(tasc_id, matrix_id)
            fetch("{{route('user.setMatrixStatus')}}", {
                method: "POST",
                headers: {
                    "X-CSRF-Token": "{{csrf_token()}}",
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({tasc_id, matrix_id})
            }).then(res => res.json())
                .then((data => console.log(data)))

        }

        function goToProject(e) {
            let v = e.target.value
            if (v == 'all') {
                window.location.href = '/matrix';
            } else {
                window.location.href = '/matrix/' + v;
            }
        }


    </script>
    @include('parts.vue_tasc_modal_app')
@endsection




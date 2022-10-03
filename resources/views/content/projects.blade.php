@extends('layout')
@section('title')
    Все проекты
@endsection
@section('main_content')
<h1>Мои проекты</h1>

@if(count($projects)>0)
    @include('content.Projects_table', ['projects'=>$projects, 'addToteam' => false])
@else

    <p>Пока нет проектов</p>
@endif


<div class="active_block_btns">
<a class="waves-effect waves-light btn" href="{{ route('user.projects_add') }}"><i class="material-icons left">add</i>Добавить проект</a>
</div>
@endsection

@section('scripts')
    <script>

        let headers = {
            "X-CSRF-Token":"{{csrf_token()}}",
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        }

        function removeProject(id){
            console.log(id)
            fetch("{{route('user.removeProject_getInfo')}}", {
                method: "POST",
                headers: headers,
                body: JSON.stringify({id})
            }).then(res=>res.json())
                .then((data=>{
                        //window.location.reload()
                        console.log(data)
                    }
                ))
        }
    </script>

@endsection




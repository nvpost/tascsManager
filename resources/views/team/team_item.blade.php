@extends('layout')

@section('main_content')

    <h1 id="h1">Команда "{{$team['name']}}"</h1>


    <div class="description">
        <p id="text_description">{{$team['description']}}</p>
    </div>

    <div class="team_projects">
        <h3>Проекты команды</h3>

        @include('content.Projects_table', ['projects'=>$projects, 'addToteam'=>true])
            @if($team['creator_id'] == Auth::user()->id)
                @include('team.pin_more_projects')
            @endif

{{--        <div class="active_block_btns">--}}
{{--            <a class="waves-effect waves-light btn" href="{{ route('user.projects_add') }}"><i class="material-icons left">add</i>Добавить проект</a>--}}
{{--        </div>--}}

    </div>

    <div class="team_users">
        <h3>Состав команды</h3>

        @foreach($users as $row)
            @include('team.users')
        @endforeach

        @if($team['creator_id'] == Auth::user()->id)
            <div class="active_block_btns">
                @include('team.add_user_modal')
            </div>
        @endif

    </div>



    @if($team['creator_id'] == Auth::user()->id)
        <div class="edit_team float_edit_banner">
        <span class="edit_icon material-icons"
              onclick="startEdit()">edit</span>
        </div>

        @include('team.edit_team_modal')
    @endif
@endsection

@if($team['creator_id'] == Auth::user()->id)
@section('scripts')
    <script>




        var headers={
            "X-CSRF-Token":"{{csrf_token()}}",
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        }

        function pinToTeam(project_id, team_id){

            fetch("{{route('user.pinToTeam')}}", {
                method: "POST",
                headers: headers,
                body: JSON.stringify({project_id, team_id})
            }).then(res=>res.json())
                .then(data=>{
                    console.log(data)
                })

        }


        function removeUser(user_id, team_id){
            console.log(user_id, team_id)
            fetch("{{route('user.TeamRemoveUser')}}", {
                method: "POST",
                headers: headers,
                body: JSON.stringify({user_id, team_id})
            }).then(res=>res.json())
                .then(data=>{
                    console.log(data)
                })
        }

    </script>
@endsection
@endif

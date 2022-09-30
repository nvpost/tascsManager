<table class="table_left_params">
    <thead>
    <tr>
        <th>Название</th>
        <th>Описание</th>
        <th>Участники</th>
        <th>Проекты</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($teams as $team)

        <tr>
            <td><a href="{{ route('user.team_item',['id'=>$team['id']]) }}">
                    {{$team['name']}}
                </a>
                @if($team['get_creator']['id']!=Auth::user()->id)
                     ({{$team['get_creator']['name']}})

                @endif

            </td>
            <td>{{$team['description']}}</td>
            <td>{{count($team['get_users_meta']) }}</td>
            <td>{{count($team['get_team_meta']) }}</td>
            <td>
                @if($team['get_creator']['id']!=Auth::user()->id)
                    <span
                        class="delete_icon material-icons active_icons"
                        onclick="removeTeamUser('{{$team['id']}}')">person_remove_alt_1</span>
                @else
                    <span
                        class="delete_icon material-icons active_icons"
                        onclick="removeTeam('{{$team['id']}}')">delete_forever</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@section('scripts')
    <script>
        let headers = {
            "X-CSRF-Token":"{{csrf_token()}}",
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        }

        function removeTeam(id){
            console.log(id)
            fetch("{{route('user.removeTeam')}}", {
                method: "POST",
                headers: headers,
                body: JSON.stringify({id})
            }).then(res=>res.json())
                .then((data=>{
                    console.log(data)
                    // window.location.reload()
                    }
                ))
        }


        function removeTeamUser(team_id){
            fetch("{{route('user.selfRemoveUser')}}", {
                method: "POST",
                headers: headers,
                body: JSON.stringify({team_id})
            }).then(res=>res.json())
                .then((data=>{
                        console.log(data)
                        // window.location.reload()
                    }
                ))
        }
    </script>
@endsection

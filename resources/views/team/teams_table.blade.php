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

            </td>
            <td>{{$team['description']}}</td>
            <td>{{count($team['get_users_meta']) }}</td>
            <td>{{count($team['get_team_meta']) }}</td>
            <td><span
                    class="delete_icon material-icons active_icons"
                onclick="removeTeam('{{$team['id']}}')">delete_forever</span></td>
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
    </script>
@endsection

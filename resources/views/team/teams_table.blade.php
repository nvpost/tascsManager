<table>
    <thead>
    <tr>
        <th>Название</th>
        <th>Описание</th>
        <th>Участники</th>
        <th>Проекты</th>
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
        </tr>
    @endforeach
    </tbody>
</table>

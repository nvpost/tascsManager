<table class="table_left_params">
    <thead>
    <tr>
        <th>Название</th>
        <th>Создатель</th>
        <th>Задач</th>
        <th>Старт</th>
        <th>Финиш</th>
        @if($addToteam)
            <th>Закрепить за командой</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($projects as $p)

        <tr>
            <td>
                <a href="/project/{{$p['id']}}">
                    <span class="title">{{$p['label']}}</span>
                </a>
            </td>
            <td>
                <span>{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
            </td>
            <td>
                <span>{{count($p['tascs'])}}</span>
            </td>
            <td>{{\Carbon\Carbon::parse($p['start_date'])->format('d.m.Y')}}</td>
            <td>{{\Carbon\Carbon::parse($p['finish_date'])->format('d.m.Y')}}</td>
            @if($addToteam)
                <td>
                    <p>
                        <label>
                            @php
                            $checked = '';
                            if(count($p['get_team_meta'])>0){

                                $t_id = $p['get_team_meta'][0]['team_id'];
                                $p_id = $p['get_team_meta'][0]['project_id'];

                                if($t_id == $team['id'] && $p_id == $p['id']){
                                    $checked = 'checked';
                                }
                            }
                            @endphp

                            <input type="checkbox"
                                   onclick="pinToTeam('{{$p['id']}}', '{{$team['id']}}')"
                                   {{$checked}}
                            />
                            <span></span>
                        </label>
                    </p>
                </td>
            @endif
        </tr>


    @endforeach
    </tbody>
</table>

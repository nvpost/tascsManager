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
        @else
            <th></th>
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

            @else
{{--                @if(Auth::user()->id == $p['user_id'])--}}
                @if(Gate::check('canEdit', $p['user_id']))
                    <td>
                        <span
                            class="delete_icon material-icons active_icons"
                            onclick="removeProject('{{$p['id']}}')">delete_forever</span>
                    </td>
                @endif
            @endif
        </tr>


    @endforeach
    </tbody>
</table>

@if(Gate::check('canEdit', $p['user_id']))
    @include('content.project_info')
<script>
    function drowFialogProjectInfo(project){
        console.log(project)
        var modal = document.querySelector('#remove_project_info')
        var instance = M.Modal.getInstance(modal)

        modal.querySelector('h4').innerText = 'Удалить проект '+project.label
        modal.querySelector('#project_id').value = project.id

        let filesCount = 0
        project.tascs.forEach(i=>{
            filesCount += i.tasc_files.length
        })
        let content = "<h6>За проектом закреплено:</h6>"

        content += ifhave(project.tascs.length) ? '<p>Задач: '+project.tascs.length+' и '+filesCount+'шт. файлов</p>': ''
        content += ifhave(project.get_team_meta.length) ? '<p>Команд: '+project.get_team_meta.length+'</p>': ''
        content += ifhave(project.get_canbans_meta.length) ? '<p>Канбан: '+project.get_canbans_meta.length+'</p>': ''
        modal.querySelector('.project_info').innerHTML = content
        instance.open()
        instance.options.onCloseEnd = () => {
            closeProjectInfoModal()
        }

    }

    function ifhave(n){
        return n>0
    }
</script>
@endif





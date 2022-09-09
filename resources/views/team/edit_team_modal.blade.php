

<div id="edit_team" class="modal tasc_modal">
    <div class="modal-content">
        <h4>Редактировать команду</h4>
        <form method="POST" action="{{route('user.editTeamInfo')}}"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" id="id" name="id" value="{{$team['id']}}">
                    <input type="text" id="name" name="name" value="{{$team['name']}}">
                    <label for="name">Название команды</label>
                </div>

                <div class="input-field textarea_field col s12">
                    <textarea id="description" name="description" rows="7" cols="5"></textarea>
                    <label for="description">{{$team['description']}}</label>
                </div>



            </div>
            <button type="submit" class="modal-close btn waves-effect waves-light">Применить</button>
        </form>
    </div>

</div>

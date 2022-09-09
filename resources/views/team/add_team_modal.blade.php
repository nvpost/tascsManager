<a class="waves-effect waves-light btn modal-trigger" href="#add_team"><i class="material-icons left">add</i>Добавить команду</a>

<div id="add_team" class="modal tasc_modal">
    <div class="modal-content">
        <h4>Добавить команду</h4>
        <form method="POST" action="{{route('user.add_team')}}"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="name" name="name" class="validate">
                    <label for="name">Название команды</label>
                </div>

                <div class="input-field textarea_field col s12">
                    <textarea id="description" name="description" rows="7" cols="5"></textarea>
                    <label for="description">Функционал</label>
                </div>



            </div>
            <button type="submit" class="modal-close btn waves-effect waves-light">Добавить</button>
        </form>
    </div>

</div>

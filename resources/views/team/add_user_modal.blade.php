<a class="waves-effect waves-light btn modal-trigger" href="#add_user"><i class="material-icons left">add</i>Добавить сотрудника</a>



<div id="add_user" class="modal tasc_modal">
    <div class="modal-content">
        <h4>Добавить пользователя в команду</h4>
        <form method="POST" action="{{route('user.team_user_add')}}"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" id="id" name="id" value="{{$team->id}}">
                    <input type="text" id="email" name="email" class="validate">
                    <label for="email">email</label>
                </div>

            </div>
            <button type="submit" class="modal-close btn waves-effect waves-light">Добавить</button>
        </form>
    </div>

</div>




<a class="waves-effect waves-light btn modal-trigger" href="#add_member"><i class="material-icons left">add</i>Добавить участника</a>

<div id="add_member" class="modal tasc_modal">
    <div class="modal-content">
        <h4>Добавить участника</h4>
        <form method="POST" action="{{route('user.member_add')}}"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" id="project_id" name="canban_id" value="">
                    <input type="hidden" id="position" name="position" value="">
                    <input type="text" id="name" name="name" class="validate">
                    <label for="name">Название</label>
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

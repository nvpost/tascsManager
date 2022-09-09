<a class="waves-effect waves-light btn modal-trigger" href="#add_canban"><i class="material-icons left">add</i>Добавить Канбан</a>
<!-- Modal Structure -->


<div id="add_canban" class="modal tasc_modal">
    <div class="modal-content">
        <h4>Добавить Канбан к проекту {{$project->label}}</h4>
        <form method="POST" action="{{route('user.canban_add')}}"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" id="project_id" name="project_id" value="{{$project->id}}">
                    <input type="text" id="name" name="name" class="validate">
                    <label for="label">Название</label>
                </div>

                <div class="input-field textarea_field col s12">
                    <textarea id="description" name="description" rows="7" cols="5"></textarea>
                    <label for="description">Описание</label>
                </div>


            </div>
            <button type="submit" class="modal-close btn waves-effect waves-light">Добавить</button>
        </form>
    </div>

</div>




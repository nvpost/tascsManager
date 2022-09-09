<a class="waves-effect waves-light btn modal-trigger" href="#add_tasc"><i class="material-icons left">add</i>Добавить задачу</a>


@php
    if(!isset($project)){
        $project = $projects->firstWhere('id', $id);
    }

@endphp
<div id="add_tasc" class="modal tasc_modal">
    <div class="modal-content">
        <h4>Добавить задачу к проекту {{$project->label}}</h4>
        <form method="POST" action="{{route('user.tasc_add')}}"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" id="project_id" name="project_id" value="{{$project->id}}">
                    <input type="text" id="label" name="label" class="validate">
                    <label for="label">Название</label>
                </div>

                <div class="input-field textarea_field col s12">
                    <textarea id="description" name="description" rows="7" cols="5"></textarea>
                    <label for="description">Описание</label>
                </div>

                <div class="input-field status_field col s12">
                    <select type="text" id="matrix" name="matrix">
                        <option value="0" default selected disabled>Выбрать важность</option>
                        <option value="1">Важно и срочно</option>
                        <option value="2">Важно и не срочно</option>
                        <option value="3">Не важно и срочно</option>
                        <option value="4">Неважно и не срочно</option>
                    </select>
                    <label for="matrix">Выбрать важность</label>
                </div>

                <div class="input-field col s12">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Файл</span>
                            <input type="file" name="files[]" id="files[]" multiple>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Можно приложить несколько файлов">
                        </div>
                    </div>
                </div>

                <div class=" col s4">
                    <input type="text" id="start_date" name="start_date" class="datepicker">
                    <span class="helper-text" data-error="wrong" data-success="right">Старт</span>
                </div>
                <div class="col s1"> </div>
                <div class=" col s4">
                    <input type="text" id="finish_date" name="finish_date" class="datepicker">
                    <span class="helper-text" data-error="wrong" data-success="right">Финиш</span>
                </div>
            </div>
            <button type="submit" class="modal-close btn waves-effect waves-light">Добавить</button>
        </form>
    </div>

</div>



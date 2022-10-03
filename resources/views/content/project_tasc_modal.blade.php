

@php
$disabled = "disabled";
if(Gate::any(['canEdit', 'isAdmin'], [$t->user_id])){
   $disabled = "";
}
@endphp
<div id="tasc_modal_{{$t->id}}" class="modal tasc_modal">
    <div class="modal-content">

        <h4>{{$t->label}}. {{$project->label}}</h4>
        <form method="POST" action="{{route('user.edit_tasc')}}"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" id="tasc_id" name="tasc_id" value="{{$t->id}}">
                    <input type="text" id="label" name="label" value="{{$t->label}}" {{$disabled}}>
                    <label for="label">Название</label>
                </div>

                <div class="input-field col s6 mb-3">
                    <select name="status" id="status">
                        @foreach($stats as $s)
                            @php
                                $selected = ($s->id == $t->statuses->id) ? "selected" : "";
                            @endphp
                            <option value="{{$s->id}}" {{$selected}}>{{$s->status}}</option>
                        @endforeach
                    </select>
                    <label>Статус</label>
                </div>

                <div class="input-field textarea_field col s12">
                    <textarea id="description" name="description" rows="7" cols="5" {{$disabled}}>{{$t->description}}</textarea>
                    <label for="description">Описание</label>
                </div>

                @if(count($t->tascFiles)>0)
                    @php
                        $files = $t->tascFiles;
                    @endphp
                    @include('content.part_tasc_files')
                @endif

                @if($disabled == "")
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
                @endif

                <div class=" col s4">
                    <input type="text" id="start_date" name="start_date" class="datepicker"
                           value="{{\Carbon\Carbon::parse($t->srart_time)->format('d.m.Y')}}"
                           {{$disabled}}>
                    <span class="helper-text" data-error="wrong" data-success="right"
                          >Старт</span>
                </div>
                <div class="col s1"> </div>
                <div class=" col s4">
                    <input type="text" id="finish_date" name="finish_date" class="datepicker"
                        {{$disabled}}
                        value="{{\Carbon\Carbon::parse($t->finish_time)->format('d.m.Y')}}">
                    <span class="helper-text" data-error="wrong" data-success="right">Финиш</span>
                </div>


            </div>
            <button type="submit" class="modal-close btn waves-effect waves-light">Обновить</button>
        </form>
    </div>
    <div class="modal-footer">

    </div>
</div>





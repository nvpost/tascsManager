<a class="add_board_btn modal-trigger" href="#add_board"><i class="material-icons">add</i></a>
<!-- Modal Structure -->


<div id="add_board" class="modal tasc_modal">
    <div class="modal-content">
        <h4>Добавить доску к {{$canban['name']}}</h4>
        <form method="POST" action="{{route('user.board_add')}}"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" id="project_id" name="canban_id" value="{{$canban['id']}}">
                    <input type="hidden" id="position" name="position" value="{{count($canban['boards'])+1}}">
                    <input type="text" id="name" name="name" class="validate">
                    <label for="name">Название</label>
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






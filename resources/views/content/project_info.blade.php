


<div id="remove_project_info" class="modal tasc_modal">
    <div class="modal-content">
        <h4></h4>
        <div class="project_info"></div>
        <div class="active_block_btns">
            @php

            @endphp
            <form method="POST" action="{{route('user.remove_project')}}">
                @csrf
                <input type="hidden" value="" id="project_id" name="project_id">
                <button type="submit" class="modal-close btn waves-effect waves-light red darken-1">Удалить</button>
                <button type="closeProjectInfoModal" class="modal-close btn waves-effect waves-light">Пока не надо</button>

            </form>
        </div>
    </div>

</div>


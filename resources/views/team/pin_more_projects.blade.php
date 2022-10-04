<div class="active_block_btns">
    <a class="waves-effect waves-light btn modal-trigger" href="#pin_project"><i class="material-icons left">done</i>Закрепить проект за командой</a>
</div>


<div id="pin_project" class="modal tasc_modal">
    <div class="modal-content">
        <h4>Привязатьпроект к команде</h4>
        @include('content.Projects_table', ['projects'=>$all_projects, 'addToteam'=>true])
    </div>

</div>


<script>
    function addCloseEvent(){
        var modal = document.querySelector('#pin_project')
        var instance = M.Modal.getInstance(modal)
        instance.options.onCloseEnd = () => {
            window.location.reload()
        }
    }

    setTimeout(addCloseEvent, 300)

</script>

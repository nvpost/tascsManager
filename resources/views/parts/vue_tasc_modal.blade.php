


<div id="tasc_modal" class="modal tasc_modal">
    <div class="modal-content">

        <h4 v-text="tasc_label"></h4>
        <form method="POST" action="{{route('user.edit_tasc')}}"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" id="tasc_id" name="tasc_id" :value="tasc_id">
                    <input type="text" id="label" name="label" class="validate" v-model="tasc_label"
                           :disabled="tasc_disabled">
                    <label for="label">Название</label>
                </div>

                <div class="input-field col s6 mb-3">
                    <p v-text="tasc_status"></p>

                    <select name="status" id="status" >
                        <option v-for="(s, s_idx) in stats"
                                :value="s.id"
                                v-text="s.status"
                                :selected="tasc_status == s.id ? 'selected': false"
                        ></option>
                    </select>
                    <label>Статус</label>
                </div>


                <div class="tasc_files col s12" v-if="tasc_files.length>0">
                    <p><strong>Список файлов</strong></p>
                    <ul class="collection">
                        <li class="collection-item" v-for="(f, index) in tasc_files" :data-file="f.id">
                            <a :href="f.link" v-text="f.link.split('/').pop()">

                            </a>

                                <span class="active_bar" v-if="!tasc_disabled">
                                    <span class="active_icons material-icons" @click="del_file(f.id)">
                                    delete_outline
                                    </span>
                                </span>
                </div>

                <div class="input-field textarea_field col s12">
                    <textarea id="description" name="description" rows="7" cols="5" v-model="tasc_description"
                              :disabled="tasc_disabled"></textarea>
                    <label for="description">Описание</label>
                </div>

            </div>
            <button type="submit" class="modal-close btn waves-effect waves-light">Обновить</button>
        </form>
    </div>
    <div class="modal-footer">

    </div>
</div>





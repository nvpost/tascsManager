<div class="row">
    <div class="col s9">
        <select name="project" id="project" onchange="goToProject(event)">
            <option value="all">Выбрать проект</option>
            @foreach($projects as $project_item)
                @php
                    $selected = ($project_item->id == $id) ? 'selected' : '';
                @endphp

                <option value="{{$project_item->id}}" {{$selected}}>{{$project_item->label}}</option>
            @endforeach
        </select>
    </div>
    <div class="col s3">
        @if($id)
            @include('content.tasc_add_modal')
        @endif
    </div>
</div>

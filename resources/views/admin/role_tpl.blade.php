<label>
    @php
        $checked="";
        if(in_array($role->id, $user_roles)){
            $checked='checked';
        }
    @endphp
    <input type="checkbox" class="filled-in"
           name="role_{{$role->id}}"
           data_user="{{$user->id}}"
           data_role="{{$role->id}}"
            onclick="editRole({{$role->id}}, {{$user->id}})"
           {{$checked}}
    />
    <span>{{$role->name}}</span>
</label>

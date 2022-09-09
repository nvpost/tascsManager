@extends('layout')

@section('main_content')
<h1>Роли</h1>
<div class="row">

@foreach($roles as $role)
        <div class="chip">
            {{$role->name}}
            <i class="material-icons edit_role_icon" onclick="editRole('{{$role->name}}', '{{$role->id}}')">edit</i>
            <i class="close material-icons edit_role_icon" onclick="delRole('{{$role->name}}', '{{$role->id}}')">delete_forever</i>
        </div>
@endforeach

</div>

<div class="row">
    <div class="col s6">
        <form action="{{route('admin.add_role')}}" method="POST">
            @csrf
            <div class="row">
                <div class="input-field col s6">
                     <input type="text" name="name" id="name" placeholder="role">
                </div>

            </div>
            <button type="submit" class="waves-effect waves-light btn"><i class="material-icons left">add</i>Добавить роль</button>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>

    let headers={
        "X-CSRF-Token":"{{csrf_token()}}",
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    }
    function editRole(role, id){
        let value = prompt("Переназвать", role)
        fetch("{{route('admin.edit_role')}}", {
            method: "POST",
            headers:headers,
            body: JSON.stringify({id, value})
        }).then(res=>res.json())
            .then(data=>{
                window.location.reload()
            })
    }

    function delRole(role, id){
        if(confirm('Точно удалить '+role)){
            fetch("{{route('admin.delete_role')}}", {
                method: "POST",
                headers:headers,
                body: JSON.stringify({id})
            }).then(res=>res.json())
                .then(data=>{
                    console.log(data)
                })
        }
    }
</script>
@endsection

@extends('layout')

@section('main_content')
<h1>Пользователи</h1>


    <div class="users">
        <ul class="collection">
        @foreach($user_and_roles as $user)
            @php
                $user_roles=[];
                if(count($user->user_admin_roles)>0){
                    $user_roles = array_column($user->user_admin_roles->toArray(), 'role_id');
                }

            @endphp

            <li class="collection-item avatar">
                <img src="{{url('assets/imgs/user.jpg')}}" alt="" class="circle">
                <a href="/user/{{$user->id}}">
                    <span class="title">{{$user->name}} ({{$user->email}})</span>
                </a>
                <p>
                    {{$user->created_at}}
                </p>
                @foreach($roles as $role)
                    @include('admin.role_tpl')
                @endforeach


                <a href="#" class="secondary-content"><i class="material-icons">grade</i></a>
            </li>

        @endforeach
        </ul>
    </div>
@endsection

<script>
    function editRole(role_id, user_id){
        console.log(role_id, user_id)
        fetch("{{route('set_role')}}", {
            method: "POST",
            headers:{
                "X-CSRF-Token":"{{csrf_token()}}",
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({role_id, user_id})
        }).then(res=>res.json())
            .then(window.location.reload())
    }
    //.then(window.location.reload())
</script>

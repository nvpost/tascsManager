@extends('layout')

@section('main_content')
<h1>Вход</h1>

<form method="post" action="{{ route('user.login') }}">
    @csrf
<div class="row">
    <form class="col s12">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">alternate_email</i>
                <input id="email" name="email" type="text" class="validate">
                <label for="email">email</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">key</i>
                <input id="password" name="password" type="password">
                <label for="password">Пороль</label>
            </div>
        </div>
        <button type="submit" class="waves-effect waves-light btn">Войти</button>
    </form>
</div>
</form>


@endsection

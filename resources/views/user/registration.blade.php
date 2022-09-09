@extends('layout')

@section('main_content')
    <h1>Регистрация</h1>


    <div class="row">
        <form class="col s6" method="post" action="{{ route('user.registration') }}">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input id="name" name="name" type="text" class="validate">
                    <label for="name">Логин</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="email" name="email" type="email" class="validate">
                    <label for="email">Email</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="password" name="password" type="password" class="validate">
                    <label for="password">Пароль</label>
                </div>
            </div>

            <button type="submit" class="waves-effect waves-light btn">Зарегистрироваться</button>
        </form>
    </div>

@endsection

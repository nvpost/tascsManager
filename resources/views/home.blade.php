@extends('layout')
@section('title')
    Главная
@endsection
@section('main_content')
    <div class="alert alert-warning text-white" role="alert">
        <h2>Главная страница</h2>
        <p>Нужно <a href="/login">Войти</a> или <a href="/registration">зарегистрироваться</a>!</p>
    </div>
@endsection

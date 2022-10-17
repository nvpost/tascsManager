@extends('layout')
@section('title')
    Главная
@endsection
@section('main_content')
    @if(!Auth::user())
    <div class="text-white">
        <h2>Главная страница</h2>
        <p>Нужно <a href="/login">Войти</a> или <a href="/registration">зарегистрироваться</a>!</p>
    </div>
    @else
        <h2>Главная страница</h2>
        @include('home_page.projects')
    @endif
@endsection

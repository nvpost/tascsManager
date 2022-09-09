@extends('layout')
@section('title')
    Все проекты
@endsection
@section('main_content')
<h1>Мои проекты</h1>

@include('content.Projects_table', ['projects'=>$projects, 'addToteam' => false])



<a class="waves-effect waves-light btn" href="{{ route('user.projects_add') }}"><i class="material-icons left">add</i>Добавить проект</a>
@endsection




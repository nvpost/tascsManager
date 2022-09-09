@extends('layout')

@section('main_content')

    <h1>Моя команда</h1>
    @if($teams)
        @include('team.teams_table')
    @else
        <p>У вас еще нет команды и в этом нет ничего плохого, вам доступен весь функционал:
        <ul>
            <li>Создание проектов;</li>
            <li>Создание задач для проектов;</li>
            <li>Управление задачами с помощтю матрицы и канбан;</li>
        </ul>
        </p>

        <p>
            Если вы хотите разделить задичи с командой, то содать её можно в любой момент
        </p>
    @endif

<div class="active_block_btns">
    @include('team.add_team_modal')
{{--    @include('team.add_member_modal')--}}
</div>
@endsection


@section('scripts')

@endsection

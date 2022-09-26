@extends('layout')

@php
$sd = \Carbon\Carbon::parse($project->start_date)->translatedFormat('j F, Y');
$fd = \Carbon\Carbon::parse($project->finish_date)->translatedFormat('j F, Y');
$ct = \Carbon\Carbon::parse($project->created_at)->translatedFormat('j F, Y');


@endphp

@section('main_content')
    <div class="lr_header">
    <h1>Проект. {{$project->label}}</h1><span> (от {{$ct}})</span>
    </div>
    <div class="row">
        <div class="description">
            {{$project->description}}
        </div>
        <div class="meta">
            <p>Старт: {{$sd}}</p>
            <p>Финиш: {{$fd}}</p>
        </div>
    </div>

    <h2>Задачи</h2>
    @include('content.project_tascs')
    @include('content.tasc_add_modal')

@endsection


<script>



    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker')
        var instances = M.Datepicker.init(elems, {
            firstDay: true,
            format: 'dd.mm.yyyy',
            setDefaultDate: true,
            autoClose: true,
            i18n: {
                months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
                monthsShort: ["Янв", "Фев", "Март", "Апр", "Май", "Июнь", "Июль", "Авг", "Сент", "Окт", "Ноябрь", "Дек"],
                weekdays: ["Воскресенье","Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
                weekdaysShort: ["Вс","Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                weekdaysAbbrev: ["В","П", "В", "С", "Ч", "П", "С"]
            }
        })
    });


</script>

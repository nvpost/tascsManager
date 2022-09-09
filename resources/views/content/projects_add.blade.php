@extends('layout')
@section('title')
    Добавить проект
@endsection
@section('main_content')

<h1>Добавить проект</h1>


<form action="{{ route('user.projects_save') }}" method="post" >
    @csrf


    <div class="input-field">
        <input type="text" id="label" name="label" class="validate">
        <label for="label">Название</label>
    </div>

    <div class="input-field textarea_field">
        <textarea id="description" name="description" rows="10" cols="10"></textarea>
        <label for="description">Описание</label>
    </div>
    <div class="row">
     <div class=" col s2">
        <input type="text" id="start_date" name="start_date" class="datepicker">
        <span class="helper-text" data-error="wrong" data-success="right">Старт</span>
     </div>
        <div class="col s1"> </div>
        <div class=" col s2">
        <input type="text" id="finish_date" name="finish_date" class="datepicker">
            <span class="helper-text" data-error="wrong" data-success="right">Финиш</span>
        </div>
    </div>
    <div class="row">
        <div class=" col s12">
            <h5>Добавить команду</h5>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Отправить</button>

</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker')
        var instances = M.Datepicker.init(elems, {
            firstDay: true,
            format: 'dd.mm.yyyy',
            defaultDate: new Date(),
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

@endsection

<style>
    textarea{
        height: auto;
    }
    </style>



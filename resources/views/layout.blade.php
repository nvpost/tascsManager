<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <link rel="stylesheet" type="text/css" href="{{ url('assets/style.css') }}">


</head>
<body>

    <nav class="purple darken-2">
        <div class="nav-wrapper">
            <a href="/" class="brand-logo">Задачник</a>
{{--            @if(Gate::any('isSuperAdmin','isAdmin'))--}}
{{--                <a title="Все пользователи" class="near_logo_nav_item" href="{{ route('admin.users') }}"><span class="material-icons">groups</span></a>--}}
{{--                <a title="Роли" class="near_logo_nav_item" href="{{ route('admin.roles') }}"><span  class="material-icons">badge</span></a>--}}
{{--            @endif--}}



            <ul id="nav-user" class="right right_nav_panel">
            @if(Auth::user())
                    <li class="hide-on-med-and-down"><a title="Моя команда" href="{{ route('user.teams') }}"><span class="material-icons">diversity_3</span></a></li>
                    <li class="hide-on-med-and-down"><a href="{{ route('user.projects') }}"><span class="material-icons">folder</span></a></li>
{{--                    <li><a href="{{ route('tascs') }}"><span class="material-icons">task</span></a></li>--}}
                    <li class="hide-on-med-and-down"><a href="{{ route('user.matrix') }}"><span class="material-icons">grid_view</span></a></li>
                    <li class="hide-on-med-and-down"><a href="{{ route('user.canban') }}"><span class="material-icons">dashboard_customize</span></a></li>

                    <li><a class='dropdown-trigger btn green darken-1' href='#' data-target='userInfo'>{{Auth::user()->name}}</a>
                        <ul id='userInfo' class='dropdown-content'>
                            <li><a href="{{ route('user.user_info') }}">Обо мне</a></li>

                            <li class="divider" tabindex="-1"></li>
                            <li><a href="{{ route('user.projects') }}">Проекты</a></li>
                            <li><a href="{{ route('user.matrix') }}">Матрица</a></li>
                            <li><a href="{{ route('user.matrix') }}">Канбан</a></li>
                            <li><a href="{{ route('user.teams') }}">Команды</a></li>
                            <li class="divider" tabindex="-1"></li>

                            @if(Gate::any(['isSuperAdmin','isAdmin']))
                                <li><a href="{{ route('admin.users') }}">Люди</a></li>
                                <li><a href="{{ route('admin.roles') }}">Роли</a></li>
                                <li class="divider" tabindex="-1"></li>
                            @endif

                            <li><a href="{{ route('user.logout') }}">Выйти</a></li>
                        </ul>

                    </li>



            @else
                    <li><a href="/login">Войти</a></li>
                    <li><a href="/registration">Регистрация</a></li>
            @endif
            </ul>
        </div>
    </nav>


<div class="container">
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="error card-panel pink lighten-5">{{ $error }}</div>
        @endforeach
    @endif
    @yield('main_content')
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
        });
    </script>

    @yield('scripts')
</body>


</html>

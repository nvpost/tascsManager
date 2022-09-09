@extends('layout')

@section('title')
    reviews
@endsection

@section('main_content')
    <h1>Форма добавления отзыва</h1>
    @if($errors->any())

            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{$error}}
                </div>
            @endforeach

    @endif
    <form action="/review/check" method="post" >
        @csrf
        <input type="email" name="email" id="email" placeholder="email" class="form-control"><br>
        <input type="text" name="subject" id="subject" placeholder="Заголовок" class="form-control"><br>
        <textarea name="mess" id="mess" cols="30" rows="10" class="form-control"></textarea><br>
        <button type="submit" class="btn btn-success">Отправить</button>

    </form>

    <h2>Все отзывы</h2>
    @foreach($reviews as $item)
        <div class="alert alert-warning">
            <h3>{{ $item->subject }}</h3>
            <span> {{ $item->email }} / {{ $item->created_at }}</span>
            <p>
                {{ $item->mess }}
            </p>
        </div>
    @endforeach
@endsection

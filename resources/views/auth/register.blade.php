@extends('layouts.layout')

@section('content')
    <div class="auth">
        @if ($errors->any() || Session::get('error'))
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
            @if ($message = Session::get('error'))
            <li>{{$message}}</li>
            @endif
        </ul>
        @endif
        <h2>Регистрация</h2>
        <form action="register" method="post">
            @csrf
            <div class="register__username">
                <label for="username">Никнейм</label>
                <input type="text" name="username" class='@if($errors->has('username')) has-error @endif' id="username" value="{{old('username')}}">
            </div>
            <div class="register__email">
                <label for="email">Почта</label>
                <input type="text" name="email" class='@if($errors->has('email')) has-error @endif' id="email" value="{{old('email')}}">
            </div>
            <div class="register__password">
                <label for="password">Пароль</label>
                <input type="password" name="password" class="@if($errors->has('password')) has-error @endif" id="password">
            </div>
            <div class="register__remember">
                <label for="remember">Запомнить меня</label>
                <input type="checkbox" name="remember" id="remember" value="remember">
            </div>
            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>
@endsection
@extends('layouts.layout')

@section('title')
    @parent{{$title}}
@endsection

@section('content')
    <div class="auth">
        {{printAll($errors)}}
        <h2 class='reg_and_auth-title'>Авторизация</h2>
        <form action="auth" class="auth reg_auth" method="post">
            @csrf
            <div class="auth__email input-div">
                <label for="email">Почта</label>
                <input type="text" class="@if($errors->has('email')) has-error @endif" name="email" id="email" value="{{old('email')}}">
            </div>
            <div class="auth__password input-div">
                <label for="password">Пароль</label>
                <input type="password" class="@if($errors->has('password')) has-error @endif" name="password" id="password">
            </div>
            <div class="auth__remember input-div">
                <label for="remember">Запомнить меня</label>
                <input type="checkbox" name="remember" id="remember" value="1">
            </div>
            <button type="submit">Войти</button>
        </form>
    </div>
@endsection
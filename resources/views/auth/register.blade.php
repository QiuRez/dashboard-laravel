@extends('layouts.layout')

@section('tilte')
    @parent{{ $title }}
@endsection

@section('content')
    <div class="auth">
        {{printAllErrors($errors)}}
        <h2 class="reg_and_auth-title">Регистрация</h2>
        <form action="register" class="register reg_auth" enctype="multipart/form-data" method="post">
            @csrf
            <div class="register__username input-div">
                <label for="username">Никнейм</label>
                <input type="text" name="username" class='@if ($errors->has('username')) has-error @endif'
                    id="username" value="{{ old('username') }}">
            </div>
            <div class="register__email input-div">
                <label for="email">Почта</label>
                <input type="text" name="email" class='@if ($errors->has('email')) has-error @endif'
                    id="email" value="{{ old('email') }}">
            </div>
            <div class="register__password input-div">
                <label for="password">Пароль</label>
                <input type="password" name="password" class="@if ($errors->has('password')) has-error @endif"
                    id="password">
            </div>
            <div class="image-input">
                <p>Фото профиля</p>
                <input type="file" id="image" name="image" class="image">
                <label for="image">Выбрать фото</label>
            </div>
            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>
@endsection

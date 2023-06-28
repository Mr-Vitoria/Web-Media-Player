@extends('layouts.default')

@section('cssPages')
<link href="/css/profile.css" rel="stylesheet" />
<title>Registrate</title>
@endsection

@section('content')
    <section class="loginSection">

        <h2>Регистрация</h2>
        <form method="POST" action="/registrate">   
            @csrf

            <label for="userLogin">Логин:</label>
            <input type="text" id="userLogin" name="login" required />

            <label for="userEmail">Почта:</label>
            <input type="email" id="userEmail" name="email" required />

            <label for="userPassword">Пароль:</label>
            <input type="password" id="userPassword" name="password" required />

            <button type="submit">Зарегистрироваться</button>
            <div class="helpBlock">
                <span>Уже есть наш аккаунт? <a href="/login">Войти в аккаунт</a></span>
            </div>
        </form>
    </section>
@stop
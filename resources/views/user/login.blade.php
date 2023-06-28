@extends('layouts.default')

@section('cssPages')
<link href="/css/profile.css" rel="stylesheet" />
<title>Login</title>
@endsection

@section('content')
    <section class="loginSection">

        <h2>Вход</h2>
        <form method="POST" action="/login">   
            @csrf
            <label for="userEmail">Почта:</label>
            <input type="email" id="userEmail" name="email" required />

            <label for="userPassword">Пароль:</label>
            <input type="password" id="userPassword" name="password" required />

            <button type="submit">Войти</button>
            <div class="helpBlock">
                <span>Впервые здесь? <a href="/login">Зерегистрируйтесь</a></span>
            </div>
        </form>
    </section>
@stop
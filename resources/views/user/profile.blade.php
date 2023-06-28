@extends('layouts.default')

@section('cssPages')
<link href="/css/profile.css" rel="stylesheet" />
<title>Profile</title>
@endsection

@section('content')
<div class="modal fade" id="changeProfileModal" tabIndex="-1" aria-labelledby="changeProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="changeUserImage" enctype="multipart/form-data">
                @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="changeProfileModalLabel">{{$user->login}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <h2>Изменить профиль:</h2>
                <p>Изображение</p>
                <input type="file" name="image" />
            </div>
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal">Закрыть</button>
                <button type="submit">Изменить</button>
            </div>
            </form>
        </div>
    </div>
</div>

<section class="profileSection">
<h2>Профиль</h2>
<div class="imgContainer">
    <img src="{{Storage::url($user->imagepath) }}" />
</div>

<label>Логин</label>
<p>{{$user->login}}</p>
<label>Почта</label>
<p>{{$user->email}}</p>

    <button data-bs-toggle="modal" data-bs-target="#changeProfileModal">Изменить профиль</button>
<a href="signOut">Выйти</a>
</section>
@stop
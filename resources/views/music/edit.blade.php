@extends('layouts.default')


@section('cssPages')
<link href="/css/add.css" rel="stylesheet" />
<title>Edit music</title>
@endsection

@section('content')
<form action="/editMusic" method="post" class="form-group" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$music->id}}">
    <div class="mb-3">
      <label for="InputName" class="form-label">Название:</label>
      <input type="text" class="form-control" id="InputName" name="name" value="{{$music->name}}" aria-describedby="nameHelp">
      <div id="nameHelp" class="form-text">Введите название песни</div>
    </div>

    <div class="mb-3">
      <input name="r1" type="radio" checked value="text" id="textRadio"><label for="textRadio"> Считывать с
        клавиатуры</label>
      <input name="r1" type="radio" value="file" id="fileRadio"> <label for="fileRadio">Считывать с файла</label>
    </div>
    <div class="mb-3" id="InputTextDiv">
      <label for="InputText" class="form-label">Текст песни:</label>
      <textarea class="form-control" id="InputText" name="text" aria-describedby="textHelp">{{$music->text}}</textarea>
    </div>
    <div class="mb-3" id="InputFileDiv" style="display: none">
      <label for="textFile" class="form-label">Выберите файл с текстом песни</label>
      <input class="form-control" type="file" id="textFile" name="textFile">
    </div>
    <div class="mb-3">
      <label for="InputAuthor" class="form-label">Автор:</label>
      <input type="text" class="form-control" name="author" id="InputAuthor" value="{{$music->author}}" aria-describedby="AuthorHelp">
      <div id="AuthorHelp" class="form-text">Введите автора песни</div>
    </div>
    <div class="mb-3">
      <label for="InputYear" class="form-label">Год выхода:</label>
      <input type="number" class="form-control" name="year" id="InputYear" value="{{$music->year}}" aria-describedby="yearHelp">
      <div id="yearHelp" class="form-text">Введите год выхода</div>
    </div>
    <div class="mb-3">
      <label for="InputImage" class="form-label">Изображение:</label>
      <input type="file" class="form-control" name="imageFile" id="InputImage" value="{{$music->imagepath}}" aria-describedby="ImageHelp">
      <div id="ImageHelp" class="form-text">Введите url изображения</div>
    </div>
    <div class="mb-3">
      <label for="InputMusic" class="form-label">Песня:</label>
      <input type="file" class="form-control" name="musicFile" id="InputMusic" value="{{$music->musicpath}}" aria-describedby="MusicHelp">
      <div id="MusicHelp" class="form-text">Выберите файл с песней</div>
    </div>
    <div class="form-group">
      <input id="submitBtn" name="saveBtn" type="submit" class="btn btn-secondary btn-purple" value="Сохранить" />
      <a class="btn btn-secondary btn-purple" href="/">Отменить</a>
    </div>
  </form>

@stop


@section('jsPages')


<script src="/js/update.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({ selector: 'textarea' });</script>
@endsection
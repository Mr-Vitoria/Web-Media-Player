@extends('layouts.default')


@section('cssPages')
<link href="/css/add.css" rel="stylesheet" />
<title>Add music</title>
@endsection

@section('content')

<form action="/addMusic" method="post" class="form-group" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="InputName" class="form-label">Название:</label>
      <input type="text" class="form-control" id="InputName" name="name" aria-describedby="nameHelp">
      <div id="nameHelp" class="form-text">Введите название песни</div>
    </div>

    <div class="mb-3">
      <input name="r1" type="radio" checked value="text" id="textRadio"><label for="textRadio"> Считывать с
        клавиатуры</label>
      <input name="r1" type="radio" value="file" id="fileRadio"> <label for="fileRadio">Считывать с файла</label>
    </div>
    <div class="mb-3" id="InputTextDiv">
      <label for="InputText" class="form-label">Текст песни:</label>
      <textarea class="form-control" id="InputText" name="text" aria-describedby="textHelp"></textarea>
    </div>
    <div class="mb-3" id="InputFileDiv" style="display: none">
      <label for="textFile" class="form-label">Выберите файл с текстом песни</label>
      <input class="form-control" type="file" id="textFile" name="textFile">
    </div>
    <div class="mb-3">
      <label for="InputAuthor" class="form-label">Автор:</label>
      <input type="text" class="form-control" name="author" id="InputAuthor" aria-describedby="AuthorHelp">
      <div id="AuthorHelp" class="form-text">Введите автора песни</div>
    </div>
    <div class="mb-3">
      <label for="InputYear" class="form-label">Год выхода:</label>
      <input type="number" class="form-control" name="year" id="InputYear" aria-describedby="yearHelp">
      <div id="yearHelp" class="form-text">Введите год выхода</div>
    </div>
    <div class="mb-3">
      <label for="InputImage" class="form-label">Изображение:</label>
      <input type="file" class="form-control" required name="imageFile" id="InputImage" aria-describedby="ImageHelp">
      <div id="ImageHelp" class="form-text">Выберите файл с изображением</div>
    </div>
    <div class="mb-3">
      <label for="InputMusic" class="form-label">Песня:</label>
      <input type="file" class="form-control" required name="musicFile" id="InputMusic" aria-describedby="MusicHelp">
      <div id="MusicHelp" class="form-text">Выберите файл с песней</div>
    </div>
    <div class="form-group">
      <input id="submitBtn" name="saveBtn" type="submit" class="btn btn-secondary btn-purple" value="Добавить" />
      <a class="btn btn-secondary btn-purple" href="./index.php">Отменить</a>
    </div>
  </form>

@stop


@section('jsPages')


<script src="/js/update.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({ selector: 'textarea' });</script>
@endsection
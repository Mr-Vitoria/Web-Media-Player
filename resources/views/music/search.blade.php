@extends('layouts.default')
@section('content')

<div class="zone">
@if (count($musicByName)==0&&count($musicByAuthor)==0&&count($musicByText)==0)
    <h1>Совпадений не найдено(</h1>

    @else
    
    @if (count($musicByName)>0)
    <h1 class="headerH">Найдено совпадение в названии: <span>{{$searchText}}</span></h1>
    <div class="musics">

        @foreach ($musicByName as $music)
            
           @include('includes.musicCard',['music'=>$music])
        @endforeach
    </div>
    @endif

    @if (count($musicByAuthor)>0)
    <h1 class="headerH">Найдено совпадение в авторе: <span>{{$searchText}}</span></h1>
    <div class="musics">

        @foreach ($musicByAuthor as $music)
            
           @include('includes.musicCard',['music'=>$music])
        @endforeach
    </div>
    @endif

    @if (count($musicByText)>0)
    <h1 class="headerH">Найдено совпадение в тексте: <span>{{$searchText}}</span></h1>
    <div class="musics">
          
        @foreach ($musicByText as $music)
            
           @include('includes.musicCard',['music'=>$music])
        @endforeach
            
        </div>
    </div>
    @endif
    @endif



</div>
@stop
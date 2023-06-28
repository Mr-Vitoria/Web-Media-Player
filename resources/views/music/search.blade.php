@extends('layouts.default')
@section('content')

<div class="zone">
    @if ($musicByName->count()==0&&$musicByAuthor->count()==0&&$musicByText->count()==0)
        <h1>Совпадений не найдено(</h1>

    @else
    
        @if ($musicByName->count()>0)
            <h1 class="headerH">Найдено совпадение в названии: <span>{{$searchText}}</span></h1>
            <div class="musics">

                @foreach ($musicByName as $music)
                    
                @include('includes.musicCard',['music'=>$music])
                @endforeach
            </div>
        @endif

        @if ($musicByAuthor->count()>0)
            <h1 class="headerH">Найдено совпадение в авторе: <span>{{$searchText}}</span></h1>
            <div class="musics">

                @foreach ($musicByAuthor as $music)
                    
                @include('includes.musicCard',['music'=>$music])
                @endforeach
            </div>
        @endif

        @if ($musicByText->count()>0)
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
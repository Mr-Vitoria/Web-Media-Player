@extends('layouts.default')
@section('content')
<div class="zone">
    <h1 class="headerH">Все композиции:</h1>
    <div class="musics">
        @forelse ($musics as $music)
           @include('includes.musicCard',['music'=>$music])
        @empty
            <p>Ни одной композиции не загружено</p>
        @endforelse
    </div>
</div>
@stop
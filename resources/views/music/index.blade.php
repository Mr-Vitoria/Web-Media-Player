@extends('layouts.default')
@section('content')
<div class="zone">
    <h1 class="headerH">All music:</h1>
    <div class="musics">
        @forelse ($musics as $music)
           @include('includes.musicCard',['music'=>$music])
@empty
<p>No musics</p>
@endforelse
    </div>

</div>
@stop
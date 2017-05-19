@extends('layouts.layout')
@section('content')
    <div class="row cyan lighten-5">
        <form class="col s8 offset-s2" method="post" action="/search">
            {{csrf_field()}}
            <div class="row">
                <div class="input-field col s12">
                    <input  id="first_name" type="text" name="search" class="validate">
                    <label for="first_name">{{ isset($search) ? $search : 'Song' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s4">
                    <label for="">Results Quantity</label>
                </div>
                <div class="input-field col s8">
                    <input  id="quantity" type="range" min="1" max="50" value="10" name="quantity" class="validate">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="submit" class="waves-effect waves-light btn light-blue lighten-3" value="Search">
                </div>
            </div>
        </form>
    </div>
@endsection
@section('subContent')
    @if(isset($videos))
        <div class="row ">
            @foreach($videos as $video)
                <div class="card  col s4">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="{{$video->thumbnails['high']['url']}}">
                        <span class="card-title">{{$video->tittle}}</span>
                    </div>
                    <div class="card-content">

                        <span class="card-title activator grey-text text-darken-4">More Details<i class="material-icons right">more_vert</i></span>
                        <p><a href="{{$video->link}}" target="_blank">Watch the video on youtube</a></p>
                    </div>
                    <div class="card-reveal">
                        <h4 class="card-title grey-text text-darken-4">{{$video->tittle}}<i class="material-icons right">close</i></h4>
                        <div class="video-container">
                            <iframe width="853" height="480" src="//www.youtube.com/embed/Q8TXgCzxEnw?rel=0" frameborder="0" allowfullscreen></iframe>
                            <iframe src="{{$video->iframe}}" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
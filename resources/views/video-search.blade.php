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
    <div class="row ">
        <div class="col s6">
            @if(isset($videos))
                @include('partial.video-partial')
            @endif
        </div>
        <div class="col s6">
            @if(isset($songs))
                @include('partial.song-partial')
            @endif
        </div>
    </div>
@endsection
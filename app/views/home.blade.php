@extends('master')
@section('content')
@if (Auth::guest())
    <h1>Please log in to see the future!</h1>
@else
    <h1>Hi <b>{{Auth::user()->username}}</b>, welcome to... uh... something done by <a href="https://osu.ppy.sh/u/Marcin">me</a>. Hope its helpful.</h1>
    @if (Auth::user()->isAdmin()) <h3>Hi my lord</h3> @endif
@endif

@stop
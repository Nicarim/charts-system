@extends('master')
@section('content')
@if
(Auth::guest())<h1>Please log in to see the future!</h1>
@else
@if (Auth::user()->isAdmin()) <h1>Hi my lord</h1> @endif
@endif

@stop
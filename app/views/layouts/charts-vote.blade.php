@extends('layouts.master')

@section('content')

<h1>{{ucfirst($chart->type)}} Chart: {{$chart->name}} - {{$nameshelper[$mode]}}</h1>
@if (Auth::user()->allowedMode($mode))
<h3 style="color:darkgreen">You have x Votes remaining</h3>
@else
<h3 style="color:darkred">You are not allowed to vote in this mode</h3>
@endif

<div class="btn-group btn-group-justified">
    @if ($mode == "osu")
    <a class="btn btn-warning active">osu!</a>
    @else
    <a class="btn btn-warning" onclick="window.location.href='/charts/view/{{$chart->id}}/osu'" >osu!</a>
    @endif
    @if ($mode == "taiko")
    <a class="btn btn-warning active">Taiko</a>
    @else
    <a class="btn btn-warning" onclick="window.location.href='/charts/view/{{$chart->id}}/taiko'">Taiko</a>
    @endif
    @if ($mode == "ctb")
    <a class="btn btn-warning active">Catch the Beat</a>
    @else
    <a class="btn btn-warning" onclick="window.location.href='/charts/view/{{$chart->id}}/ctb'">Catch the Beat</a>
    @endif
    @if ($mode == "mania")
    <a class="btn btn-warning active">osu!mania</a>
    @else
    <a class="btn btn-warning" onclick="window.location.href='/charts/view/{{$chart->id}}/mania'">osu!mania</a>
    @endif
</div>
<table class="table table-hover">
    <tr>
        <th style="width:40px;">#</th>
        <th>Map Name (creator)</th>
        <th style="width:10px;"></th>
    </tr>

    @foreach($chart->ommaps as $key => $map)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$map->artist}} - {{$map->title}} ({{$map->creator}})</td>
            <td><button type="button" onclick="window.location.href='/charts/vote/{{$map->id}}/{{$chart->id}}/1'" class="btn btn-xs btn-default">Vote</button></td>
        </tr>
    @endforeach

</table>
@stop
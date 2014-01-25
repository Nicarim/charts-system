@extends('layouts.master')

@section('content')
<h1>{{ucfirst($chart->type)}} Chart: {{$chart->name}} - osu!</h1>
<div class="btn-group btn-group-justified">
    <a class="btn btn-warning">osu!</a>
    <a class="btn btn-warning">Taiko</a>
    <a class="btn btn-warning">Catch the Beat</a>
    <a class="btn btn-warning">osu!mania</a>
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
            <td><button type="button" class="btn btn-sm btn-default">Vote</button></td>
        </tr>
    @endforeach

</table>
@stop
@extends('master')

@section('content')
<div class="btn-group btn-group-justified">
    <a class="btn btn-default {{{ $mode == 'osu' ? 'active' : '' }}}" href='/charts/results/{{$id}}/osu' >osu!</a>
    <a class="btn btn-default {{{ $mode == 'taiko' ? 'active' : '' }}}" href='/charts/results/{{$id}}/taiko'>Taiko</a>
    <a class="btn btn-default {{{ $mode == 'ctb' ? 'active' : '' }}}" href='/charts/results/{{$id}}/ctb'>Catch the Beat</a>
    <a class="btn btn-default {{{ $mode == 'mania' ? 'active' : '' }}}" href='/charts/results/{{$id}}/mania'>osu!mania</a>
</div>
{{$beatmaps->count()}}
<table class="table table-hover">
    <tr>
        <th style="width:40px">#</th>
        <th>Beatmap</th>
        <th style="width:40px">Votes</th>
    </tr>
    @foreach ($beatmaps as $key => $map)
    <tr>
        <td>{{$key+1}}</td>
        <td>{{$map->artist}} - {{$map->title}} by {{$map->creator}}</td>
        <td>{{$map->votes()->where("gamemode",$mode)->count()}}</td>
    </tr>
    @endforeach
</table>
@stop
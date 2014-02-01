@extends('master')

@section('content')
<div class="btn-group btn-group-justified">
    <a class="btn btn-default {{{ $mode == '0' ? 'active' : '' }}}" href='/charts/results/{{$id}}/osu' >osu!</a>
    <a class="btn btn-default {{{ $mode == '1' ? 'active' : '' }}}" href='/charts/results/{{$id}}/taiko'>Taiko</a>
    <a class="btn btn-default {{{ $mode == '2' ? 'active' : '' }}}" href='/charts/results/{{$id}}/ctb'>Catch the Beat</a>
    <a class="btn btn-default {{{ $mode == '3' ? 'active' : '' }}}" href='/charts/results/{{$id}}/mania'>osu!mania</a>
</div>
<table class="table table-hover">
    <tr>
        <th style="width:40px">#</th>
        <th>Beatmap</th>
        <th style="width:40px">Votes</th>
    </tr>
    @foreach ($beatmaps as $key => $beatmap)
    <tr>
        <td>{{$key+1}}</td>
        <td>{{$beatmap->artist}} - {{$beatmap->title}} by {{$beatmap->creator}}</td>
        <td>{{$beatmap->votes->mode($mode)->vote_count}}</td>
    </tr>
    @endforeach
</table>
@stop
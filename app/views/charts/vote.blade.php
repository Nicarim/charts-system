@extends('master')

@section('content')

<h1>{{ucfirst($chart->type)}} Chart: {{$chart->name}} - {{$nameshelper[$mode]}}</h1>
@if (Auth::user()->allowedMode($mode))
<h3 style="color:darkgreen">You have <b>{{abs(count($votes)- 3)}}</b> votes remaining</h3>
@else
<h3 style="color:darkred">You are not allowed to vote in this mode</h3>
@endif

<div class="btn-group btn-group-justified">
    <a class="btn {{{Auth::user()->allowedMode('osu') ? 'btn-success' : 'btn-danger'}}} {{{ $mode == 'osu' ? 'active' : '' }}}" href='/charts/view/{{$chart->id}}/osu' >osu!</a>
    <a class="btn {{{Auth::user()->allowedMode('taiko') ? 'btn-success' : 'btn-danger'}}} {{{ $mode == 'taiko' ? 'active' : '' }}}" href='/charts/view/{{$chart->id}}/taiko'>Taiko</a>
    <a class="btn {{{Auth::user()->allowedMode('ctb') ? 'btn-success' : 'btn-danger'}}} {{{ $mode == 'ctb' ? 'active' : '' }}}" href='/charts/view/{{$chart->id}}/ctb'>Catch the Beat</a>
    <a class="btn {{{Auth::user()->allowedMode('mania') ? 'btn-success' : 'btn-danger'}}} {{{ $mode == 'mania' ? 'active' : '' }}}" href='/charts/view/{{$chart->id}}/mania'>osu!mania</a>
</div>
<table class="table table-hover">
    <tr>
        <th style="width:40px;">#</th>
        <th>Map Name (creator)</th>
        <th style="width:10px;"></th>
    </tr>
    @foreach($maps as $key => $map)
        <tr>
            <td>{{$key+1}}</td>
            <td><a href="https://osu.ppy.sh/s/{{$map->id}}" target="blank"> {{$map->artist}} - {{$map->title}} ({{$map->creator}})</a></td>
            <td>
                <b class="osu {{{ !$map->osumode ? 'off' : '' }}}"></b>
            </td>
            <td>
                <b class="taiko {{{ !$map->taikomode ? 'off' : '' }}}"></b>
            </td>
            <td>
                <b class="ctb {{{ !$map->ctbmode ? 'off' : '' }}}"></b>
            </td>
            <td>
                <b class="mania {{{ !$map->maniamode ? 'off' : '' }}}"></b>
            </td>
            <td>
                @if (Auth::user()->allowedMode($mode))
                <button type="button" onclick="window.location.href='/charts/vote/add/{{$map->id}}/{{$chart->id}}/{{$mode}}'" class="btn btn-xs btn-default">Vote</button>
                @endif
            </td>
        </tr>
    @endforeach

</table>
@stop
@extends('master')

@section('content')
@if (Auth::user()->isAdmin())
<form class="form-inline" method="post" action="/charts/add_beatmap/{{$chart->id}}">
    <div class="form-group">
        <input type="text" name="beatmapids" class="form-control" placeholder="Beatmapset Ids">
    </div>
    <input type="submit" class="btn btn-default" value="Add Beatmaps">

</form>
@endif
<h1>{{ucfirst($chart->type)}} Chart: {{$chart->name}} - {{$nameshelper[$mode]}}</h1>
@if (!$theend)
    <h2 class="text-center"><b>Deadline:</b> <time class="timeago" datetime="{{$chart->end_time}}"></time></h2>
@else
    <h2 class="text-center">Results: <a href="/charts/results/{{$chart->id}}">Click here for results!</a></h2>
@endif
@if (Auth::user()->allowedMode($mode))
    <h3 style="color:darkgreen">You have <b id="votes_available">{{abs(count($votes)- $chart->max_votes)}}</b> votes remaining</h3>
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
        <th>Map</th>
        <th style="width:10px;"></th>
    </tr>
    @foreach($maps as $key => $map)
        <tr>
            <td>{{$key+1}}</td>
            <td><a href="https://osu.ppy.sh/s/{{$map->beatmapset_id}}" target="blank"> {{$map->artist}} - {{$map->title}} by {{$map->creator}}</a></td>
            @if ($chart->user_id == Auth::user()->id || Auth::user()->isAdmin())
                <td><a href="/charts/remove_specific-beatmap/{{$map->id}}" class="btn btn-danger">Remove</a></td>
            @endif
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
                @if (Auth::user()->allowedMode($mode) && !$theend)
                    @if ((count($votes) - $chart->max_votes) != 0)
                        @if (!isset($votes[$map->id]))
                        <button type="button" onclick="VoteFunc(this,'add',{{$map->id}},{{$chart->id}},'{{$mode}}')" class="btn btn-xs btn-default vote">Vote</button>
                        @else
                        <button type="button" onclick="VoteFunc(this,'remove',{{$votes[$map->id]}})" class="btn btn-xs btn-default btn-danger unvote">Unvote</button>
                        @endif
                    @else
                        @if (isset($votes[$map->id]))
                            <button type="button" onclick="VoteFunc(this,'remove',{{$votes[$map->id]}})" class="btn btn-xs btn-default btn-danger unvote">Unvote</button>
                        @else
                            <button type="button" onclick="VoteFunc(this,'add',{{$map->id}},{{$chart->id}},'{{$mode}}')" class="btn btn-xs btn-default vote" disabled="disabled">Vote</button>
                        @endif
                    @endif
                @endif
            </td>
        </tr>
    @endforeach

</table>
@stop
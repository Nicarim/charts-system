@extends('master')
@section('content')
@if (Auth::user()->id == $chart->user->id)
<form class="form-inline" method="post" action="/charts/add_specificbeatmap/{{$chart->id}}">
    <div class="form-group">
        <input type="text" name="beatmapids" class="form-control" placeholder="Beatmap Ids">
    </div>
    <input type="submit" class="btn btn-default" value="Add Beatmaps">

</form>
@endif
<h1>{{ucfirst($chart->type)}} Chart: {{$chart->name}}</h1>
<table class="table table-hover">
    <tr>
        <th style="width:40px;">#</th>
        <th>Map</th>
        <th style="width:10px;"></th>
    </tr>
    @foreach($maps as $key => $map)
    <tr>
        <td>{{$key+1}}</td>
        <td><a href="https://osu.ppy.sh/s/{{$map->beatmapset_id}}" target="blank"> {{$map->artist}} - {{$map->title}} by {{$map->creator}} [{{$map->version}}]</a></td>
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
    </tr>
    @endforeach

</table>
@stop
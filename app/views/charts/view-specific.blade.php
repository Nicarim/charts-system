@extends('master')
@section('content')
@if ($chart->user_id == Auth::user()->id)
<form class="form-inline" method="post" action="/charts/add_specific-beatmap/{{$chart->id}}">
    <div class="form-group">
        <input type="text" name="beatmapids" class="form-control" placeholder="Beatmap Ids">
    </div>
    <div class="form-group">
        <label for="freemod">FreeMod</label>
        <input id="freemod" type="radio" name="mod" class="radio-inline" value="freemod"/>
        <label for="easy">Easy</label>
        <input id="easy" type="radio" name="mod" class="radio-inline" value="easy"/>
        <label for="halftime">HalfTime</label>
        <input id="halftime" type="radio" name="mod" class="radio-inline" value="halftime"/>
        <label for="hardrock">Hardrock</label>
        <input id="hardrock" type="radio" name="mod" class="radio-inline" value="hardrock"/>
        <label for="doubletime">DoubleTime</label>
        <input id="doubletime" type="radio" name="mod" class="radio-inline" value="doubletime"/>
        <label for="hidden">Hidden</label>
        <input id="hidden" type="radio" name="mod" class="radio-inline" value="hidden"/>
        <label for="flashlight">Flashlight</label>
        <input id="flashlight" type="radio" name="mod" class="radio-inline" value="flashlight"/>
    </div>
    <input type="submit" class="btn btn-default" value="Add Beatmaps">
</form>
@endif
<h1>{{ucfirst($chart->type)}} Chart: {{$chart->name}}</h1>
<table class="table table-hover">
    <tr>
        <th style="width:40px;">#</th>
        <th>Maps</th>
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
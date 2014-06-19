@extends('master')
@section('title')
<title>{{ucfirst($chart->type)}} Chart: {{$chart->name}}</title>
@stop
@section('content')
    @if ($chart->user_id == Auth::user()->id || Auth::user()->isAdmin())
        <div class="panel-group" id="accordin">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#chartmanager">
                            Chart Manager
                        </a>
                    </h4>
                </div>
                <div id="chartmanager" class="panel-collapse collapse">
                    <div class="panel-body">
                        <form role="form" method="post" action="/charts/add_specific-beatmap/{{$chart->id}}">
                            <div class="form-group">
                                <input type="text" name="beatmapids" class="form-control" placeholder="Beatmap Ids">
                                @if (Session::has('beatmaperror'))
                                    <span style="color: darkred;">{{Session::get('beatmaperror')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                @foreach(osuHelper::modsAvailable() as $key => $value)
                                    <label class="checkbox">
                                        <input type="checkbox" name="mod[{{strtolower($key)}}]" value="{{$value}}" {{$value == 8192 ? 'checked' : ''}}>{{$key}}
                                    </label>
                                @endforeach
                            </div>
                            <input type="submit" class="btn btn-default" value="Add Beatmaps">
                            <button type="button" onclick="window.location.href='/charts/delete/{{$chart->id}}'" class="btn btn-danger">Remove WHOLE chart (don't click it D:)?</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <h1>[{{osuHelper::gamemodeString($chart->gamemode_id)}}] {{ucfirst($chart->type)}} Chart: {{$chart->name}}<b class="{{osuHelper::statusIcon($chart->status)}}"></b></h1>
    <table class="table table-hover">
        <tr>
            <th>Maps</th>
            <th>Forced Mod</th>
            <th style="width:10px;"></th>
        </tr>
        @foreach($maps as $map)
            <tr>
                <td>
                    {{ $map->osumode ? '<b class="osu"></b>' : '' }}
                    {{ $map->taikomode ? '<b class="taiko"></b>' : '' }}
                    {{ $map->ctbmode ? '<b class="ctb"></b>' : '' }}
                    {{ $map->maniamode ? '<b class="mania"></b>' : '' }}
                    <a href="https://osu.ppy.sh/b/{{$map->beatmap_id}}" target="blank"> {{$map->artist}} - {{$map->title}} by {{$map->creator}} [{{$map->version}}]</a>
                </td>
                <td>{{osuHelper::modString($map->forcedmod)}}</td>
                @if ($chart->user_id == Auth::user()->id)
                    <td><a href="/charts/remove_specific-beatmap/{{$map->id}}" class="btn btn-danger">Remove</a></td>
                @endif

            </tr>
        @endforeach

    </table>
    @if(Auth::user()->team == "bat")
        <div class="btn-group">


        </div>
    @endif
    @include('charts/comments')
@stop
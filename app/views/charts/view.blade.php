@extends('master')

@section('content')
<div class="panel panel-success">
    <div class="panel-body">
        <div class="padding-filters">
            <span>Filters:</span>
            <a class="label label-success" href="{{URL::current().'?gamemode=0'}}">osu!</a>
            <a class="label label-success" href="{{URL::current().'?gamemode=1'}}">Taiko</a>
            <a class="label label-success" href="{{URL::current().'?gamemode=2'}}">Catch the Beat</a>
            <a class="label label-success" href="{{URL::current().'?gamemode=3'}}">osu!mania</a>
        </div>
        <div class="padding-filters">
            <a class="label label-primary" href="{{URL::current()}}">Clear Filters</a>
        </div>
    </div>
</div>
<table class="table table-hover">
    <tr>
        <th style="width:40px">#</th>
        <th>Chart name</th>
        <th>Creator</th>
		<th></th>
		<th>Type</th>
        <th>Status</th>
    </tr>
    @foreach ($charts as $key => $chart)
    <tr>
        <td>{{$key+1}}</td>
        <td>
            @if($chart->creation_type == "Voting")
            <b>{{ucfirst($chart->type)}} Chart - </b><a href="/charts/view/{{$chart->id}}">{{$chart->name}}</a>
            @elseif ($chart->creation_type == "Diff-specific")
            <b class="{{osuHelper::gamemodeCss($chart->gamemode_id)}}"></b> <b>{{ucfirst($chart->type)}} Chart - </b><a href="/charts/view-specific/{{$chart->id}}">{{$chart->name}}</a>
            @endif
        </td>
        <td>By <b>{{$chart->user->username}}</b></td>
		<td>
            @if (!Auth::guest())
			    @if (Auth::user()->isAdmin())
				    <button type="button" onclick="window.location.href='/charts/delete/{{$chart->id}}'" class="btn btn-danger">Remove?</button>
			    @endif
            @endif
		</td>
        <td>{{$chart->creation_type}}</td>
        <td>
            <span class="label {{osuHelper::statusCss($chart->status)}}"><b class="{{osuHelper::statusIcon($chart->status+1)}}"></b>{{osuHelper::statusString($chart->status)}}</span>
        </td>
    </tr>
    @endforeach
</table>
@stop
@section('title')
<title>View charts</title>
@stop
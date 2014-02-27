@extends('master')

@section('content')
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
            [{{osuHelper::gamemodeString($chart->gamemode_id)}}] <b>{{ucfirst($chart->type)}} Chart - </b><a href="/charts/view-specific/{{$chart->id}}">{{$chart->name}}</a>
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
            {{osuHelper::statusString($chart->status)}}
        </td>
    </tr>
    @endforeach
</table>
@stop
@section('title')
<title>View charts</title>
@stop
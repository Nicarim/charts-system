@extends('master')

@section('content')
<table class="table table-hover">
    <tr>
        <th style="width:40px">#</th>
        <th>Chart name</th>
		<th></th>
        <th style="width:40px">Votes</th>
    </tr>
    @foreach ($charts as $key => $chart)
    <tr>
        <td>{{$key+1}}</td>
        <td><a href="">{{ucfirst($chart->type)}} Chart - {{$chart->name}}</a></td>
		<td>
			@if (Auth::user()->isAdmin())
				<button type="button" onclick="window.location.href='/charts/delete/{{$chart->id}}'" class="btn btn-danger">Remove?</button> 
			@endif
		</td>
        <td>{{$chart->votes->count()}}</td>
    </tr>
    @endforeach
</table>
@stop
@section('title')
<title>View charts</title>
@stop
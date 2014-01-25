@extends('layouts.master')

@section('content')
<table class="table table-hover">
    <tr>
        <th style="width:40px">#</th>
        <th>Chart name</th>
        <th style="width:40px">Votes</th>
    </tr>
    @foreach ($charts as $key => $chart)
    <tr>
        <td>{{$key+1}}</td>
        <td>{{ucfirst($chart->type)}} Chart - {{$chart->name}}</td>
        <td>{{$chart->votes->count()}}</td>
    </tr>
    @endforeach
</table>
@stop
@section('title')
<title>View charts</title>
@stop
@extends('master')
@section('content')
@if ($banned==false)
<button type="button" onclick="window.location.href='/users/banned'" >Show deleted users?</button>
@endif
<table class="table table-hover">
    <tr>
        <th style="width:40px">#</th>
        <th style="width:40%">Username</th>
		<th></th>
        <th>Team</th>
        <th>Last Active</th>
        <th></th>
    </tr>
    @foreach($users as $key => $user)
    <tr>
        <td>{{$key+1}}</td>
        <td>{{$user->username}}</td>
		<td>
		<div class="btn-group btn-group-sm">
			<button type="button" onclick="window.location.href='/users/group/{{$user->id}}/osu'" class="btn {{$user->allowedMode('osu') ? 'btn-success' : 'btn-danger'}}">osu!</button>
			<button type="button" onclick="window.location.href='/users/group/{{$user->id}}/taiko'" class="btn {{$user->allowedMode('taiko') ? 'btn-success' : 'btn-danger'}}">Taiko</button>
			<button type="button" onclick="window.location.href='/users/group/{{$user->id}}/ctb'" class="btn {{$user->allowedMode('ctb') ? 'btn-success' : 'btn-danger'}}">CtB</button>
			<button type="button" onclick="window.location.href='/users/group/{{$user->id}}/mania'" class="btn {{$user->allowedMode('mania') ? 'btn-success' : 'btn-danger'}}">o!m</button>
		</div>
		</td>
        <td><b>{{strtoupper($user->team)}}</b></td>
        <td>{{$user->updated_at}}</td>
        @if ($user->trashed())
        <td><button type="button" onclick="window.location.href='/users/delete/{{$user->id}}/restore'" class="btn btn-success">Restore?</button></td>
        @else
        <td><button type="button" onclick="window.location.href='/users/delete/{{$user->id}}/delete'" class="btn btn-danger">Delete?</button></td>
        @endif
    </tr>
    @endforeach
</table>
@stop
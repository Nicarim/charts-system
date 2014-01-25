@extends('layouts/master')
@section('content')
<table class="table table-hover">
    <tr>
        <th style="width:40px">#</th>
        <th style="width:65%">Username</th>
        <th>Team</th>
        <th>Last Active</th>
        <th></th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->username}}</td>
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
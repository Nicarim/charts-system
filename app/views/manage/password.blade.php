@extends('master')
@section('content')
<form class="form-signin" role="form" method="post">
    <h2>Change password!</h2>
    @if (Session::has('error'))
    <span style="color:darkred"><b>{{Session::get('error')}}</b></span>
    @endif
    @if (Auth::user()->isAdmin())
        <input type="text" class="form-control" placeholder="Username to change pass" name="usertochange">
    @endif
    <input type="password" class="form-control" placeholder="New password" name="password">
    <input type="password" class="form-control" placeholder="Confirm password" name="confirm_password">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Change</button>
</form>
@stop
@extends('master')
@section('content')
<form class="form-signin" role="form" method="post">
    <h2>Add new member</h2>
    @if (Session::has('error'))
    <span style="color:darkred"><b>{{Session::get('error')}}</b></span>
    @endif
    <input type="text" class="form-control" placeholder="osu! Username" name="username">
    <input type="password" class="form-control" placeholder="Temp Pass" name="password">
    <label class="radio">
        <input type="radio" value="bat" name="team"> BAT member?
    </label>
    <label class="radio">
        <input type="radio" value="cat" name="team"> CAT member?
    </label>
    <p>Voting ability:</p>
    <label class="checkbox">
        <input type="checkbox" value="yes" name="osu"> osu!
    </label>
    <label class="checkbox">
        <input type="checkbox" value="yes" name="taiko"> Taiko
    </label>
    <label class="checkbox">
        <input type="checkbox" value="yes" name="ctb"> Catch the Beat
    </label>
    <label class="checkbox">
        <input type="checkbox" value="yes" name="om"> osu!mania
    </label>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Add user</button>
</form>
@stop
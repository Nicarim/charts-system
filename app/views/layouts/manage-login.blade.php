@extends('layouts/master')

@section('content')
<form class="form-signin" role="form" method="post">
    <h2>Log in to vote</h2>
    @if (Session::has('error'))
    <span style="color:darkred"><b>{{Session::get('error')}}</b></span>
    @endif
    <input type="text" class="form-control" placeholder="osu! Username" name="username">
    <input type="password" class="form-control" placeholder="Password (admin pass:gay)" name="password">
    <label class="checkbox">
        <input type="checkbox" value="remember-me"> Remember me
    </label>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p>Don't have an account? Contact <a href="https://osu.ppy.sh/u/71366">Loctav</a> or <a
            href="https://osu.ppy.sh/u/722665">Marcin</a>!</p>
</form>@stop

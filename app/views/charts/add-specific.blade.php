@extends('master')

@section('content')
<h1>Create new difficulty chart!</h1>
<div class="input-group">
    <form role="form" name="input" method="post">
        <div class="form-group">
            <label for="chart-name">Chart Name:</label>
            <input type="text" class="form-control" id="chart-name" name="title" placeholder="Input name of chart...">
            <p>Don't add its type (themed, special). If its themed chart - write its theme name only (same for special).</p>
        </div>
        <div class="form-group"> Type of Chart</div>
        <label class="checkbox">
            <input type="radio" value="themed" name="type"> Themed
        </label>
        <label class="checkbox">
            <input type="radio" value="special" name="type"> Special
        </label>
        <div class="form-group">Gamemode of Chart</div>
        <label class="checkbox">
            <input type="radio" value="0" name="gamemode"> osu!Standard
        </label>
        <label class="checkbox">
            <input type="radio" value="1" name="gamemode"> Taiko
        </label>
        <label class="checkbox">
            <input type="radio" value="2" name="gamemode"> Catch the Beat
        </label>
        <label class="checkbox">
            <input type="radio" value="3" name="gamemode"> osu!mania
        </label>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Create</button>
        </div>
    </form>
</div>
@stop
@section('title')
<title>Create new difficulty chart!</title>
@stop
@extends('master')

@section('content')
<h1>Create new vote chart!</h1>
<div class="input-group">
    <form role="form" name="input" method="post">
        <div class="form-group">
            <label for="chart-id-overwrite">Overwrite chart_id</label>
            <input type="number" class="form-control" id="chart-id-overwrite" name="overwrite" placeholder="overwrite chart id" value="0">
        </div>
        <div class="form-group">
            <label for="chart-name">Chart Name:</label>
            <input type="text" class="form-control" id="chart-name" name="title" placeholder="Input name of chart...">
        </div>
        <div class="form-group">
            <label for="beatmaps">Beatmapset Ids:</label>
            <input type="text" class="form-control" id="beatmaps" name="beatmapsetids" placeholder="123,12421,294820,1337 etc.">
            <p>remember, sets, not freaking beatmaps</p>
        </div>
        <div class="form-group">
            <label for="votes-count">Votes Available:</label>
            <input type="text" class="form-control" id="votes-count" name="votescount" placeholder="default: 3">
        </div>
        <div class="form-group">
            <label for="date">Vote ending time:</label>
            <input type="datetime" class="form-control" id="date" name="date" placeholder="yyyy-mm-dd hh:mm:ss">
        </div>
        <div class="form-group"> Type of Chart</div>
        <label class="checkbox">
            <input type="radio" value="monthly" name="type"> Monthly
        </label>
        <label class="checkbox">
            <input type="radio" value="themed" name="type"> Themed
        </label>
        <label class="checkbox">
            <input type="radio" value="special" name="type"> Special
        </label>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Add</button>
        </div>
    </form>
</div>
@stop
@section('title')
<title>Create new vote chart!</title>
@stop
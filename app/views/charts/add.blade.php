@extends('master')

@section('content')
<h1>Create new chart!</h1>
<div class="input-group">
    <form role="form" name="input" method="post">
        <div class="form-group">
            <label for="chart-name">Chart Name:</label>
            <input type="text" class="form-control" id="chart-name" name="title" placeholder="Input name of chart...">
        </div>
        <div class="form-group">
            <label for="start-time">Beatmapset Ids:</label>
            <input type="text" class="form-control" name="beatmapids" placeholder="123,12421,294820,1337 etc.">
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
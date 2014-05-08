@extends('master')
@section('content')
@if (Auth::guest())
    <h1>Please login above!</h1>
@else
    
<h1>Hi <b>{{Auth::user()->username}}</b>, welcome to the Charts Voting page!</h1>
    
    @if (Auth::user()->isAdmin()) <p><b>You have administrator access!</b></p> @endif
    @if (Auth::user()->team == "bat") <p>You are part of the Beatmap Appreciation Team!</p> @endif
    @if (Auth::user()->team == "cat") <p>You are part of the Chart Assembly Team!</p> @endif
    <p><small>If the above information is not correct, please contact <url="https://osu.ppy.sh/forum/ucp.php?i=pm&mode=compose&u=722665">the charts administration immediately!</url></small></p>
    
    <p>Here you can vote for the currently ongoing Monthly Ranking Charts elections or create difficulty-specific Ranking Charts. Latter are still work in progress, but we need them for the point of finally releasing them. So do not hesitate to create as much as possible! 
    <br/>
    <br/>
    
<h2>Voting Charts regulations:</h2>
    <dl class="dl-horizontal">
        <dt>Start of Voting Phase:</dt>
                <dd>1st of every month</dd>
        <dt>End of Voting Phase:</dt>
                <dd>15th of every month</dd>
        <dt>Available votes:</dt>
                 <dd>6 per gamemode</dd>
    </dl>
    
<h2>Rules:</h2>
    <ol>
        <li><b>Do not vote mapsets you participated on!</b> If you have contributed on the standard difficulties of a set, do not vote for it in standard! Yet you can vote for a mapset in standard, if you have mapped taiko difficulties for it.</li>
        <li>Every BAT must place at least 3 votes or create 1 difficulty-specific chart within 3 months.</li>
        <li>Every CAT must place at least 3 votes per accessible gamemode or create 1 difficulty-specific chart per month.</li>
        <li>Difficulty-specific charts must follow a logic. May it be a themed chart, a gameplay-element-specific chart, a mapper-specific chart, etc. Unleash your fantasy.</li> 
        <li>Difficulty-specific charts can have mixed gamemodes. This means that you can have a chart that contains o!m difficulties and taiko difficulties - if they follow a logic.</li>
        <li>Disobeying this regularities may result in being removed from your respective team.</li>
        <li>Do not leak any content of this webpage. This will get you into serious trouble. And we find you. I promise.</li>
    </ol></p>
@endif

@stop
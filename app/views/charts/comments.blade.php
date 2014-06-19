<div class="panel-group" style="padding-bottom:30px;">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="smaller-margin">Comments ({{$chart->comments->count()}})</h3>
        </div>
    </div>
    @foreach ($chart->comments as $comment)
    @if (isset($comment->user->username))
    <div class="panel panel-default">
        <div class="panel-heading">
            <b class="glyphicon glyphicon-comment"></b><b>{{$comment->user->username}}</b>
            @if (Auth::user()->power == 3)
            <a class="label label-warning pull-right" href="/charts/remove_comment/{{$comment->id}}">Remove Comment</a>
            @endif
        </div>
        <div class="panel-body">
            <p>{{$comment->parsedComment()}}</p>
        </div>
    </div>
    @endif
    @endforeach
    <div class="panel panel-info">
        <div class="panel-heading">Add comment:</div>
        <div class="panel-body">
            <a href="http://daringfireball.net/projects/markdown/basics">Comments allow <b>markdown</b> usage! Check syntax here</a>
            <form role="form" method="post" action="/charts/add_comment/{{$chart->id}}">
                <textarea class="form-control" rows="10" name="content"></textarea>
                <button type="submit" class="btn btn-info">Add comment</button>
                <!--<button class="btn btn-warning" href="#"><b class="{{osuHelper::statusIcon($chart->status + 1)}}"></b>Comment & Qualify</button>-->
            </form>
        </div>
    </div>
</div>
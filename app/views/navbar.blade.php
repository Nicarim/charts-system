<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="container" id="bs-example-navbar-collapse-1">
        <a class="navbar-brand" href="/">Charts Management</a>
        <ul class="nav navbar-nav">
            <li><a href="/charts/list">View Charts</a></li>
            @if (!Auth::guest())
                @if (Auth::user()->isAdmin())
                    <li><a href="/charts/add">Create Vote Chart</a></li>
                @endif
            <li><a href="/charts/add_specific">Create Diff-specific Chart</a></li>
            @endif


        </ul>
        <ul class="nav navbar-nav navbar-right">
            @if (!Auth::guest())
            <li><a>Hi <b>{{Auth::user()->username}}</b>!</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">User Accounts <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    @if (Auth::user()->isAdmin())
                        <li><a href="/users/list">List of users</a></li>
                        <li><a href="/users/add">Add user</a></li>
                        <li class="divider"></li>
                    @endif
                    <li><a href="/users/pass">Change Password</a></li>
                </ul>
            </li>
            <li><a href="/logout">Logout</a></li>
            @else
                <li><button type="button" onclick="window.location.href='/login'" class="btn btn-default navbar-btn">Log in</button></li>
            @endif
        </ul>
    </div>
</nav>
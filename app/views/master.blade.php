<html>
    <head>
        <link rel="stylesheet" href="/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="/css/datepicker.css" />
        <link rel="stylesheet" href="/css/signin.css" />
        <link rel="stylesheet" href="/css/icons.css" />
        <script src="/js/jquery-2.0.3.min.js"></script>
        <script src="/js/jquery.timeago.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/bootstrap.datepicker.js"></script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-21965013-3', 'hiroto.eu');
            ga('send', 'pageview');

        </script>
        @yield ('title')
    </head>

    <body>

    @include ('navbar')
    <div class="container">
        @yield ('content')
    </div>
    </body>
</html>

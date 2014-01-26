<html>
    <head>
        <link rel="stylesheet" href="/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="/css/datepicker.css" />
        <link rel="stylesheet" href="/css/signin.css" />
        <link rel="stylesheet" href="/css/icons.css" />
        <script src="/js/jquery-2.0.3.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/bootstrap.datepicker.js"></script>
        @yield ('title')
    </head>

    <body>

    @include ('layouts/navbar')
    <div class="container">
        @yield ('content')
    </div>
    </body>
</html>

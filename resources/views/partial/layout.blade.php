<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Avalon</title>

    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        html{
            overflow-y: scroll;
        }
        *{
            padding: 0;
            margin: 0;
        }
        nav{
            width: 100%;
            background-color: #333;
            color: #eee;
            height: 32px;
            line-height: 32px;
        }
        nav ul{
            list-style-type: none;
        }
        nav li{
            float: left;
        }
        nav li:not(:first-child){
            margin-left: 100px;

        }
        header a{
            color: #111;
            text-decoration: none;
        }
        header a:hover{
            text-decoration: none;

        }
    </style>

    @include('partial.scrollbar')

    @yield('style')

</head>
<body>

<header>
    <div class="container">
        <a href="/"><h1>Avalon2</h1></a>
    </div>
</header>

<nav>
    <div class="container">
        <ul>
            <li>Index</li>
            <li>Index</li>
            <li>Index</li>
        </ul>
    </div>
</nav>

@yield('content')

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

@yield('script')

</body>
</html>
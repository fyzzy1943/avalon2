<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Avalon') }}</title>

  <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <link href="{{ asset('fantasy/avalon.css') }}" rel="stylesheet">

  @yield('style')

</head>
<body>
<header>
  <div class="container">
    <a href="/"><h1>{{ config('app.name', 'Avalon') }}</h1></a>
  </div>
</header>

<nav>
  <div class="container">
    <ul>
      <li><a href="{{ url('article') }}">首页</a></li>
      <li><a href="{{ url('category') }}">分类</a></li>
      <li><a href="{{ url('archives') }}">归档</a></li>
      <li><a href="">其它</a></li>
    </ul>

    <ul class="nav-right">
      <li><a href="{{ url('avalon') }}"><i class="fa fa-terminal"></i> </a></li>
    </ul>
  </div>
</nav>

<div class="clearfix"></div>

@yield('content')

@include('layouts.partial.footer')

@yield('script')

</body>
</html>

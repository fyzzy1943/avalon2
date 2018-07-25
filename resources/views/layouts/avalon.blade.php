<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Avalon') }}</title>

  @yield('style')

  <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="{{ mix('fantasy/avalon.css') }}" rel="stylesheet">

</head>
<body>

<div id="container">

  <div class="left_col">
    <header>
        <img src="/shadow/profile.jpg">
      <h1><a href="/">{{ config('app.name') }}</a></h1>
      <span>HeLLo WorLd</span>
    </header>

    <nav>
      <ul>
        <li><a href="{{ url('article') }}">首页</a></li>
        <li><a href="{{ url('category') }}">分类</a></li>
        <li><a href="{{ url('tags') }}">标签</a></li>
        <li><a href="{{ url('archives') }}">归档</a></li>
{{--        <li><a href="{{ url('notes') }}">笔记</a></li>--}}
        <li><a href="{{ url('friends') }}">路标</a></li>
        <li><a href="{{ url('article').'/about' }}">关于</a></li>
      </ul>
    </nav>
  </div>

  <div class="right_col">

    @yield('content')

    <div class="clearfix"></div>

    @include('layouts.partial.footer')

  </div>

</div>

</body>
</html>

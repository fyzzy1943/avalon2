<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Avalon') }}</title>


  <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('fantasy/avalon.css') }}" rel="stylesheet">

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

<script src="{{ asset('js/app.js') }}"></script>
@yield('script')
</body>
</html>

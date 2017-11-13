@extends('layouts.avalon')

@section('style')
  <link rel="stylesheet" href="{{ asset('fantasy/category.css') }}">
@endsection

@section('content')
<div class="container">
  <h1><a href="{{ url('archives') }}">友情链接</a></h1>

  <section>
    <ul>
      @forelse($links as $link)
        <li><a href="{{ $link->link }}">{{ $link->name }}</a></li>
      @empty
        <li>暂无小朋友</li>
      @endforelse
    </ul>
  </section>
</div>
@endsection

@extends('layouts.avalon')

@section('style')
  <link rel="stylesheet" href="{{ mix('fantasy/friends.css') }}">
@endsection

@section('content')
<div class="friends-container">
  <h1><a href="{{ url('archives') }}">友情链接</a></h1>

  @forelse($links as $link)
    <a href="{{ $link->$link }}" class="section">
        <h3>{{ $link->name }}</h3>
        <p>{{ $link->introduction }}</p>
    </a>
  @empty
    <section>
      <h3><a href="/">暂无小朋友</a></h3>
      <p>快来一起玩耍吧</p>
    </section>

  @endforelse

  <div class="clearfix"></div>
</div>
@endsection

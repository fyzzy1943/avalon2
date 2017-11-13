@extends('layouts.avalon')

@section('style')
  <link rel="stylesheet" href="{{ asset('fantasy/category.css') }}">
@endsection

@section('content')
<div class="container">
  <h1><a href="{{ url('archives') }}">文章归档</a></h1>

  @forelse($list as $date => $articles)
    <section>
      <h3>{{ substr_replace($date, '-', 4, 0) }} <small>({{ count($articles) }})</small></h3>
      <ul>
        @foreach($articles as $article)
          <li><a href="/article/{{ $article->id }}">{{ $article->title }}</a> <small>({{ $article->created_at->format('M d, Y') }})</small></li>
        @endforeach
      </ul>
    </section>
  @empty
    <section>没有文章</section>
  @endforelse
</div>
@endsection

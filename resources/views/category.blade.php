@extends('layouts.avalon')

@section('style')
  <link rel="stylesheet" href="{{ asset('fantasy/category.css') }}">
@endsection

@section('content')
  <div class="container">
    @foreach($list as $category)
      <section>
        <h3><a href="/category/{{ $category['cid'] }}">{{ $category['name'] }}</a> <small>({{ $category['count'] }})</small></h3>

        <ul>
          @forelse($category['articles'] as $article)
            <li><a href="/article/{{ $article['id'] }}">{{ $article['title'] }}</a> <small>({{ $article['created_at'] }})</small></li>
          @empty
            <li>没有文章</li>
          @endforelse
        </ul>
      </section>
    @endforeach
  </div>
@endsection

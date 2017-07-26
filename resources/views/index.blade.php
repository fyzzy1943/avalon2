@extends('layouts.avalon')

@section('style')
  <link rel="stylesheet" href="{{ asset('fantasy/index.css') }}">
@endsection

@section('content')
  <div class="container">
    <div class="left">
      @foreach($articles as $article)
        <section>
          <div class="title">
            <strong><a href="/article/{{ $article->id }}">{{ $article->title }}</a></strong>
            <p>来源：原创 &nbsp;|  &nbsp;分类：{{ $article->category->name }}</p>
            <span class="date">
              <small>{{ $article->created_at->format('Y') }}</small>{{ $article->created_at->format('m-d') }}</span>
          </div>
          <div class="cover">
            <img src="{{ $article->cover }}" title="{{ $article->title }}" alt="{{ $article->title }}">
          </div>
          <div class="information">
            <p>{{ $article->abstract }}</p>
            <span>
              点击：
              <a href="/article/{{ $article->id }}">阅读全文 &gt;&gt;</a>
            </span>

          </div>
        </section>
      @endforeach

      {{ $articles->links('layouts.partial.pagination') }}

    </div>

    <div class="right">
      <section>
        <h3>分类列表</h3>
        <ul>
          <li>...</li>
          <li>...</li>
          <li>...</li>
          <li>...</li>
          <li>...</li>
        </ul>
      </section>
      <section>
        <h3>友情链接</h3>
        <ul>
          @foreach($links as $link)
            <li><a href="{{ $link->link }}">{{ $link->name }}</a></li>
          @endforeach
        </ul>
      </section>
      <hr>
      <div class="category">
        <h3>分类列表</h3>
        <ul>
          <li>...</li>
          <li>...</li>
          <li>...</li>
        </ul>
      </div>
    </div>
  </div>
@endsection

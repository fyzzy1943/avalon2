@extends('layouts.avalon')

@section('style')
  <link rel="stylesheet" href="{{ asset('fantasy/index.css') }}">
@endsection

@section('content')

  @foreach($articles as $article)
    <section>
      <div class="title">
        <h1><a href="/article/{{ $article->id }}">{{ $article->title }}</a></h1>
        {{--<p>来源：原创 &nbsp;|  &nbsp;分类：{{ $article->category->name }}</p>--}}
        <p>
          分类：<a href="{{ url("category/{$article->category->id}") }}">{{ $article->category->name }}</a>
          |
          标签：@foreach($article->tags as $tag) {{ $tag->name }} @endforeach
        </p>
        <span class="date">
          <small>{{ $article->created_at->format('Y') }}</small>{{ $article->created_at->format('m-d') }}</span>
      </div>

      {{--<div class="cover">--}}
        {{--<img src="{{ $article->cover }}" title="{{ $article->title }}" alt="{{ $article->title }}">--}}
      {{--</div>--}}

      <div class="information">
        <p>{{ $article->abstract }}</p>
        <p>
          <a href="/article/{{ $article->id }}">阅读全文</a>
        </p>

      </div>
    </section>
  @endforeach

  {{ $articles->links('layouts.partial.pagination') }}


    {{--<div class="right">--}}
      {{--<section>--}}
        {{--<h3>分类列表</h3>--}}
        {{--<ul>--}}
          {{--@foreach($categories as $category)--}}
            {{--<li><a href="/category/{{ $category->id }}">{{ $category->name }}</a></li>--}}
          {{--@endforeach--}}
        {{--</ul>--}}
      {{--</section>--}}
      {{--<section>--}}
        {{--<h3>友情链接</h3>--}}
        {{--<ul>--}}
          {{--@foreach($links as $link)--}}
            {{--<li><a href="{{ $link->link }}">{{ $link->name }}</a></li>--}}
          {{--@endforeach--}}
        {{--</ul>--}}
      {{--</section>--}}
      {{--<hr>--}}
    {{--</div>--}}
@endsection

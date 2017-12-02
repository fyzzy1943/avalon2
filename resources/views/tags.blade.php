@extends('layouts.avalon')

@section('style')
 <link rel="stylesheet" href="{{ mix('/fantasy/tags.css') }}">
@endsection

@section('content')

  <div class="tags-container">

    <h1>标签</h1>

    <div class="tags">
      @foreach($tags as $tag)
        <a href="{{ url('tags/'.$tag->name) }}">{{ $tag->name }}</a>，
      @endforeach
    </div>

    <ul>
    @forelse($articles as $article)
      <li>
        <a href="{{ url('/article/'.$article->id) }}">
          {{ $article->title }}
        </a>
        <small> _{{ $article->created_at->format('M d, Y') }}</small>
      </li>
    @empty
      <li>此标签下暂无文章呦~</li>
    @endforelse
    </ul>

  </div>
@endsection

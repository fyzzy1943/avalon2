@extends('layouts.avalon')

@section('style')
  <link rel="stylesheet" href="{{ asset('editor/css/editormd.preview.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('fantasy/notes.css') }}">

@endsection

@section('content')
  <div id="container">
    @forelse($notes as $note)
      <section>
        <div class="date">{{ $note->created_at->format('Y-m-d H:i') }}</div>
        <div class="content">{!! $note->doc_html !!}</div>
      </section>
    @empty
      <section>没有笔记</section>
    @endforelse
  </div>
@endsection

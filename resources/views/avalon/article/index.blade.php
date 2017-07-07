@extends('avalon.partial.layout')

@section('content')

  <div class="container">
    <a href="/avalon/article/create" class="btn btn-primary">New Article</a>
    <hr>
    <table class="table table-striped">
      <tr>
        <th>标题</th>
        <th>标题</th>
        <th>标题</th>
      </tr>
      @forelse($articles as $article)
        <tr>
          <td>{{ $article->title }}</td>
          <td>{{ $article->created_at }}</td>
          <td>
            <div class="btn-group btn-group-xs" role="group" aria-label="...">
              <a href="/avalon/article/{{ $article->id }}/edit" class="btn btn-info btn-xs">编辑</a>
              <button class="btn btn-danger btn-xs">删除</button>
            </div>
          </td>
        </tr>
      @empty
        <p>暂时没有</p>
      @endforelse
    </table>
  </div>

@endsection
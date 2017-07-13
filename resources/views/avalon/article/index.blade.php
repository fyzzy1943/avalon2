@extends('avalon.partial.layout')

@section('content')

  <div class="container">
    <a href="/avalon/article/create" class="btn btn-primary">New Article</a>
    <hr>
    <table class="table table-striped">
      <tr>
        <th>ID</th>
        <th>标题</th>
        <th>分类</th>
        <th>状态</th>
        <th>创建时间</th>
        <th>操作</th>
      </tr>
      @forelse($articles as $article)
        <tr id="tr_{{ $article->id }}">
          <td>{{ $article->id }}</td>
          <td>{{ $article->title }}</td>
          <td>{{ $article->category->name }}</td>
          <td>{{ $article->status_d }}</td>
          <td>{{ $article->created_at }}</td>
          <td>
            <div class="btn-group btn-group-xs" role="group" aria-label="...">
              <a href="/avalon/article/{{ $article->id }}/edit" class="btn btn-info btn-xs">编辑</a>
              <button class="btn btn-danger btn-xs" delete="{{ $article->id }}">删除</button>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="3">暂无数据</td>
        </tr>
      @endforelse
    </table>
  </div>

@endsection

@section('script')
  <script>
    $(function($) {
      $('button[delete]').bind('click', function() {
          $id = $(this).attr('delete');

          $.post('{{ url('avalon/article') }}' + '/' + $id, {
              _method : 'DELETE',
              _token  : $('meta[name="csrf-token"]').attr('content')
          }, function (data, status) {
//              alert(data);
//              alert(status);
          }, 'json');
      });
    });
  </script>
@endsection

@extends('avalon.partial.layout')

@section('content')

  <div class="container">

    <form class="form-inline" action="{{ route('links') }}" method="POST">
      {{ csrf_field() }}

      <div class="form-group">
        <label for="name">名称</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
      </div>
      <div class="form-group">
        <label for="link">网址</label>
        <input type="text" class="form-control" id="link" name="link" placeholder="Link">
      </div>
      <div class="form-group">
        <label for="introduction">描述</label>
        <input type="text" class="form-control" id="introduction" name="introduction" placeholder="Introduction">
      </div>
      <div class="form-group">
        <label for="avatar">头像</label>
        <input type="text" class="form-control" id="avatar" name="avatar" placeholder="Avatar">
      </div>
      <button type="submit" class="btn btn-default">添加</button>
    </form>
    <hr>

    <table class="table table-striped">
      <tr>
        <th width="10%">ID</th>
        <th width="20%">名称</th>
        <th width="20%">网址</th>
        <th width="20%">描述</th>
        <th width="15%">创建时间</th>
        <th width="15%">操作</th>
      </tr>
      @forelse($links as $link)
        <tr id="tr_{{ $link->id }}">
          <td>{{ $link->id }}</td>
          <td>{{ $link->name }}</td>
          <td>{{ $link->link }}</td>
          <td>{{ $link->introduction }}</td>
          <td>{{ $link->created_at }}</td>
          <td>
            <div class="btn-group btn-group-xs" role="group" aria-label="...">
              <a href="/avalon/article/{{ $link->id }}/edit" class="btn btn-info btn-xs">编辑</a>
              <button class="btn btn-danger btn-xs" delete="{{ $link->id }}">删除</button>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" style="text-align: center">暂无数据</td>
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

              $.post('{{ route('links') }}' + '/' + $id, {
                  _method : 'DELETE',
                  _token  : $('meta[name="csrf-token"]').attr('content')
              }, function (data, status) {
                  if (data != false) {
                      $('#tr_'+data).remove();
                  } else {
                      alert('删除失败');
                  }
              }, 'json');
          });
      });
  </script>
@endsection

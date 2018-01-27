@extends('avalon.partial.layout')

@section('content')
  <div class="container">
    <a href="{{ route('category.create') }}" class="btn btn-primary">新建分类</a>
    <hr>
    <table class="table table-striped">
      <tr>
        <th>标题</th>
        <th>创建时间</th>
        <th>操作</th>
      </tr>
      @forelse($categories as $category)
        <tr>
          <td>{{ $category->name }}</td>
          <td>{{ $category->created_at }}</td>
          <td>
            <div class="btn-group btn-group-xs" role="group" aria-label="...">
              <a href="/avalon/category/{{ $category->id }}/edit" class="btn btn-info btn-xs">编辑</a>
              <button class="btn btn-danger btn-xs" delete-id="{{ $category->id }}">删除</button>
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
      jQuery(function ($) {
          $('button[delete-id]').click(function () {
              if (confirm("删除?")) {
                  $id = $(this).attr('delete-id');

                  $.post('{{ url('avalon/category') }}'+'/'+$id, {
                      _method: "delete",
                      _token: "{{ csrf_token() }}"
                  }, function (data, status) {
                      if (data.code != 0) {
                          alert(data.msg);
                      } else {
                          location.reload(true);
                      }
                  }, 'json');
              }
          });
      });
  </script>
@endsection

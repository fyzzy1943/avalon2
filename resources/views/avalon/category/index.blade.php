@extends('avalon.partial.layout')

@section('content')
  <div class="container">
    <a href="/avalon/category/create" class="btn btn-primary">New Category</a>
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
              <button class="btn btn-danger btn-xs">删除</button>
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

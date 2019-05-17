@extends('avalon.partial.layout')

@section('content')

  @include('avalon.partial.errors')

  <div class="container">
    <div style="padding: 0 0 10px 0;">
      <form action="{{ route('pic_store') }}" method="POST" enctype="multipart/form-data" class="form form-inline" >
        <div class="form-group">
          <input type="file" class="form-control" name="pic" placeholder="File">
        </div>

        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">提交</button>
      </form>
    </div>


    <table class="table table-striped">
      <tr>
        <th>ID</th>
        <th>url</th>
        <th>预览</th>
      </tr>
      @forelse($pics as $pic)
        <tr id="tr_{{ $pic->id }}">
          <td>{{ $pic->id }}</td>
          <td>{{ $pic->url }}</td>
          <td><img src="{{ $pic->url }}" style="max-width: 100px;max-height: 100px;"></td>
        </tr>
      @empty
        <tr>
          <td colspan="3">暂无数据</td>
        </tr>
      @endforelse
    </table>
  </div>
@endsection

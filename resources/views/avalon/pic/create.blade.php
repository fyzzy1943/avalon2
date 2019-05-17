@extends('avalon.partial.layout')

@section('content')

  @include('avalon.partial.errors')

  <div class="container">
    <form action="{{ route('pic_store') }}" method="POST" enctype="multipart/form-data" class="form" >
      <div class="form-group">
        <input type="file" class="form-control" name="pic" placeholder="File">
      </div>

      {{ csrf_field() }}
      <button type="submit" class="btn btn-default">提交</button>
    </form>
  </div>
@endsection

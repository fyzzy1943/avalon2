@extends('avalon.partial.layout')

@section('content')

  @include('avalon.partial.errors')

  <div class="container">
    <form action="/avalon/category" method="POST">
      <div class="form-group">
        <label for="name">名字</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
      </div>

      {{ csrf_field() }}
      <button type="submit" class="btn btn-default">提交</button>
    </form>
  </div>
@endsection

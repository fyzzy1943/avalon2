@extends('avalon.partial.layout')

@section('content')

  <div class="container">

    <form class="form-inline" action="{{ route('sign') }}" method="POST">
      {{ csrf_field() }}

      <button type="submit" class="btn btn-default">签到</button>
    </form>
    <hr>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>日</th>
          <th>一</th>
          <th>二</th>
          <th>三</th>
          <th>四</th>
          <th>五</th>
          <th>六</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        @foreach($list as $key => $item)
{{--          {{ $key }} --}}
          @if(($key-1) % 7 == 0)
         </tr><tr>
          @endif
          <td>
            @if($item > 0)
              <span class="badge" style="background-color: red;">{{ $item }}</span>
            @else
              <span class="badge">{{ $item }}</span>
            @endif
          </td>
        @endforeach
        </tr>
      </tbody>
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

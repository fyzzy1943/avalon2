@extends('avalon.partial.layout')

@section('style')
  <style>
    td, th{
      text-align: center;
    }
  </style>
@endsection

@section('content')

  <div class="container">

    <form class="form-inline" action="{{ route('sign') }}" method="POST">
      {{ csrf_field() }}

      <button type="submit" class="btn btn-default">签到</button>
    </form>
    <hr>
    <div class="row">
      <div class="col-md-4">

        @foreach($list as $month)
          <table class="table table-bordered table-condensed">
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
              @for($i=0; $i<$month['day_of_week']; $i++)
                <td>{{ $month['day_of_week'] }}</td>
              @endfor
              @foreach($month['values'] as $key => $item)
                {{--          {{ $key }} --}}
                <td>
                  @if($item > 0)
                    <span class="badge" style="background-color: red;">{{ $item }}</span>
                  @else
                    <span class="badge">{{ $item }}</span>
                  @endif
                </td>

                @if(($key + $month['day_of_week']) % 7 == 0)
                  </tr><tr>
                @endif
              @endforeach
            </tr>
            </tbody>
          </table>
        @endforeach

      </div>
    </div>
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

@extends('avalon.partial.layout')

@section('style')
  <style>
    td, th{
      text-align: center;
    }
    .title{
      text-align: center;
    }
  </style>
@endsection

@section('content')

  {{--{!! dd($list) !!}--}}
  <div class="container">

    <form class="form-inline" action="{{ route('sign') }}" method="POST">
      {{ csrf_field() }}

      <button type="submit" class="btn btn-primary" style="width: 100%">签到</button>
    </form>
    <hr>
    <div class="row">
        @foreach($list as $index => $month)
        <div class="col-md-4">
          <h3 class="title"> {{ $index }} 月 </h3>
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

                @if((($key + $month['day_of_week']) % 7 == 0)
                      && $key < count($month['values']))
                  </tr><tr>
                @endif
              @endforeach
            </tr>
            </tbody>
          </table>
        </div>

        @if($index % 3 == 0 && $index < 12)
          </div>
          <div class="row">
        @endif

        @endforeach
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

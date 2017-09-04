@extends('avalon.partial.layout')

@section('content')

  <div class="container">

    <form class="form-inline" action="{{ route('sign') }}" method="POST">
      {{ csrf_field() }}


      <button type="submit" class="btn btn-default">签到</button>
    </form>
    <hr>

    <table class="table table-striped">

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

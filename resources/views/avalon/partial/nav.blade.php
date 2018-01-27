@if(Auth::check())

  <nav class="navbar navbar-default">
    <div class="container-fuild">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('avalon') }}">{{ config('app.name') }}</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">

          <li class="@if(Request::is('avalon/article*'))active @endif"><a href="{{route('article')}}">文章</a></li>
          <li class="@if(Request::is('avalon/article*'))active @endif dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false"><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('avalon/article/create') }}">添加</a></li>
              <li><a href="#">None</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ url('avalon/article/recycle') }}">回收站</a></li>
            </ul>
          </li>
          <li class="@if(Request::is('avalon/category*'))active @endif">
            <a href="{{ route('category.index') }}">分类</a>
          </li>

          <li class="@if(Request::is('avalon/note*'))active @endif">
            <a href="{{ route('note.index') }}">笔记</a>
          </li>

          <li class="@if(Request::is('avalon/system*'))active @endif dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">系统管理 <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('links') }}">友情链接</a></li>
              <li><a href="{{ route('sign') }}">签到表</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
        </ul>

        <form class="navbar-form navbar-left">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>

        <ul class="nav navbar-nav navbar-right">
          <li><a href="/" target="_blank">网站</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">{{ Auth::user()->nick }} <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">个人设置</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  登出
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

@endif

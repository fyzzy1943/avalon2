@extends('layouts.avalon')

@section('style')
  <link rel="stylesheet" href="{{ asset('editor/css/editormd.preview.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('fantasy/article.css') }}">
@endsection

@section('content')
  <div class="loading">
    <img src="{{ asset('shadow/loading.gif') }}">
  </div>

  <div class="container" style="display: none">

    <div id="sidebar">
      <h1>index</h1>
      <hr>
      <div class="markdown-body editormd-preview-container" id="custom-toc-container"></div>
    </div>

    <div class="left">
      <article>
        <h1><a name="{{ $article->title }}" class="reference-link"></a>{{ $article->title }}</h1>
        <span id="info">
          {{ $article->created_at->format('Y/m/d') }} |
          分类:{{ $article->category->name }} |
          标签:@foreach($article->tags as $tag) {{ $tag->name }} @endforeach |
          点击:{{ $article->page_views }}
          @auth | <a href="/avalon/article/{{ $article->id }}/edit">编辑</a> @endauth
        </span>
        <hr>
        <div id="article">
          {{--<textarea title="article" style="display: none">{!! $article->withTitle !!}</textarea>--}}
          <textarea title="article" style="display: none">{!! $article->doc_md !!}</textarea>
        </div>
      </article>

      <div class="clearfix"></div>
      <div class="info">
        <span>本篇文章最后更新于 {{ $article->article_updated_at->format('Y-m-d H:i') }}（{{ $article->article_updated_at->diffForHumans() }}）</span>
      </div>

      <div class="clearfix"></div>
      <h2 id="comment">评论：<small>请针对 disq.us | disquscdn.com | disqus.com 启用代理~</small></h2>
      <div id="disqus_thread"></div>

    </div>
  </div>

  <script src="{{ asset('engine/jquery-3.2.1.min.js') }}"></script>
  <script src="/editor/lib/marked.min.js"></script>
  <script src="/editor/lib/prettify.min.js"></script>

  <script src="/editor/lib/raphael.min.js"></script>
  <script src="/editor/lib/underscore.min.js"></script>
  <script src="/editor/lib/sequence-diagram.min.js"></script>
  <script src="/editor/lib/flowchart.min.js"></script>
  <script src="/editor/lib/jquery.flowchart.min.js"></script>

  <script src="/editor/editormd.min.js"></script>
  <script>
    $(function () {
        var article;

        article = editormd.markdownToHTML("article", {

//            htmlDecode      : "style,script,iframe",  // you can filter tags decode
            htmlDecode      : "style,script",  // you can filter tags decode

            tocm            : true,    // Using [TOCM]
            tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层

            emoji           : true,
            taskList        : true,
            tex             : true,  // 默认不解析
            flowChart       : true,  // 默认不解析
            sequenceDiagram : true  // 默认不解析
        });

        $('.loading').fadeOut();
        $('.container').fadeIn();


        $(document).scroll(function () {
            if ($(document).scrollTop() <= 3) {
//                $old_top = Number($sidebar.css('top').substring(0, $sidebar.css('top').indexOf('p')));
                $('#sidebar').css('top', 3 - $(document).scrollTop());
            } else {
                $('#sidebar').css('top', 0);
            }
        });

        $('#custom-toc-container ul li a[href^="#"]').click(function(e){
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $("[name='"+$(this).attr('href').substr(1)+"']").offset().top
            }, 370, 'swing');
        });
        var disqus_config = function () {
            this.page.url = '{{ url(config('app.url') . '/article/' . $article->id) }}';  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = {{ $article->id }}; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };

        (function () { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://fordawn.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    });
  </script>
  <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
@endsection

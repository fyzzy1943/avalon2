@extends('layouts.avalon')

@section('style')
  {{--<link rel="stylesheet" href="/editor/style.css" />--}}
  {{--<link rel="stylesheet" href="/editor/editormd.css" />--}}
  <link rel="stylesheet" href="/editor/css/editormd.preview.min.css" />
    <style>
        /*#sidebar {*/
            /*width: 400px;*/
            /*height: 100%;*/
            /*position: fixed;*/
            /*top: 0;*/
            /*right: 0;*/
            /*overflow: hidden;*/
            /*background: #fff;*/
            /*z-index: 100;*/
            /*padding: 18px;*/
            /*border: 1px solid #ddd;*/
            /*border-top: none;*/
            /*border-bottom: none;*/
        /*}*/

        /*#sidebar:hover {*/
            /*overflow: auto;*/
        /*}*/
    </style>
@endsection

@section('content')
    <div class="container">
        <h1>{{ $article->title }}</h1>
        <div id="sidebar">
            {{--<h1>Table of Contents</h1>--}}
            <div class="markdown-body editormd-preview-container" id="custom-toc-container">#custom-toc-container</div>
        </div>
        <article>
            <div id="article">
                <textarea title="article" style="display: none">{!! $article->doc_md !!}</textarea>
            </div>
        </article>
        <footer>
            <a href="/article" class="btn btn-default">返回</a>
        </footer>
    </div>
@endsection

@section('script')
  <script src="/editor/lib/marked.min.js"></script>
  <script src="/editor/lib/prettify.min.js"></script>

  <script src="/editor/lib/raphael.min.js"></script>
  <script src="/editor/lib/underscore.min.js"></script>
  <script src="/editor/lib/sequence-diagram.min.js"></script>
  <script src="/editor/lib/flowchart.min.js"></script>
  <script src="/editor/lib/jquery.flowchart.min.js"></script>


  <script src="/editor/editormd.js"></script>
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
    });
  </script>
@endsection

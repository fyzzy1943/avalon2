@extends('avalon.partial.layout')

@section('style')
  <link rel="stylesheet" href="{{ asset('editor/css/editormd.min.css') }}" />
@endsection

@section('content')
  <div class="container">
    <form action="{{ route('note.store') }}" method="POST">
      <div class="form-group">
        <label for="editor">New Note</label>
        <div id="editor"></div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>

      {{ csrf_field() }}
    </form>
    <table class="table table-striped">
      <tr>
        <th width="5%">ID</th>
        <th width="50%">标题</th>
        <th width="30%">创建时间</th>
        <th width="15%">操作</th>
      </tr>
      @forelse($notes as $note)
        <tr>
          <th>{{ $note->id }}</th>
          <td>{!! $note->doc_html !!}</td>
          <td>{{ $note->created_at }}</td>
          <td>
            <div class="btn-group btn-group-xs" role="group" aria-label="...">
              <a href="/avalon/category/{{ $note->id }}/edit" class="btn btn-info btn-xs">编辑</a>
              <button class="btn btn-danger btn-xs">删除</button>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="3">暂无数据</td>
        </tr>
      @endforelse
    </table>
  </div>
@endsection

@section('script')
  <script src="/editor/editormd.min.js"></script>
  <script>
      var testEditor;

      $(function ($) {
          testEditor = editormd("editor", {
              width: "100%",
              height: 230,
//            autoHeight : true,
              path: '/editor/lib/',
              pluginPath: '/editor/plugins/',
              theme: "dark",
              previewTheme: "default",
              editorTheme: "monokai",
              codeFold: true,
//            lineNumbers: true,
              //syncScrolling : false,
              saveHTMLToTextarea: true,    // 保存 HTML 到 Textarea
              searchReplace: true,
              //watch : false,                // 关闭实时预览
              htmlDecode: "style,script",            // 开启 HTML 标签解析，为了安全性，默认不开启
              toolbar  : false,             //关闭工具栏
              //previewCodeHighlight : false, // 关闭预览 HTML 的代码块高亮，默认开启
              emoji: true,
              taskList: true,
//              tocm: true,         // Using [TOCM]
              tex: true,                   // 开启科学公式TeX语言支持，默认关闭
//              flowChart: true,             // 开启流程图支持，默认关闭
//              sequenceDiagram: true,       // 开启时序/序列图支持，默认关闭,
              //dialogLockScreen : false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
              //dialogShowMask : false,     // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
              //dialogDraggable : false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
              //dialogMaskOpacity : 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
              //dialogMaskBgColor : "#000", // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
              imageUpload: false,
              imageFormats: ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
              imageUploadURL: "/avalon/upload/img/editormd-image-file",
              onload: function () {
                  console.log('onload', this);
                  //this.fullscreen();
                  //this.unwatch();
                  //this.watch().fullscreen();

                  //this.setMarkdown("#PHP");
                  //this.width("100%");
                  //this.height(480);
                  //this.resize("100%", 640);
              }
          });
      });
  </script>

@endsection

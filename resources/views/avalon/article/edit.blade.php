@extends('avalon.partial.layout')

@section('style')
  <link rel="stylesheet" href="/editor/css/editormd.min.css"/>
@endsection

@section('content')
  <div class="container">
    <div class="form-group">
      <span>cover:(764 * 270)</span>
      <div id="cover_preview" style="width: 764px;height: 270px;">
        <img src="{{ $article->cover }}" style="width: 100%;height: 100%;">
      </div>
      <input type="file" class="form-control" id="cover" placeholder="cover">
    </div>
    <hr style="border-color: #333">

    <form action="/avalon/article/{{ $article->id }}" method="POST">
      <div class="row">
        <div class="col-md-7">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="标题"
                   value="{{ $article->title }}">
          </div>
          <div class="form-group">
            <label for="abstract">Abstract</label>
            <textarea class="form-control" id="abstract" name="abstract" rows="5"
                      placeholder="摘要">{{ $article->abstract }}</textarea>
          </div>
          <div class="form-group">
            <label for="alias">Alias</label>
            <input type="text" class="form-control" id="alias" name="alias" placeholder="别名" value="{{ $article->alias }}">
          </div>
        </div>


        <div class="col-md-5">
          <div class="radio-inline">
            <label>
              <input type="radio" name="status" id="status" value="0" @if($article->status == 0) checked @endif>
              草稿
            </label>
          </div>
          <div class="radio-inline">
            <label>
              <input type="radio" name="status" id="status" value="1" @if($article->status == 1) checked @endif>
              发布
            </label>
          </div>
          <div class="radio-inline">
            <label>
              <input type="radio" name="status" id="status" value="2" @if($article->status == 2) checked @endif>
              隐藏
            </label>
          </div>
          <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category">
              @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        @if($article->cid == $category->id) selected @endif>{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>

      <div class="form-group">
        <label for="editor">Text</label>
        <div id="editor">
          <textarea title="" style="display: none">{{ $article->doc_md }}</textarea>
        </div>
      </div>

      <div class="form-group">
        <input type="hidden" name="cover" value="{{ $article->cover }}">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-default">Submit</button>
        <a href="/avalon/article" class="btn btn-default">Back</a>
      </div>

      {{ method_field('PUT') }}
      {{ csrf_field() }}
    </form>
  </div>

@endsection

@section('script')

  <script src="/editor/editormd.min.js"></script>
  <script>
      var testEditor;

      $(function ($) {
          testEditor = editormd("editor", {
              width: "100%",
              height: 730,
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
              //toolbar  : false,             //关闭工具栏
              //previewCodeHighlight : false, // 关闭预览 HTML 的代码块高亮，默认开启
              emoji: true,
              taskList: true,
              tocm: true,         // Using [TOCM]
              tex: true,                   // 开启科学公式TeX语言支持，默认关闭
              flowChart: true,             // 开启流程图支持，默认关闭
              sequenceDiagram: true,       // 开启时序/序列图支持，默认关闭,
              //dialogLockScreen : false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
              //dialogShowMask : false,     // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
              //dialogDraggable : false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
              //dialogMaskOpacity : 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
              //dialogMaskBgColor : "#000", // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
              imageUpload: true,
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

          $('#cover').on('change', function (e) {
              var formData = new FormData();

              formData.append('_token', '{{ csrf_token() }}');
              formData.append('cover', $('#cover')[0].files[0]);

              $.ajax({
                  url:          '/avalon/upload/img/cover',
                  method:       'POST',
                  data:         formData,
                  contentType:  false,
                  processData:  false,
                  cache:        false,
                  success:      function (data) {
//                  data = JSON.parse(data);

                      if (data.success == 1) {
                          var $img = $('<img>', {'src': data.url, 'style': 'width:100%; height:100%'});
                          $('#cover_preview').html('').append($img);
                          $("input[name='cover']").val(data.url);
                      } else {
                          alert(data.message);
                      }
                  },
                  error:        function (jqXHR) {
                      console.log(JSON.stringify(jqXHR));
                  }
              })
                  .done(function (data) {
                      console.log('done');
                  })
                  .fail(function (data) {
                      console.log('fail');
                  })
                  .always(function (data) {
                      console.log('always');
                  });
          });
      });

  </script>

@endsection

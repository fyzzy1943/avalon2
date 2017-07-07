<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Title</title>

  <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  {{--<link rel="stylesheet" href="/editor/style.css" />--}}
  <link rel="stylesheet" href="/editor/css/editormd.min.css" />
  <style>

  </style>
</head>
<body>
<div class="container">

  <div class="form-group">
    <span>cover:(764 * 270)</span>
    <div id="cover_preview" style="width: 764px;height: 270px;"></div>
    <input type="file" class="form-control" id="cover" placeholder="cover">
  </div>
  <hr style="border-color: #333">

  <hr>
  <form action="/avalon/article" method="post">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="标题">
    </div>
    <div class="form-group">
      <label for="abstract">Abstract</label>
      <textarea class="form-control" name="abstract" rows="5" placeholder="摘要"></textarea>
    </div>

    <div class="radio-inline">
      <label>
        <input type="radio" name="status" id="status" value="1">
        发布
      </label>
    </div>
    <div class="radio-inline">
      <label>
        <input type="radio" name="status" id="status" value="0" checked>
        草稿
      </label>
    </div>
    <div class="form-group">
      <label for="editor">Text</label>
      <div id="editor"></div>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-default">Submit</button>
      <a href="/avalon/article" class="btn btn-default">Back</a>
    </div>

    {{ csrf_field() }}
    <input type="hidden" name="cover">
  </form>
</div>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/editor/editormd.js"></script>
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
</body>
</html>
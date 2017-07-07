<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    {{--<link rel="stylesheet" href="/editor/style.css" />--}}
    <link rel="stylesheet" href="/editor/editormd.css" />
    <style>

    </style>
</head>
<body>
<div class="container">
    {{-- 123 --}}
    <form action="/avalon/article" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $article->title }}">
        </div>
        <div class="form-group">
            <label for="editor">Text</label>
            <div id="editor">
                <textarea title="" style="display: none">{{ $article->doc_md }}</textarea>
            </div>
        </div>

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $article->id }}">
        <button type="submit" class="btn btn-default">Submit</button>
        <a href="/avalon/article" class="btn btn-default">Back</a>
    </form>
</div>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/editor/editormd.min.js"></script>
<script>
    var testEditor;

    $(function () {
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
    });

</script>
</body>
</html>
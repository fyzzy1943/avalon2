@extends('avalon.partial.layout')

@section('style')
  <link rel="stylesheet" href="/editor/css/editormd.min.css" />
@endsection

@section('content')
  <div class="container">
    <div class="form-group">
      <span>cover:(764 * 270)</span>
      <div id="cover_preview" style="width: 764px;height: 270px;"></div>
      <input type="file" class="form-control" id="cover" placeholder="cover">
    </div>
    <hr style="border-color: #333">

    <hr>
    <form id="article_form" action="/avalon/article" method="post">
      <div class="row">
        <div class="col-md-7">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="标题 REQUIRED">
          </div>
          <div class="form-group">
            <label for="alias">Alias</label>
            <input type="text" class="form-control" id="alias" name="alias" placeholder="别名">
          </div>
          <div class="form-group">
            <label for="abstract">Abstract</label>
            <textarea class="form-control" id="abstract" name="abstract" rows="5" placeholder="摘要"></textarea>
          </div>
        </div>
        <div class="col-md-5">
          <div class="radio-inline">
            <label>
              <input type="radio" name="status" id="status" value="0" checked>
              草稿
            </label>
          </div>
          <div class="radio-inline">
            <label>
              <input type="radio" name="status" id="status" value="1">
              发布
            </label>
          </div>
          <div class="radio-inline">
            <label>
              <input type="radio" name="status" id="status" value="2">
              隐藏
            </label>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Category</div>
              <select class="form-control" id="category" name="category">
                <option v-for="category in categories" :value="category.id">@{{ category.name }}</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="sr-only" for="add_category">Add Category</label>
            <div class="input-group pull-left col-sm-10">
              <div class="input-group-addon">Add Category</div>
              <input type="text" class="form-control" id="add_category" v-model="tmpCategory">
            </div>
            <div v-on:click="createCategory" class="btn btn-primary col-sm-2">Submit</div>
          </div>

          <div class="form-group">
            <label for="tags">Tags（空格分隔）</label>
            <input type="text" class="form-control" id="tags" name="tags" placeholder="标签">
          </div>
        </div>
      </div>
      <div class="clearfix"></div>

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

@endsection

@section('script')
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://cdn.bootcss.com/vue-resource/1.5.1/vue-resource.min.js"></script>
  <script src="/editor/editormd.min.js"></script>
  <script>
      let app = new Vue({
        el: '#article_form',
        data: {
            tmpCategory: '',
            categories: []
        },
        mounted: function () {
            this.listCategories();
        },
        methods: {
          createCategory: function () {
            this.$http.post('/api/category', {
                "name": this.tmpCategory,
                {{--"_token": "{{ csrf_token() }}"--}}
                "token": "{{ generate_token() }}"
            }).then(function (data) {
                // console.log(data);
                if (data.body.code == 0) {
                    this.categories.push(data.body.data);
                    this.tmpCategory = '';
                    console.log(this.categories);
                } else {
                    alert(data.body.msg);
                }
            });
          },

          listCategories: function() {
              this.$http.get('/api/category')
                  .then(function (data) {
                      if (data.body.code == 0) {
                          this.categories = data.body.data;
                      } else {
                          alert(data.body.msg);
                      }

                      console.log(this.categories);
                  });
          }
        }
      });

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
                  url: '/avalon/upload/img/cover',
                  method: 'POST',
                  data: formData,
                  contentType: false,
                  processData: false,
                  cache: false,
                  success: function (data) {
//                  data = JSON.parse(data);

                      if (data.success == 1) {
                          var $img = $('<img>', {'src': data.url, 'style': 'width:100%; height:100%'});
                          $('#cover_preview').html('').append($img);
                          $("input[name='cover']").val(data.url);
                      } else {
                          alert(data.message);
                      }
                  },
                  error: function (jqXHR) {
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

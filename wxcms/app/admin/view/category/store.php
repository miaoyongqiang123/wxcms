<extend file='resource/view/admin/master'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li ><a href="{{u('index')}}" >栏目列表</a></li>
        <li class="active"><a href="{{u('store')}}" >栏目添加</a></li>
    </ul>
    <!-- TAB CONTENT -->
    <form action="" method="POST" class="form-horizontal" role="form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">栏目添加</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">栏目名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="cname" placeholder="请输入栏目名称">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">排序</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" value="100" name="orders" placeholder="请输入栏目名称">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">是否为封面栏目</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label>
                                <input type="radio" name="is_cate" value="1" >是
                            </label>
                            <label>
                                <input type="radio" name="is_cate" value="2" checked>否
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">所属栏目</label>
                    <div class="col-sm-10">
                        <select name="pid"  class="form-control">
                            <option value="0"> 顶级栏目  </option>
                            <foreach from="$cateData" key="$k" value="$v">
                                <option value="{{$v['id']}}">  {!!$v['_cname']!!}  </option>
                            </foreach>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">缩略图</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input class="form-control" name="thumb" readonly="" value="">
                            <div class="input-group-btn">
                                <button onclick="upImagePc(this)" class="btn btn-default" type="button">选择图片</button>
                            </div>
                        </div>
                        <div class="input-group" style="margin-top:5px;">
                            <img src="{{__ROOT__}}/node_modules/hdjs/dist/static/image/nopic.jpg" class="img-responsive img-thumbnail" width="150">
                            <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片"
                                onclick="removeImg(this)">×</em>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary">提交</button>
    </form>
    <script>
        require(['hdjs']);
        //上传图片
        function upImagePc() {
            require(['hdjs'], function (hdjs) {
                var options = {
                    multiple: false,//是否允许多图上传
                    //data是向后台服务器提交的POST数据
                    data: {name: '后盾人', year: 2099},
                };
                hdjs.image(function (images) {
                    //上传成功的图片，数组类型
                    $("[name='thumb']").val(images[0]);
                    $(".img-thumbnail").attr('src', images[0]);
                }, options)
            });
        }

        //移除图片
        function removeImg(obj) {
            $(obj).prev('img').attr('src', '../dist/static/image/nopic.jpg');
            $(obj).parent().prev().find('input').val('');
        }
    </script>
</block>
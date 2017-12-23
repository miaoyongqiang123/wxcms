<extend file='resource/view/admin/master'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{u('index')}}" >栏目列表</a></li>
        <li><a href="{{u('store')}}" >栏目添加</a></li>
    </ul>
    <!-- TAB CONTENT -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">栏目列表</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>栏目名称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <foreach from='$field' key='$k' value='$v'>
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>{!! $v['_cname'] !!}</td>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <a href="{!! u('edit',['id'=>$v['id']]) !!}" class="btn btn-success">编辑</a>
                                <button type="button" class="btn btn-danger" onclick="del({{$v['id']}})">删除</button>
                            </div>
                        </td>
                    </tr>
                </foreach>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function del(id) {
            require(['hdjs'], function (hdjs) {
                hdjs.confirm('确定删除吗?', function () {
                    location.href = "{{u('del')}}" + '&id=' + id;
                })
            })
        }
    </script>
</block>
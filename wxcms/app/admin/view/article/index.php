<extend file='resource/view/admin/master'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{u('index')}}" >文章列表</a></li>
        <li><a href="{{u('store')}}" >文章添加</a></li>
    </ul>
    <!-- TAB CONTENT -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">文章列表</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>文章标题</th>
                    <th>文章作者</th>
                    <th>发表时间</th>
                    <th>文章点击</th>
                    <th>文章预览图</th>
                    <th>是否热门</th>
                    <th>是否推荐</th>
                    <th>所属栏目</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <foreach from='$field' key='$k' value='$v'>
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>{!! $v['title'] !!}</td>
                        <td>{!! $v['author'] !!}</td>
                        <td>{!! $v['created_at'] !!}</td>
                        <td>{!! $v['click'] !!}</td>
                        <td><img src="{!! $v['prev'] !!}" style="width: 20%;height: 20%" alt="缩略图"></td>
                        <td>
                            <if value="$v['is_hot']==1">
                                <i class="fa fa-check-circle-o"></i>
                                <else/>
                                <i class="fa fa-times"></i>
                            </if>
                        </td>
                        <td>
                            <if value="$v['is_recommened']==1">
                                <i class="fa fa-check-circle-o"></i>
                                <else/>
                                <i class="fa fa-times alert-danger" ></i>
                            </if>
                        </td>
                        <td>{{ $v->category()->cname}}</td>
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
    {!! $field->links() !!}
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
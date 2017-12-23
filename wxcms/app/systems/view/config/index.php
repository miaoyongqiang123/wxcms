<extend file='resource/view/admin/systems'/>
<block name="content">
	<!-- TAB NAVIGATION -->
	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="{{u('index')}}" >站点配置</a></li>
	</ul>
<!--	<div class="alert alert-info">-->
<!--		系统配置可方便在任何地方调用-->
<!--		<br>-->
<!--		如需要使用网站标题：@{{v('system.title')}}-->
<!--	</div>-->
	<!-- TAB CONTENT -->
	<form action="" method="POST" class="form-horizontal" role="form">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">站点配置</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">网站标题(title)</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="title" value="{{$field['title']}}" placeholder="请输入网站标题">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">备案号(icp)</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="icp" value="{{$field['icp']}}" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">网站描述(description)</label>
					<div class="col-sm-10">
						<textarea name="description" class="form-control" cols="30" rows="3">{{$field['description']}}</textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">客服电话(tel)</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="tel" value="{{$field['tel']}}" placeholder="">
					</div>
				</div>
			</div>

		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">文章配置</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">文章每页显示数量(arc_num)</label>
					<div class="col-sm-10">
						<input type="number" min="1" name="arc_num" value="{{$field['arc_num']}}" class="form-control" id="" placeholder="">
					</div>
				</div>

			</div>
		</div>
			<div class="col-sm-10 col-sm-offset-5">
				<button type="submit" class="btn btn-primary">提交</button>
			</div>
	</form>
</block>
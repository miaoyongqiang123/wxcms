<extend file='resource/view/admin/wechat'/>
<block name="content">
	<!-- TAB NAVIGATION -->
	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="{{u('index')}}" >默认消息</a></li>
	</ul>
	<!-- TAB CONTENT -->
	<form action="" method="POST" class="form-horizontal" role="form">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">默认消息</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">关注回复</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="welcome" value="{{$field['welcome']}}" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">默认回复</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="default" value="{{$field['default']}}" placeholder="">
					</div>
				</div>

			</div>

		</div>
		<button class="btn btn-primary">提交</button>
	</form>

</block>
<extend file='resource/view/admin/wechat'/>
<block name="content">
	<!-- TAB NAVIGATION -->
	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="{{u('index')}}" >微信配置</a></li>
	</ul>
	<!-- TAB CONTENT -->
	<form action="" method="POST" class="form-horizontal" role="form">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">微信配置</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">token</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="token" value="{{$field['token']}}" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">appid</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="appid" value="{{$field['appid']}}" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">appsecret</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="appsecret" value="{{$field['appsecret']}}" placeholder="">
					</div>
				</div>

			</div>

		</div>
		<button class="btn btn-primary">提交</button>
	</form>

</block>
<extend file='resource/view/admin/systems'/>
<block name="content">
	<!-- TAB NAVIGATION -->
	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="{{u('index')}}" >数据备份</a></li>
	</ul>
    <div class="alert alert-info">
    	{{$message}}
    </div>
    <script>
        setTimeout(function(){
            location.href="{!! $_SERVER['REQUEST_URI'] !!}"
        },100);
    </script>

</block>
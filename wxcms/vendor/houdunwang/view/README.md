#视图模板组件

##介绍
视图组件分开了逻辑程序和外在的内容 , 提供了一种易于管理的方法。可以描述为应用程序员和美工扮演了不同的角色 , 因为在大多数情况下 , 他们不可能是同一个人。例如 , 你正在创建一个用于浏览新闻的网页 , 新闻标题 , 标签栏 , 作者和内容等都是内容要素 , 他们并不包含应该怎样去呈现。模板设计者们编辑模板 , 组合使用 html 标签和模板标签去格式化这些要素的输出 (html 表格 , 背景色 , 字体大小 , 样式表 , 等等 )。
有一天程序员想要改变文章检索的方式 ( 也就是程序逻辑的改变 )。这个改变不影响模板设计者 , 内容仍将准确的输出到模板。同样的 , 哪天美工想要完全重做界面也不会影响到程序逻辑。因此 , 程序员可以改变逻辑而不需要重新构建模板 , 模板设计者可以改变模板而不影响到逻辑。 
模版组件引擎是编译型模版引擎，模版文件只编译一次，以后程序会直接采用编译文件，效率非常高。 

[TOC]
#开始使用

####安装组件
使用 composer 命令进行安装或下载源代码使用。
```
composer require houdunwang/view
```
> HDPHP 框架已经内置此组件，无需要安装

####配置

```
$config =  [
    /*
    |--------------------------------------------------------------------------
    | 开启调试模式
    |--------------------------------------------------------------------------
    */
    'debug'       => true,
    /*
    |--------------------------------------------------------------------------
    | 模板目录
    |--------------------------------------------------------------------------
    | 只参路由模式有效
    | 控制器访问时无效
    */
    'path'        => 'view',

    /*
    |--------------------------------------------------------------------------
    | 模板文件默认扩展名
    |--------------------------------------------------------------------------
    | 当使用模板时没有添加扩展名将使用下面定义的扩展名
    */
    'prefix'      => '.php',

    /*
    |--------------------------------------------------------------------------
    | 扩展标签
    |--------------------------------------------------------------------------
    | 用于定义扩展的模板标签
    */
    'tags'        => [
        \tests\app\Common::class
    ],

    /*
    |--------------------------------------------------------------------------
    | 左边界符
    |--------------------------------------------------------------------------
    | 用于定义模板标签的左边界符
    */
    'tag_left'    => '<',

    /*
    |--------------------------------------------------------------------------
    | 右边界符
    |--------------------------------------------------------------------------
    | 用于定义模板标签的右边界符
    */
    'tag_right'   => '>',

    /*
    |--------------------------------------------------------------------------
    | Blade模板标签开关
    |--------------------------------------------------------------------------
    | 当设置为FALSE时,模板引擎的blade(父子级包含)功能将失效
    */
    'blade'       => true,

    /*
    |--------------------------------------------------------------------------
    | 缓存目录
    |--------------------------------------------------------------------------
    | 框架支持缓存模板文件用于减少服务器压力
    | 下面的配置项是定义缓存文件的存放目录
    */
    'cache_dir'   => 'tests/storage/view/cache',

    /*
    |--------------------------------------------------------------------------
    | 编译目录
    |--------------------------------------------------------------------------
    | 模板引擎支持一次编译生成PHP代码这样可以提供系统运行性能
    | 下面的配置项是定义编译文件的保存目录
    */
    'compile_dir' => 'tests/storage/view/compile',
];
\houdunwang\config\Config::batch($config);
```

#模板文件
模板就是视图界面，模板会在路由与控制器中使用到，如果在路由回调函数中使用，因为没有模块所以与在控制器中使用还是有些不同的。

[TOC]

###语法
```
View::make($tpl,$vars=[]);
参数               	说明
$tpl				   模版文件
$vars				分配的变量
```

##使用
系统调用配置文件的策略如下：
1. 模板文件存在时直接读取 如: View::make('index.php')
2. 控制器中使用：模块/view/控制器/模板文件
3. 路由中使用：到"view.php"配置文件设置的目录中查找
4. 文件没有扩展名时以配置项 prefix 添加后缀

####控制器中使用
不设置模板时使用当前请求方法做为文件名
```
return View::make();
//没有参数时使用当前方法名称做为模板文件名
```

不添加后缀时使用配置项 prefix 设置的后缀。
```
return  View::make('add');
//添加路径时分2种情况：
//1: 从网站根目录查找即："add.php"
//2: 从模块的View目录查找:"模块/view/add.php"
```

####路由器中使用
```
Route::get('/',function(){
	return View::make('index');
});
```
上面的代码会到"view.php"配置文件设置的目录中查找 index.php

##分配数据

[TOC]

####分配变量
```
View::with('uri','houdunwang.com');
//模板中读取方式：{{$uri}}
```

####以数组形式分配
```
View::with(['name'=>'后盾网','uri'=>'houdunwang.com']);
//模板中读取方式：{{$name}}
```
####在make时分配
View::make('index.html',['name'=>'后盾人']);

####点语法分配变量
```
View::with('module.name','后盾人');
//或
View::with(['module.name'=>'后盾人']);
//模板中使用以下方式读取
{{$module['name']}}
```

####分配变量并显示模板
```
return  View::with(['name'=>'后盾网','uri'=>'houdunwang.com'])->make();
```

####获取分配的变量
vars() 方法用于获取使用 with()方法分配的所有变量
```
View::getVars();
```

##模板使用
通过View::with分配的变量在模板中使用{{变量名}}形式读取

####读取变量
```
{{$name}}          					
```
####读取配置项值
```
{{Config::get('database.user')}}  
```
> 提示：在{{ }}中可以使用任意php函数

####忽略解析
```
@{{$name}}
```

#系统标签
模板标签是使用预先定义好的tag快速读取数据。开发者也可以根据项目需要扩展标签库。

[TOC]

##运算符
可以在属性中使用以下运算符：
```
eq		==
neq		!=
lt		<
gt		>
lte		<=
gte		>=
```

####使用
```
<if value="$a gt 2">
</if>
```

##foreach 标签 
foreach标签与 PHP 中的 foreach 使用方法一致
```
语法
<foreach from='变量' key='键名' value='键值'>
	内容 
</foreach>
```

####基本使用
```
<foreach from='$user' key='$key' value='$value'>
 {{strtoupper($value)}} 
</foreach>
```

####多重嵌套
```
<foreach from='$user' key='$key' value='$value'>
	<foreach from='$value' key='$n'value='$m'>
		{{$m}}
	</foreach>
</foreach>
```

##list 标签
####语法
```
<list from='变量' name='值' row='显示行数' empty='为空时显示内容'>
	内容 
</list>
```

####基本使用
```
<list from='$data' name='$d' row='10' start='0' empty='没有数据'>
	{{$d['cname']}}
</list>
```

####间隔读取
表示每次间隔 2 条数据输出
```
<list from='$row' name='$n' step='2'>
	{{$n['title']}}
</list>
```

####起始记录
从第 2 条数据开始显示
```
<list from='$row' name='$n' start='2'>
	{{$n.title}}
</list>
```

####高级使用
```
<list from='$data' name='$n'>
    <if value="$hd['list']['n']['first']">
        {{$hd['list']['n']['index']}}: 这是第一条数据<br/>
    <elseif value="$hd['list']['n']['last']"/>
        {{$hd['list']['n']['index']}}: 最后一条记录<br/>
    <else/>
        {{$hd['list']['n']['index']}}:{{$n['title']}}<br/>
	</if>
</list>
{{$hd['list']['n']['total']}} 	部记录数 
{{$hd['list']['n']['first']}} 	是否为第 1 条记录 
{{$hd['list']['n']['last']}} 		是否为最后一条记录 
{{$hd['list']['n']['total']}} 	总记录数 
{{$hd['list']['n']['index']}} 	当前循环是第几条 
```

##if 标签 
```
<if value="$webname eq 'houdunwang'">
	后盾网 
</if>
```

##else 标签
```
<if value='$webname == "houdunwang"'>
	后盾网 
<elseif value='$webname == "baidu"'/>
	 百度 
<else/>
	其他网站 
</if>
```

##include导入模板
```
<include file="header"/>
```

可以在include标签中使用任意的路径常量
```
<include file="VIEW_PATH/header"/>
```

导入指定的具体文件
```
<include file="template/index.html"/>
```

##php标签
用于生成php代码
```
<php>if(true){</php>
后盾网
<php>}</php>
```

##引入CSS文件
可以在标签中使用系统提供的url常量
```
<css file="__VIEW__/css/common.css"/>
```

##引入JavaScript文件
可以在标签中使用系统提供的url常量
```
<js file="__ROOT__/view/css/common.js/>
```

#扩展标签

框架提供了方便快速的标签定义，大大减少代码量，实现快速网站开发。 设置自定义标签简单、快速，下面我们来学习掌握框架自定义标签的使用方法。 

[TOC]

##文件
####创建文件
使用命令行创建标签类。
```
php hd make:tag Common
//系统将在 system/tag 目录中生成标签文件
```

####设置配置
修改config/view.php文件设置如下字段
```
'tags'=> [system\tag\Common::class]
```

##创建
标签代码可以放在任何目录中，只需要配置项中正确指定类即可。
####代码
```
namespace system/tag;
use hdphp\view\TagBase;
class Common extends TagBase{
    //标签声明
    public $tags = [
    	//block说明 1：块标签  0：行标签
        'test' => ['block' => 1, 'level' => 4]
    ];
    /**
     * 测试标签
     * @param $attr 标签属性集合
     * @param $content 标签嵌套内容，块标签才有值
     * @param $view 视图服务对象
     */
    public function _test($attr, $content, &$view){
        return '33';
    }
}
```

####说明
1. 块标签设置level 用于定义系统解析标签嵌套层数
2. 行标签不需要设置level


#缓存模板
缓存可以增加网站加载速度，减少数据库服务器的压力，结合路由操作可以实例与全站静态化相同的效果，并且操作更加便捷。

[TOC]

##创建
生成缓存文件，第二个参数为缓存时间，0(默认)为不缓存
```
return View::cache(100)->make('article');
//将article缓存100秒
```

##验证
验证当缓存是否有效
```
View::isCache('article');
```

##删除
删除缓存必须在 make 与 isCache 等方法前执行
```
View::delCache('article');
```

#模板继承
##介绍
模板继承类似于PHP中的类继承，有两个角色一个是“布局模板(父模板)”用于定义相应的blade（区块)，然后是继承“布局模板”的“视图模板”，视图模板定义块内容替换布局模板中相应的blade区域。

[TOC]
####特点
* 布局模板用于定义区块
* 视图模板用于定义替换布局模板的内容
* 布局模板可以被多个 视图模板 继承

##使用
####布局模板(父模板)
布局模板是被子模板调用的，不需要在控制器或路由中读取。比如下面的模板文件 master.php ，子模板要调用时可以使用 <extend file='master'/> 继承这个父模板。
```
<html>
<head>
	<title>Blade 页面布局(父模板)</title>
</head>
<body>
<blade name="content"/>
<widget name="header">
	头部内容(父页面 widget标签内容) {{$title}}
</widget>
<widget name="footer">
	底部内容(父页面 widget标签内容)
</widget>
</body>
</html>
```

####视图模板(子模板)
视图模板指我们在控制器或路由中使用 View::make() 或 view() 函数显示的模板。
```
<extend file='master'/>
<block name="content">
	<parent name="header" title="这是标题">
  这是主体内容  
	<parent name="footer">
</block>
```
####说明
* extend用于继承 布局模板（父级)，必须放在 parent、block 等标签前面调用
* 使用block标签定义视图内容，block替换“父级模板"中相同name属性的blade标签
* parent标签用于将父级模板 widget标签内容显示到此处
* parent标签支持向父级传递内容如上例中的title，父级中使用{{title}}方式调用

#视图函数

[TOC]
##view
view函数是View::make()的函数调用方式，就是解析模板使用的。

##widget组件函数
大家不要将 widget 函数与 模板标签中的 widget标签混淆，虽然都在在视图模板中使用，但功能略有不同。

widget函数用于在视图中调用类方法，类方法可以使用View::make()等组件或任何动作只要返回的字符串都会在调用 widget方法的模板位置显示，大家通过下面实例来加深印象。

####类文件定义
```
namespace app;
class Widget {
	public function show($a,$b){
		return 'hello hdphp!'.$b;
	}
}
```

####模板中调用
```
{{widget('app.widget.show',99,'hdphp')}}
```
widget方法的第一个参数为调用的类方法，以后的参数都是类方法的参数。
上例中将在模板中显示 ‘hello hdphp! hdphp'


##truncate截取内容
```
{{truncate('后盾人 人人做后盾',3)}}
//结果为：后盾人
```
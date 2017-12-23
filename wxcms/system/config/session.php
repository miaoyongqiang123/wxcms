<?php
$driver = is_file('data/lock.php') ? 'mysql' : 'file';
return [
    /*
    |--------------------------------------------------------------------------
    | 引擎
    |--------------------------------------------------------------------------
    | 系统支持file,mysql,memcache,redis等常见的SESSION处理引擎
    */
    'driver'   => $driver,

    /*
    |--------------------------------------------------------------------------
    | ID
    |--------------------------------------------------------------------------
    | 保存在客户端COOKIE中的sessid名称
    */
    'name'     => 'HDPHPID',

    /*
    |--------------------------------------------------------------------------
    | 域名
    |--------------------------------------------------------------------------
    | 用于设置可以使用SESSION数据的域名
    */
    'domain'   => '',

    /*
    |--------------------------------------------------------------------------
    | 过期时间
    |--------------------------------------------------------------------------
    | SESSION数据有效期
    | 设置0即为会话状态, 关闭浏览器后SESSION失效
    */
    'expire'   => 86400 * 10,

    /*
    |--------------------------------------------------------------------------
    | 目录
    |--------------------------------------------------------------------------
    | 当引擎为FILE类型时即以文件形式处理SESSION,
    | 通过设置下面的path值来定义保存SESSION的目录
    */
    'file'     => [
        'path' => 'storage/session',
    ],

    /*
    |--------------------------------------------------------------------------
    | 数据表
    |--------------------------------------------------------------------------
    | 引擎为MYSQL时定义保存SESSION的数据表名称
    */
    'mysql'    => [
        'table' => 'session',
    ],

    /*
    |--------------------------------------------------------------------------
    | 数据表
    |--------------------------------------------------------------------------
    | 引擎为 Memcache 时定义保存SESSION的Memcache服务器资料
    */
    #Memcache
    'memcache' => [
        'host' => 'localhost',
        'port' => 11211,
    ],

    /*
    |--------------------------------------------------------------------------
    | 数据表
    |--------------------------------------------------------------------------
    | 引擎为 Redis 时定义保存SESSION的Memcache服务器资料
    */
    'redis'    => [
        'host'     => 'localhost',
        'port'     => 11211,
        'password' => '',
        'database' => 0,
    ],
];
<?php

// [ 应用入口文件 ]
// 准许跨域请求。
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: * ");
/**
 * 浏览器第一次在处理复杂请求的时候会先发起OPTIONS请求。路由在处理请求的时候会导致PUT请求失败。
 * 在检测到option请求的时候就停止继续执行
 */
if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
    exit;
}



// 定义应用目录
define('APP_PATH', __DIR__ . '/api/');
// 加载框架引导文件
require __DIR__ . '/thinkphp/start.php';  

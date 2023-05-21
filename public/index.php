<?php
declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

// 这行代码是框架开发时用的, 使用者可以删除 
// require __DIR__.'/../../framework/vendor/autoload.php';

use PhpRest2\Application;

// 创建APP对象 fileCachePath 为是否使用文件缓存，具体请移步查看源码
// $app = Application::create(config: __DIR__.'/../App/config.php', fileCachePath: __DIR__.'/../cache');
$app = Application::create(config: __DIR__.'/../App/config.php');

// [可选] 全局HOOK
// $app->addGlobalHook(classPath: '\App\Hook\GlobalHook');

// 加载路由
$app->scanRoutesFromPath(path: __DIR__.'/../App/Controller', namespace: 'App\Controller');

// [可选] 加载事件驱动
$app->scanListenerFromPath(path: __DIR__.'/../App/Event', namespace: 'App\Event');

// 解析请求
$app->dispatch();
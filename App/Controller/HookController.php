<?php
declare(strict_types=1);

/**
 * hook 功能类型springboot中的过滤器, 添加在function上, 会先于方法前执行
 * 一般用在验证权限, 缓存结果等使用场景
 * 
 * 可写在 controller 上, 该控制器下所有路由都生效
 * 或写在 function   上, 只对指定路由生效
 * 
 * 两处都写的话，只会执行action上的 hook
 */

namespace App\Controller;

use PhpRest2\Controller\Attribute\{Controller, Action, Hook};
use App\Hook\{TestHook1, TestHook2, TestHook3};

#[Controller('/hook')]
#[Hook(TestHook2::class, params: 'on controller')]
class HookController
{
    /***************************************************************************************
     * 
     **************************************************************************************/
    #[Action('GET:/demo1')]
    #[Hook(TestHook1::class)]
    public function demo1()
    {
        return 'demo1';
    }

    /***************************************************************************************
     * 
     **************************************************************************************/
    #[Action('GET:/demo2')]
    #[Hook(TestHook1::class)]
    #[Hook(TestHook2::class, params: 'on action')]
    #[Hook(TestHook3::class)]
    public function demo2()
    {
        return 'demo2';
    }
}

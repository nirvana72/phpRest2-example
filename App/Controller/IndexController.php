<?php
declare(strict_types=1);

namespace App\Controller;

use PhpRest2\Controller\Attribute\{Controller, Action};
use PhpRest2\Controller\ControllerBuilder;
use PhpRest2\ApiResult;

#[Controller('')]
class IndexController
{
    /***************************************************************************************
     * 获取所有路由信息
     **************************************************************************************/
    #[Action('GET:/apis')]
    public function getApis()
    {
        $app = \PhpRest2\Application::getInstance();
        $controllerBuilder = $app->get(ControllerBuilder::class);
        $controllers = [];
        foreach($app->getControllers() as $classPath) {
            $controller = $controllerBuilder->build($classPath);
            $controllers[] = $controller;
        }
        return ApiResult::success($controllers);
    }
}

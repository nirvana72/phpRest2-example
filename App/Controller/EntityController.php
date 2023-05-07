<?php
declare(strict_types=1);

namespace App\Controller;

use PhpRest2\Controller\Attribute\{Controller, Action, Summary, Param};
use App\Entity\{User, Info};
use App\Entity\Nested\Company;
use App\Entity\Inherit\ObjSon;

#[Controller('/entity')]
class EntityController
{
    /***************************************************************************************
     * 
     **************************************************************************************/
    #[Action('POST:/demo1')]
    public function demo1(User $user)
    {
        return $user;
    }

    /***************************************************************************************
     * 绑定到实体类数组
     **************************************************************************************/
    #[Action('POST:/demo2')]
    #[Param(name: 'users', type: User::class)]
    public function demo2(array $users)
    {
        return $users;
    }

    /***************************************************************************************
     * 
     **************************************************************************************/
    #[Action('POST:/demo3')]
    public function demo3(User $user, Info $info)
    {
        return [
            'user' => $user,
            'info' => $info,
        ];
    }

    /***************************************************************************************
     * 实体类嵌套实体类, 嵌套实体类数组, 嵌套基础类型数组
     **************************************************************************************/
    #[Action('POST:/demo4')]
    public function demo4(Company $company)
    {
        return $company;
    }

    /***************************************************************************************
     * 实体类支持继承
     **************************************************************************************/
    #[Action('POST:/demo5')]
    public function demo5(ObjSon $son)
    {
        return $son;
    }

    /***************************************************************************************
     * 绑定参数为实体类有两种方式
     * 
     * #[Param(name: 'users', type: User::class)]
     * 或
     * public function demo1(User $user)
     * 二选一，优先取 Param 注解
     * 
     * 此方法中user只是个array, 并不是一个实体类
     **************************************************************************************/
    #[Action('POST:/demo6')]
    public function demo6($user)
    {
        return $user;
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

use PhpRest2\Controller\Attribute\{Controller, Action, Summary, Param};
use PhpRest2\ApiResult;
use Symfony\Component\HttpFoundation\Request;

#[Controller('/params')]
class ParamsController
{
    /***************************************************************************************
     * 
     **************************************************************************************/
    #[Action('GET:/demo1')]
    public function demo1($p1)
    {
        return "p1 = {$p1}";
    }

    /***************************************************************************************
     * 参数类型 两处都可以指定
     * 
     * #[Param(name: 'p1', type: 'string')]
     * 或
     * public function demo2(string $p1)
     * 
     * 两处都不写则默认为 mixed
     **************************************************************************************/
    #[Action('GET:/demo2')]
    #[Summary('第二个示例', desc: '主要演示参数注解的使用')]
    #[Param(name: 'p1', type: 'string', desc: 'p1描述')]
    #[Param(name: 'p2', type: 'int', desc: '描述可不写, 默认等于参数名 p2')]
    #[Param(name: 'p3', desc: '数类型可不写, 默认为 mixed')]
    #[Param(name: 'p4', type: 'string', desc: '参数默认必传,除非在function中给了默认值,参数为可选')]
    public function demo2($p1,  $p2,  $p3,  $p4 = 'p4') 
    {
        return ApiResult::success([
            'p1' => $p1,
            'p2' => $p2,
            'p3' => $p3,
            'p4' => $p4,
        ]);
    }

    /***************************************************************************************
     * 参数绑定不同来源
     **************************************************************************************/
    #[Action('GET:/demo3/{id}')]
    #[Param(name: 'token', bind: 'headers.Authorization')]
    public function demo3(int $id, $token) 
    {
        return ApiResult::success([
            'id' => $id,
            'token' => $token,
        ]);
    }

    /***************************************************************************************
     * 参数校验
     **************************************************************************************/
    #[Action('POST:/demo4')]
    #[Summary('参数校验')]
    #[Param(name: 'p1',  type: 'string', desc: '随意值')]
    #[Param(name: 'p2',  type: 'int')]
    #[Param(name: 'p3',  type: 'float')]
    #[Param(name: 'p4',  rule: 'numeric')]
    #[Param(name: 'p5',  rule: 'email')]
    #[Param(name: 'p6',  rule: 'url')]
    #[Param(name: 'p7',  rule: 'alpha')]
    #[Param(name: 'p8',  rule: 'alphaNum')]
    #[Param(name: 'p9',  rule: 'slug')]
    #[Param(name: 'p10', rule: 'date')]
    #[Param(name: 'p11', rule: 'dateFormat=H:i:s')]
    #[Param(name: 'p12', rule: 'ip')]
    #[Param(name: 'p13', type: 'string', rule: 'lengthBetween=4,6')]   
    #[Param(name: 'p14', type: 'string', rule: 'length=6')]
    #[Param(name: 'p15', type: 'int', rule: 'integer|min=3|max=6')]
    #[Param(name: 'p16', type: 'string', rule: 'in=red,blue,yellow')]
    #[Param(name: 'p17', rule: '/^1[3456789][0-9]{9}$/')]
    public function demo4($p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10, $p11, $p12, $p13, $p14, $p15, $p16, $p17) 
    {
        // https://github.com/vlucas/valitron#built-in-validation-rules
        $res = [
            'p1' => $p1, // abc
            'p2' => $p2, // 1
            'p3' => $p3, // 3
            'p4' => $p4, // 64.4
            'p5' => $p5, // 15279663@qq.com
            'p6' => $p6, // http://www.163.com
            'p7' => $p7, // aa
            'p8' => $p8, // a142
            'p9' => $p9, // a1_
            'p10' => $p10, // 2020-11-11
            'p11' => $p11, // 11:11:11
            'p12' => $p12, // 127.0.0.1
            'p13' => $p13, // abcde
            'p14' => $p14, // aaaaaa
            'p15' => $p15, // 4
            'p16' => $p16, // red
            'p17' => $p17  // 13913181371
        ];

        return ApiResult::success($res);
    }

    /***************************************************************************************
     * 数组参数绑定
     **************************************************************************************/
    #[Action('POST:/demo5')]
    #[Summary('数组参数绑定')]
    #[Param(name: 'ary1', type: 'string')]
    #[Param(name: 'ary2', type: 'int')]
    public function demo5(array $ary1, array $ary2, array $ary3) 
    {
        return ApiResult::success([
            'ary1' => $ary1,
            'ary2' => $ary2,
            'ary3' => $ary3,
        ]);
    }
}

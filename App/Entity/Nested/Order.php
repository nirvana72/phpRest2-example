<?php
namespace App\Entity\Nested;

use PhpRest2\Entity\Attribute\{Summary, Property};

#[Summary(name: '企业订单')]
class Order
{
    #[Summary(name: '订单ID')]
    public int $id;

    #[Summary(name: '订单流水号')]
    #[Property(rule: '/^.{8}$/')]
    public string $code;

    #[Summary(name: '信息')]
    public OrderInfo $orderInfo;

    #[Summary(name: '其它', desc: '嵌套实体数组')]
    #[Property(type: OrderOther::class)]
    public array $orderOthers;
}
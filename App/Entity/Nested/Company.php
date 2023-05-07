<?php
namespace App\Entity\Nested;

use PhpRest2\Entity\Attribute\{Summary, Property};

#[Summary(name: '企业')]
class Company
{
    #[Summary(name: '企业ID')]
    public int $id;

    #[Summary(name: '企业名称')]
    public string $name;

    #[Summary(name: '员工')]
    public Employee $employee;

    #[Summary(name: '订单', desc: '订单中又嵌套子类')]
    public Order $order;
}
<?php
namespace App\Entity\Nested;

use PhpRest2\Entity\Attribute\{Summary, Property};

#[Summary(name: '企业员工')]
class Employee
{
    #[Summary(name: '员工ID')]
    public int $id;

    #[Summary(name: '员工名称')]
    public string $realName;

    #[Summary(name: '企业ID')]
    public int $companyId;
}
<?php
declare(strict_types=1);

namespace App\Entity;

use PhpRest2\Entity\Attribute\{Summary, Property};

#[Summary('用户', desc: '用户实体类的描述')]
class User
{
    public int $id;
    
    #[Summary(desc: '姓名')]    
    public string $name;

    public int $age = 18;

    #[Property(rule: '/^1[3456789][0-9]{9}$/')]
    public string $phone;
}
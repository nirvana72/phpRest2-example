<?php
namespace App\Entity\Nested;

use PhpRest2\Entity\Attribute\{Summary, Property};

class OrderOther
{
    public int $id;

    #[Property(type: 'string', rule: 'ip')]
    public array $ips;

    #[Property(type: 'int')]
    public array $nums;
}
<?php
declare(strict_types=1);

namespace App\Entity\Orm;

use PhpRest2\Entity\Attribute\{Summary, Property};
use PhpRest2\Orm\Attribute\{Table, Field};
use PhpRest2\Orm\OrmTrait;

#[Table('t_user')]
#[Summary('用户ORM实体类')]
class User
{
    use OrmTrait;

    #[Field(name: 'user_id', primaryKey: 'auto')]
    public ?int $id;

    #[Property(rule:'slug|lengthBetween=6,20')]
    public string $account;
    
    #[Summary('昵称')]
    public string $nickName;
    
    #[Field(name: 'password')]
    #[Property(rule:'slug')]
    public string $pwd;
    
    #[Property(rule: '/^1[3456789][0-9]{9}$/')]
    public string $phone;
}
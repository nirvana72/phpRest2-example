<?php
declare(strict_types=1);

namespace App\Event\User;

use \PhpRest2\Event\EventInterface;

class UserYListener implements EventInterface
{
    public function listen(): array
    {
        return ['UserEventB'];
    }

    public function handle(string $event, mixed $params = []): void
    {
        echo 'UserYListener.handle<br>';
        var_dump($params);
        echo '<br>';
    }
}

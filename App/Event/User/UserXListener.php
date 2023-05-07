<?php
declare(strict_types=1);

namespace App\Event\User;

use \PhpRest2\Event\EventInterface;

class UserXListener implements EventInterface
{
    public function listen(): array
    {
        return ['UserEventA', 'UserEventB'];
    }

    public function handle(string $event, mixed $params = []): void
    {
        echo 'UserXListener.handle<br>';
        var_dump($params);
        echo '<br>';
    }
}

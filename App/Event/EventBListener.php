<?php
declare(strict_types=1);

namespace App\Event;

use \PhpRest2\Event\EventInterface;

class EventBListener implements EventInterface
{
    public function listen(): array
    {
        return ['SomeThingDelete'];
    }

    public function handle(string $event, mixed $params = []): void
    {
        echo 'EventBListener.handle';
        echo "\r\n";
        echo "event = {$event}";
        echo "\r\n";
        echo 'params = ';
        var_dump($params);
    }
}

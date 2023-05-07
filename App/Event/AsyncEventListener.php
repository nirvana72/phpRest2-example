<?php
declare(strict_types=1);

namespace App\Event;

use \PhpRest2\Event\EventInterface;
use \App\Utils\AsyncRuner;
use \Psr\Log\LoggerInterface;
use DI\Attribute\Inject;

class AsyncEventListener implements EventInterface
{
    #[Inject]
    private LoggerInterface $logger;

    public function listen(): array
    {
        return ['AsyncEvent'];
    }

    public function handle(string $event, mixed $params = []): void
    {
        // 异步处理
        AsyncRuner::getInstance()->run(function() {
            $i = 0;
            while ($i < 5) {
                $this->logger->info("{$i}");
                \sleep(2);
                $i++;
            }
        });

        echo 'AsyncEventListener.handle';
    }
}

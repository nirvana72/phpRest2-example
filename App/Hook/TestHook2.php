<?php
declare(strict_types=1);

namespace App\Hook;

use PhpRest2\Hook\HookInterface;
use Symfony\Component\HttpFoundation\{Request, Response};

class TestHook2 implements HookInterface
{
    public function __construct(public string $params) {}

    /**
     * @param Request $request
     * @param callable $next
     * @return Response
     */
    public function handle(Request $request, callable $next): Response
    {
        echo "before TestHook2 params = {$this->params}<br>";
        $response = $next($request);
        echo 'after TestHook2<br>';
        return $response;
    }
}

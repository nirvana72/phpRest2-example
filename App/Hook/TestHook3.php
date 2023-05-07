<?php
declare(strict_types=1);

namespace App\Hook;

use PhpRest2\Hook\HookInterface;
use Symfony\Component\HttpFoundation\{Request, Response};

class TestHook3 implements HookInterface
{
    /**
     * @param Request $request
     * @param callable $next
     * @return Response
     */
    public function handle(Request $request, callable $next): Response
    {
        echo 'before TestHook3<br>';
        return $next($request);
    }
}

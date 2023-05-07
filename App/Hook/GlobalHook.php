<?php
declare(strict_types=1);

namespace App\Hook;

use PhpRest2\Hook\HookInterface;
use Symfony\Component\HttpFoundation\{Request, Response};

class GlobalHook implements HookInterface
{
    /**
     * @param Request $request
     * @param callable $next
     * @return Response
     */
    public function handle(Request $request, callable $next): Response
    {
        echo 'before GlobalHook<br>';
        $response = $next($request);
        echo 'after GlobalHook<br>';
        return $response;
    }
}

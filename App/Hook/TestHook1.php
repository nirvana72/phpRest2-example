<?php
declare(strict_types=1);

namespace App\Hook;

use PhpRest2\Hook\HookInterface;
use Symfony\Component\HttpFoundation\{Request, Response};

class TestHook1 implements HookInterface
{
    public function __construct(public string $params) {}

    /**
     * @param Request $request
     * @param callable $next
     * @return Response
     */
    public function handle(Request $request, callable $next): Response
    {
        $method = $request->server->get('REQUEST_METHOD');
        $route  = $request->server->get('REQUEST_URI');
        echo "before TestHook1 method = {$method}, route = {$route}, params = {$this->params}<br>";
        $response = $next($request);
        echo 'after TestHook1<br>';
        return $response;
    }
}

<?php
declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use PhpRest2\{Application, ApiResult};
use PhpRest2\Exception\ExceptionHandlerInterface;

class ExceptionHandler implements ExceptionHandlerInterface
{
    public function render(\Throwable $e): Response 
    {
        $response = Application::getInstance()->make(Response::class);
        $result = new ApiResult(-99, $e->getMessage());
        $file = $e->getFile();
        $line = $e->getLine();
        $result->data = "{$file} - line:{$line}";

        if ($e instanceof HttpException){
            $response->setStatusCode($e->getStatusCode());
        }
        
        $message = json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $response->setContent($message);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
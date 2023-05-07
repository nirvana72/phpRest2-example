<?php
namespace App;

if (! function_exists('App\log')) {
    function log($obj = null, $func = 'info') {
        $logger = \PhpRest2\Application::getInstance()->get(\Psr\Log\LoggerInterface::class);
        
        if ($obj === null) {
            $logger->{$func}('null');
            return;
        }

        if (is_array($obj)) {
            $msg = json_encode($obj);
            $logger->{$func}($msg);
            return;
        }
        
        $logger->{$func}($obj);
    }
}

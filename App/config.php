<?php
declare(strict_types=1);

use Symfony\Component\HttpFoundation\Response;
use PhpRest2\Exception\ExceptionHandlerInterface;
use Medoo\Medoo;
use PhpRest2\Utils\EnvHelper as Env;

// 加载环境变量
Env::loadFile($_SERVER['DOCUMENT_ROOT'] . '/../env/.env');

return [
    /************************************************************************************
      跨域处理
    ************************************************************************************/
    Response::class => \DI\factory(function () {
        $response = new Response();
        $response->headers->add([
          'Access-Control-Allow-Origin' => '*',
          'Access-Control-Allow-Headers' => '*',
          'Access-Control-Allow-Methods' => '*',
          'Access-Control-Allow-Credentials' => 'true',
          'X-Content-Type-Options' => 'nosniff',
          'X-XSS-Protection' => '1; mode=block'
        ]);
        return $response;
    }),
    
    /************************************************************************************
      自定义异常输出类
    /************************************************************************************/
    ExceptionHandlerInterface::class => \DI\autowire(\App\Exception\ExceptionHandler::class),

    /************************************************************************************
      日志输出
      DEBUG     (100)  : 详细的debug信息。
      INFO      (200)  : 关键事件。
      NOTICE    (250)  : 普通但是重要的事件。   
      WARNING   (300)  : 出现非错误的异常。
      ERROR     (400)  : 运行时错误，但是不需要立刻处理。
      CRITICA   (500)  : 严重错误。
      EMERGENCY (600)  : 系统不可用
    ************************************************************************************/
    'LoggerConfig' => [
        // 默认日志路径在此修改  
        'path'   => $_SERVER['DOCUMENT_ROOT'] . '/../logs/' . date("Y-m-d") . '.txt',
        'level'  => \Monolog\Logger::DEBUG,
        'format' => "%datetime% > %level_name% > %message% %context% %extra%\n",
    ],

    /************************************************************************************
      Mysql  https://medoo.in/doc
    ************************************************************************************/
    Medoo::class => \DI\factory(function () {
        return new Medoo([
            'database_type' => 'mysql',
            'database_name' => Env::get('database.dbname'),
            'server'        => Env::get('database.host'),
            'username'      => Env::get('database.username'),
            'password'      => Env::get('database.password'),
            'option' => [  // see https://www.php.net/manual/zh/book.pdo.php
                \PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES'utf8';"            
            ]
        ]);
    }),

    /************************************************************************************
      Redis
    ************************************************************************************/
    Redis::class => \DI\factory(function(){
        $dbIndex = intval(Env::get('redis.dbIndex', 0));
        $redis = new \Redis();
        $redis->connect(Env::get('redis.host', 'localhost'), 6379);
        $redis->auth(Env::get('redis.auth'));
        $redis->select($dbIndex);
        return $redis;
    }),
];
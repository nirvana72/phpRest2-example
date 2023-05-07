<?php
namespace App\Utils;

// php 异步进程
// 需解禁 pcntl_fork, pcntl_wait 两个函数

// 使用方式
// $file = fopen($_SERVER['DOCUMENT_ROOT'] . '/async_lock.txt','w+');
// if(! flock($file, LOCK_EX|LOCK_NB)){
//     return "异步进程忙";
// }
// if(flock($file, LOCK_EX)) {
//     AsyncRuner::getInstance()->run(function() use ($file) {
//         $i = 0;
//         while ($i < 5) {
//             $this->logger->info("{$i}");
//             \sleep(2);
//             $i++;
//         }
//         flock($file, LOCK_UN); //解锁
//         fclose($file);
//     });
// }

class AsyncRuner
{
    static $instance;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (null == AsyncRuner::$instance) {
          AsyncRuner::$instance = new AsyncRuner();
        }
        return AsyncRuner::$instance;
    }

    public function run(callable $func)
    {
        $pid = pcntl_fork();
        if($pid > 0) {
            pcntl_wait($status);
        } elseif ($pid == 0) {
            $cid = pcntl_fork();
            if ($cid === 0) {
                $func();
            } else {
                exit();
            }
        } else {
            exit();
        }
    }
}

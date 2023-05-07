<?php
declare(strict_types=1);

namespace App\Controller;

use PhpRest2\Controller\Attribute\{Controller, Action, Summary};
use PhpRest2\Event\EventTrigger;

#[Controller('/event')]
class EventController
{
    /***************************************************************************************
     * 事件传参
     **************************************************************************************/
    #[Action('GET:/demo1')]
    #[Summary('事件传参')]
    public function demo1()
    {
        $params = ['user' => ['name' => 'nij', 'age' => 12]];
        EventTrigger::on('SomeThingDelete', $params);
        return 'event.somethingDelete';
    }

    /***************************************************************************************
     * 触发多个事件
     **************************************************************************************/
    #[Action('GET:/demo2')]
    #[Summary('触发多个事件')]
    public function demo2()
    {
        EventTrigger::on('UserEventA');
        EventTrigger::on('UserEventB');
        return 'event.userEvent';
    }

    /***************************************************************************************
     * 异步事件处理
     **************************************************************************************/
    #[Action('GET:/demo3')]
    #[Summary('异步事件处理')]
    public function demo3()
    {
        EventTrigger::on('AsyncEvent');
        return 'event.AsyncEvent';
    }
}

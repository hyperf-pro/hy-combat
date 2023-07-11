<?php

declare(strict_types=1);
/**
 * This file is part of hy.
 *
 * @link     https://www.yy.io
 * @document https://yy.wiki
 * @contact  group@yy.io
 * @license  https://github.com/yyforeveryl
 */
namespace App\Amqp\Consumer;

use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Amqp\Result;
use PhpAmqpLib\Message\AMQPMessage;

#[Consumer(exchange: 'debug-ex1', routingKey: 'debug-routing1', queue: 'debug-queue1', name: 'DebugConsumer', nums: 1)]
class DebugConsumer extends ConsumerMessage
{
    public function consumeMessage($data, AMQPMessage $message): string
    {
        var_dump('general consume');
        return Result::ACK;
    }
}

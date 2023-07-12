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
use Hyperf\Amqp\Message\Type;
use Hyperf\Amqp\Result;
use PhpAmqpLib\Message\AMQPMessage;

#[Consumer(routingKey: 'back-routing1', queue: 'back-queue1', name: 'BackExConsumer', nums: 1, enable: true)]
class BackExConsumer extends ConsumerMessage
{
    protected string $type = Type::FANOUT;

    protected string $exchange = 'back-ex1';

    public function consumeMessage($data, AMQPMessage $message): string
    {
        var_dump('back consume:', $data);
        return Result::ACK;
    }
}

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

#[Consumer(queue: 'dead-queue1', name: 'DeadConsumer', nums: 1, enable: true)]
class DeadConsumer extends ConsumerMessage
{

    protected string $exchange = 'dead-ex1';

    protected array|string $routingKey = 'dead-routing1';

    protected string $type = Type::DIRECT;

    public function consumeMessage($data, AMQPMessage $message): string
    {
        var_dump('dead consume:' . microtime(true), $data);
        return Result::ACK;
    }

}

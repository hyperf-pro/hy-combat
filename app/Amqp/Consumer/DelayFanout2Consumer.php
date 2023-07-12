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
use Hyperf\Amqp\Message\ConsumerDelayedMessageTrait;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Amqp\Message\ProducerDelayedMessageTrait;
use Hyperf\Amqp\Message\Type;
use Hyperf\Amqp\Result;
use PhpAmqpLib\Message\AMQPMessage;

#[Consumer(name: 'DelayFanout2Consumer', nums: 1, enable: false)]
class DelayFanout2Consumer extends ConsumerMessage
{
    use ProducerDelayedMessageTrait;
    use ConsumerDelayedMessageTrait;

    protected string $exchange = 'delay.exchange.f';

    protected ?string $queue = 'delay.queue.f2';

    protected string $type = Type::FANOUT;

    protected string|array $routingKey = 'delay.routingkey.f';

    public function consumeMessage($data, AMQPMessage $message): string
    {
        var_dump($data, 'delay+fanout2 consumeTime:' . microtime(true));
        return Result::ACK;
    }
}

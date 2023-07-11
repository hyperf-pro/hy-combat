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

#[Consumer(name: 'DelayFanout1Consumer', nums: 1)]
class DelayFanout1Consumer extends ConsumerMessage
{
    use ProducerDelayedMessageTrait;
    use ConsumerDelayedMessageTrait;

    protected string $exchange = 'delay.exchange.f';

    protected ?string $queue = 'delay.queue.f1';

    //    protected ?array $qos = [
    //        'prefetch_size' => 0,  // 最大unacked消息的字节数
    //        'prefetch_count' => 1,  // 最大unacked消息的条数
    //        'global' => false,  // 上述限制的限定对象，false=限制单个消费者；true=限制整个信道
    //    ];

    protected string $type = Type::FANOUT;

    protected string|array $routingKey = 'delay.routingkey.f';

    public function consumeMessage($data, AMQPMessage $message): string
    {
        var_dump($data, 'delay+fanout1 consumeTime:' . microtime(true));
        return Result::ACK;
    }
}

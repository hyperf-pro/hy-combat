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

use App\Amqp\Trait\CusQueueTrait;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Amqp\Message\Type;
use Hyperf\Amqp\Result;
use PhpAmqpLib\Message\AMQPMessage;

use function Hyperf\Support\make;

#[Consumer(exchange: 'debug-dead-ex1', routingKey: 'debug-dead-routing1', queue: 'debug-dead-queue1', name: 'DebugDeadConsumer', nums: 1, enable: false)]
class DebugDeadConsumer extends ConsumerMessage
{
    use CusQueueTrait;

    protected string $type = Type::DIRECT;

    public function consumeMessage($data, AMQPMessage $message): string
    {
        var_dump('debug dead consume', $data);
        return Result::ACK;
    }

    public function getArguments(): array
    {
        $deadConsumer = make(DeadConsumer::class);
        return [
            'x-dead-letter-exchange' => $deadConsumer->getExchange(),
            'x-dead-letter-routing-key' => $deadConsumer->getRoutingKey(),
        ];
    }
}

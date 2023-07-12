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

use App\Amqp\Trait\CusExTrait;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Amqp\Message\Type;
use Hyperf\Amqp\Result;
use PhpAmqpLib\Message\AMQPMessage;

use function Hyperf\Support\make;

#[Consumer(exchange: 'confirm-ex1', routingKey: 'confirm-routing1', queue: 'confirm-queue1', name: 'ConfirmConsumer', nums: 1, enable: true)]
class ConfirmConsumer extends ConsumerMessage
{
    use CusExTrait;

    protected string $type = Type::DIRECT;

    public function consumeMessage($data, AMQPMessage $message): string
    {
        var_dump('confirm consume', $data);
        return Result::ACK;
    }

    public function getAlternateExchange(): string
    {
        return make(BackExConsumer::class)->getExchange();
    }
}

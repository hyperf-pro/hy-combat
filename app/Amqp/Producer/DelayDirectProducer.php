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
namespace App\Amqp\Producer;

use Hyperf\Amqp\Annotation\Producer;
use Hyperf\Amqp\Message\ProducerDelayedMessageTrait;
use Hyperf\Amqp\Message\ProducerMessage;
use Hyperf\Amqp\Message\Type;

#[Producer]
class DelayDirectProducer extends ProducerMessage
{
    use ProducerDelayedMessageTrait;

    protected string $exchange = 'delay.exchange';

    protected string $type = Type::DIRECT;

    protected string|array $routingKey = 'delay.routingkey';

    public function __construct($data)
    {
        $this->payload = $data;
    }
}

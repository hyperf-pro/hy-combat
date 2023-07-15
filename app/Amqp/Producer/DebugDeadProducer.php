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
use Hyperf\Amqp\Constants;
use Hyperf\Amqp\Message\ProducerMessage;

#[Producer(exchange: 'debug-dead-ex1', routingKey: 'debug-dead-routing1')]
class DebugDeadProducer extends ProducerMessage
{
    public function __construct($data, array $properties = [])
    {
        $this->payload = $data;
        $this->properties = $properties + [
            'content_type' => 'text/plain',
            'delivery_mode' => Constants::DELIVERY_MODE_PERSISTENT, // 持久化message
        ];
    }
}

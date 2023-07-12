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
use Hyperf\Amqp\Message\ProducerMessage;
use Hyperf\Amqp\Message\Type;

#[Producer(exchange: 'confirm-ex1', routingKey: 'confirm-routing1')]
class ConfirmProducer extends ProducerMessage
{

    protected string $type = Type::DIRECT;
    public function __construct($data)
    {
        $this->payload = $data;
    }
}

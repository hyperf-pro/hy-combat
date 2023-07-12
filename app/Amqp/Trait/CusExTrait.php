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

namespace App\Amqp\Trait;

use Hyperf\Amqp\Builder\ExchangeBuilder;
use PhpAmqpLib\Wire\AMQPTable;

/**
 * @method string getExchange()
 * @method string getAlternateExchange()
 */
trait CusExTrait
{
    public function getExchangeBuilder(): ExchangeBuilder
    {
        return (new ExchangeBuilder())->setExchange($this->getExchange())
            ->setType($this->getType())
            ->setArguments(new AMQPTable(['alternate-exchange' => $this->getAlternateExchange()]));
    }
}

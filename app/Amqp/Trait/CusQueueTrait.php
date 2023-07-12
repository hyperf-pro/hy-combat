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

use Hyperf\Amqp\Builder\QueueBuilder;
use PhpAmqpLib\Wire\AMQPTable;

/**
 * @method array getArguments()
 */
trait CusQueueTrait
{
    public function getQueueBuilder(): QueueBuilder
    {
        return (new QueueBuilder())
            ->setQueue($this->getQueue())
            ->setArguments(new AMQPTable($this->getArguments()));
    }
}

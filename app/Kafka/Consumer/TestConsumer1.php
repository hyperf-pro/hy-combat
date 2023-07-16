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
namespace App\Kafka\Consumer;

use Hyperf\Kafka\AbstractConsumer;
use Hyperf\Kafka\Annotation\Consumer;
use longlang\phpkafka\Consumer\ConsumeMessage;

/**
 * autoCommit 默认值为 true，消费者会自动周期性地向服务器提交偏移量.
 */
#[Consumer(topic: 'test1', groupId: 'test1', autoCommit: true, nums: 1, enable: true)]
class TestConsumer1 extends AbstractConsumer
{
    public string $name = 'TestConsumer1';

    public ?string $groupInstanceId = 'TestConsumer1';

    public function consume(ConsumeMessage $message)
    {
        echo sprintf(
            'TestConsumer1: topic:%s,key:%s,value:%s,partition:%s,time:%s',
            $message->getTopic(),
            $message->getKey(),
            $message->getValue(),
            $message->getPartition(),
            microtime(true),
        ) . PHP_EOL;
    }
}

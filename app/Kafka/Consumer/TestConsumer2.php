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

#[Consumer(topic: 'test1', groupId: 'test1', autoCommit: true, nums: 1, enable: true)]
class TestConsumer2 extends AbstractConsumer
{
    public string $name = 'TestConsumer2';

    public ?string $groupInstanceId = 'TestConsumer2';

    public function consume(ConsumeMessage $message)
    {
        echo sprintf(
            'TestConsumer2: topic:%s,key:%s,value:%s,partition:%s,time:%s',
            $message->getTopic(),
            $message->getKey(),
            $message->getValue(),
            $message->getPartition(),
            microtime(true),
        ) . PHP_EOL;
    }
}

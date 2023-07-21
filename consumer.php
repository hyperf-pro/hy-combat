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
require_once './vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

header('Content-Type: text/html; charset=utf-8');

try {
    $routingKey = 'debug-routing1';

    // 连接
    $connection = new AMQPStreamConnection('127.0.0.1', 5672, 'admin', 123456, '/', true);
    $channel = $connection->channel();

    // 定义交换机
    $channel->exchange_declare('debug-ex1', 'topic', false, true, false);
    // 定义队列 - 1
    $channel->queue_declare('debug-queue1', false, true, false, false, false);

    // 消费消息
    $callback = function (AMQPMessage $msg) {
        print_r('>receive the message:' . $msg->body . "\n");
//        $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        $msg->nack(false);
    };

    // 消费消息时设置 no_ack=false
    $channel->basic_consume('debug-queue1', '', false, false, false, false, $callback);

    print_r("consuming...\n");
    while ($channel->is_consuming()) {
        $channel->wait();
    }

    $channel->close();
    $connection->close();
} catch (\Exception $exception) {
    echo '异常信息' . $exception->getMessage();
}

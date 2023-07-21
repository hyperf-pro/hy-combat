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
    // 绑定
    $channel->queue_bind('debug-queue1', 'debug-ex1', $routingKey);

    // 开启发布确认
    $channel->confirm_select();
    // 成功到达交换机时执行
    $channel->set_ack_handler(function (AMQPMessage $msg) {
        echo '入队成功逻辑' . PHP_EOL;
    });
    // nack,rabbitMQ内部错误时触发
    $channel->set_nack_handler(function (AMQPMessage $msg) {
        echo 'nack' . PHP_EOL;
    });
    // 消息到达交换机,但是没有进入合适的队列,消息回退
    $channel->set_return_listener(function (
        $reply_code,
        $reply_text,
        $exchange,
        $routing_key,
        AMQPMessage $msg
    ) use (
        $channel,
        $connection
    ) {
        echo '消息退回,入队失败逻辑' . PHP_EOL;
        $channel->close();
        $connection->close();
        exit;
    });

    // 定义消息并发送
    $message = new AMQPMessage('hello world');
    $channel->basic_publish($message, 'debug-ex1', $routingKey, true);

    // 等待server确认
    $channel->wait_for_pending_acks_returns();

    $channel->close();
    $connection->close();
} catch (\Exception $exception) {
    echo '异常信息' . $exception->getMessage();
}

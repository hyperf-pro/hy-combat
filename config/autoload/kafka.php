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
use Hyperf\Kafka\Constants\KafkaStrategy;

return [
    'default' => [
        'enable' => true,
        'connect_timeout' => -1,
        'send_timeout' => -1,
        'recv_timeout' => -1,
        'client_id' => '',
        'max_write_attempts' => 3,
        'bootstrap_servers' => [
            '127.0.0.1:9092', '127.0.0.1:9093',
        ],
        'acks' => -1,
        'producer_id' => -1,
        'producer_epoch' => -1,
        'partition_leader_epoch' => -1,
        'interval' => 0,
        'session_timeout' => 60,  // 如果超时后没有收到心跳信号，则协调器会认为该用户死亡。（单位：秒，支持小数）
        'rebalance_timeout' => 60,
        'replica_id' => -1,
        'rack_id' => '',
        'group_retry' => 5,
        'group_retry_sleep' => 1,
        'group_heartbeat' => 3,
        'offset_retry' => 5,
        'auto_create_topic' => true,
        'partition_assignment_strategy' => KafkaStrategy::RANGE_ASSIGNOR,
        'sasl' => [],
        'ssl' => [],
        'client' => \longlang\phpkafka\Client\SwooleClient::class,
        'socket' => \longlang\phpkafka\Socket\SwooleSocket::class,
        'timer' => \longlang\phpkafka\Timer\SwooleTimer::class,
        'consume_timeout' => 600,
        'pool' => [
            'min_connections' => 1,
            'max_connections' => 10,
            'connect_timeout' => 10.0,
            'wait_timeout' => 3.0,
            'heartbeat' => -1,
            'max_idle_time' => 60.0,
        ],
    ],
];

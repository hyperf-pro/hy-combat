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
namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\Kafka\Producer;

#[Controller(prefix: 'kafka')]
class KafkaController extends AbstractController
{
    #[Inject]
    protected Producer $producer;

    #[GetMapping(path: 'index')]
    public function index()
    {
        $this->producer->send('test1', '1111111111111:' . microtime(true), '', [], 0);
        return $this->response->success();
    }
}

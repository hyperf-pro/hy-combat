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

use App\Amqp\Producer\ConfirmProducer;
use App\Amqp\Producer\DebugProducer;
use App\Amqp\Producer\DelayDirectProducer;
use App\Amqp\Producer\DelayFanoutProducer;
use Hyperf\Amqp\Producer;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Psr\Http\Message\ResponseInterface;
use Throwable;

#[Controller(prefix: 'amqp')]
class AmqpController extends AbstractController
{
    /**
     * @throws Throwable
     */
    #[GetMapping(path: 'index')]
    public function index(): ResponseInterface
    {
        $res = di()->get(Producer::class)->produce(new DebugProducer(['id' => 1]), true);
        var_dump(21111111111, $res);

        return $this->response->success();
    }

    /**
     * @throws Throwable
     */
    #[GetMapping(path: 'back-exchange')]
    public function backExchange(): ResponseInterface
    {
        $res = di()->get(Producer::class)->produce(new ConfirmProducer(['id' => 1475555]));
        //        var_dump('back exchange res:', $res);

        return $this->response->success();
    }

    /**
     * @throws Throwable
     */
    #[GetMapping(path: 'delay-direct')]
    public function delayDirect(): ResponseInterface
    {
        //        $message1 = new DelayDirectProducer('delay+direct1 produceTime:' . microtime(true));
        //        $message1->setDelayMs(3000);
        //        $res = di()->get(Producer::class)->produce($message1);

        $message2 = new DelayDirectProducer('delay+direct2 produceTime:' . microtime(true));
        $message2->setDelayMs(2000);
        $res = di()->get(Producer::class)->produce($message2);

        return $this->response->success();
    }

    /**
     * @throws Throwable
     */
    #[GetMapping(path: 'delay-fanout')]
    public function delayFanout(): ResponseInterface
    {
        $message2 = new DelayFanoutProducer('delay+fanout1 produceTime:' . microtime(true));
        $message2->setDelayMs(2000);
        $res = di()->get(Producer::class)->produce($message2);

        return $this->response->success();
    }
}

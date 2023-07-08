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
namespace App\Controller\Debug;

use App\Controller\AbstractController;
use App\Service\Debug\CallService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Psr\Http\Message\ResponseInterface;

#[Controller(prefix: 'call')]
class CallController extends AbstractController
{
    #[Inject]
    protected CallService $callService;

    #[GetMapping(path: 'index')]
    public function index(): ResponseInterface
    {
        //        $a = [4, 5, 6];
        //        $this->callService->test(...$a);  // 4

        //        $this->callService->test(1, 2);

        $this->callService->setIp('0.0.0.0');
        echo $this->callService->getIp() . PHP_EOL;
        //        var_dump(CallService::getConfig());

        return $this->response->success();
    }
}

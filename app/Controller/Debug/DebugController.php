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
use App\Service\Debug\DebugService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Psr\Http\Message\ResponseInterface;

#[Controller(prefix: 'debug')]
class DebugController extends AbstractController
{
    #[Inject]
    protected DebugService $debugService;

    #[GetMapping(path: 'index')]
    public function index(): ResponseInterface
    {
        $this->debugService->test();

        return $this->response->success();
    }
}

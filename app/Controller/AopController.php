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

use App\Service\Aop\Aop2Service;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;

#[Controller(prefix: 'aop')]
class AopController extends AbstractController
{
    #[Inject]
    protected Aop2Service $aop2Service;

    #[GetMapping(path: 'index')]
    public function index()
    {
        $this->aop2Service->index(1, 2);
        //         $res = $this->aop2Service->test1();
        //        $res(1,2)();

        $a = '01';
        $b = [];

        $a && $b[] = 1;

        return $this->response->success([
            'use_memory' => memory_get_usage(),
        ]);
    }
}

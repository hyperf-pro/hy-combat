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

class IndexController extends AbstractController
{
    public function index()
    {
        return [
            'use_memory' => memory_get_usage(),
        ];
    }
}

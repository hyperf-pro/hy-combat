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

namespace App\Service\Aop;

use Illuminate\Pipeline\Pipeline;

class Aop2Service
{

    public function index($aa, $b)
    {
        var_dump(66666666666666666);
        $i = 0;
        for ($i = 0; $i < 10; ++$i) {
            ++$i;
        }
        return [
            11,
            22,
        ];
    }

    public function test()
    {
        $pipes = [
            function ($poster, $callback) {
                ++$poster;
                return $callback($poster);
            },
            function ($poster, $callback) {
                $result = $callback($poster);

                return $result - 1;
            },
            function ($poster, $callback) {
                $poster += 2;

                return $callback($poster);
            },
        ];

        $pipeline = new Pipeline();
        $res = $pipeline->send(0)->through($pipes)->then(function ($poster) {
            return $poster + 1;
        });
        echo $res;
    }


    public function test1()
    {
        return function ($a, $b) {
            return function ($c) use ($a, $b) {
                var_dump($a + $b + $c);
            };
        };
    }
}

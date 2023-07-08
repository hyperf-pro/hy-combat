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
namespace App\Aspect;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Service\Aop\Aop2Service;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;

#[Aspect]
class DebugAspect extends AbstractAspect
{
    // 要切入的类或 Trait，可以多个，亦可通过 :: 标识到具体的某个方法，通过 * 可以模糊匹配
    public array $classes = [
        Aop2Service::class . '::index',
    ];

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        // 切面切入后，执行对应的方法会由此来负责
        // $proceedingJoinPoint 为连接点，通过该类的 process() 方法调用原方法并获得结果
        //        $params = $proceedingJoinPoint->getArguments();
        //        if (! isset($params['cc'])) {
        //            throw new BusinessException(ErrorCode::SERVER_ERROR, '参数错误!');
        //        }
        // 在调用前进行某些处理
        return $proceedingJoinPoint->process();
        // 在调用后进行某些处理
    }
}

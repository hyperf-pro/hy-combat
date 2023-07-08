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
namespace App\Service\Debug;

use InvalidArgumentException;

/**
 * @method CallService setIp(string $ip)
 * @method CallService setPort(int $port)
 * @method string getIp()
 * @method int getPort()
 * @method static array getConfig()
 */
class CallService
{
    public function __construct(protected array $config = [])
    {
    }

    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    public function __get($name)
    {
        if (! $this->isAvailableProperty($name)) {
            throw new InvalidArgumentException(sprintf('Invalid property %s', $name));
        }
        return $this->config[$name] ?? $this->config;
    }

    public function __call(string $name, array $arguments)
    {
        if (method_exists($this, $name)) {
            return $this->{$name}($arguments);
        }

        $prefix = strtolower(substr($name, 0, 3));
        if (in_array($prefix, [
            'set',
            'get',
        ])) {
            $propertyName = strtolower(substr($name, 3));
            if (! $this->isAvailableProperty($propertyName)) {
                throw new InvalidArgumentException(sprintf('Invalid property %s', $propertyName));
            }
            return $prefix === 'set' ? $this->set($propertyName, ...$arguments) : $this->__get($propertyName);
        }

        throw new InvalidArgumentException(sprintf('Invalid method %s', $name));
    }

    public static function __callStatic($name, $arguments)
    {
        return (new self())->{$name}($arguments);
    }

    protected function set($name, $value): self
    {
        if (! $this->isAvailableProperty($name)) {
            throw new InvalidArgumentException(sprintf('Invalid property %s', $name));
        }
        $this->config[$name] = $value;
        return $this;
    }

    private function isAvailableProperty(string $name): bool
    {
        return in_array($name, [
            'ip',
            'port',
            'user',
            'password',
            'config',
        ]);
    }

    private function test($a): void
    {
        var_dump($a);
    }
}

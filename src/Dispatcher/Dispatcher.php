<?php
declare(strict_types=1);
/**
 * This file is part of Spark Framework.
 *
 * @link     https://github.com/spark-php/framework
 * @document https://github.com/spark-php/framework
 * @contact  itwujunze@gmail.com
 * @license  https://github.com/spark-php/framework
 */

namespace Spark\Framework\Dispatcher;

use Closure;
use Psr\Http\Message\ServerRequestInterface;
use Spark\Framework\Interfaces\Dispatcher\DispatcherInterface;
use Spark\Framework\Router\Route;
use Spark\Framework\Exceptions\DispatcherException;
use Spark\Framework\Interfaces\Di\ContainerInterface;

/**
 * Class Dispatcher
 * @package Spark\Framework\Dispatcher
 */
class Dispatcher implements DispatcherInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Dispatcher constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param Route $route
     * @param ServerRequestInterface $request
     * @return array|callable|Closure|mixed|null|string
     * @throws DispatcherException
     * @throws \Spark\Framework\Exceptions\ContainerException
     */
    public function dispatch(Route $route, ServerRequestInterface $request)
    {
        $this->assertHasTarget($route);
        $target = $route->getTarget();

        $callback = null;
        if (is_string($target) and class_exists($target, true)) {
            $pathComponents = explode('/', $request->getUri()->getPath());
            $lastComponent = array_pop($pathComponents);
            //尝试从容器中获取对象
            $obj = $this->container->getByType($target);
            $callback = [$obj, $lastComponent];
        } elseif (is_callable($target) and is_array($target) and count($target) == 2) {
            $class = array_shift($target);
            $method = array_shift($target);

            if (is_object($class)) {
                $callback = [$class, $method];
            } else {
                //尝试从容器中获取对象
                $obj = $this->container->getByType($class);
                $callback = [$obj, $method];
            }
        } elseif ($target instanceof Closure) {
            $callback = $target;
        } else {
            throw new DispatcherException(sprintf('匹配的路由规则 %s 的路由目标无效', $route->getUrlRule()));
        }

        return $callback;
    }

    /**
     * @param Route $route
     * @throws DispatcherException
     */
    private function assertHasTarget(Route $route)
    {
        if (!$route->hasTarget()) {
            throw new DispatcherException('匹配的路由规则没有路由目标');
        }
    }
}

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

namespace Spark\Framework\Provider;

use Spark\Framework\Interfaces\Provider\ContainerProviderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spark\Framework\Common\Environment;
use Spark\Framework\Di\ElementDefinition;
use Spark\Framework\Dispatcher\Dispatcher;
use Spark\Framework\Http\Headers;
use Spark\Framework\Http\Request;
use Spark\Framework\Http\Response;
use Spark\Framework\Interfaces\Di\ContainerInterface;
use Spark\Framework\Interfaces\Dispatcher\DispatcherInterface;
use Spark\Framework\Interfaces\Router\RouterInterface;
use Spark\Framework\Router\Router;

/**
 * 框架默认的容器Provider
 *
 */
class ContainerProvider implements ContainerProviderInterface
{
    /**
     * 容器初始化Provider
     *
     * @param ContainerInterface $container
     * @throws \Spark\Framework\Exceptions\ContainerException
     */
    public function setupContainer(ContainerInterface $container)
    {
        $container->set(
          (new ElementDefinition())
            ->setType(Environment::class)
            ->setBuilder(function () {
                return new Environment($_SERVER);
            })
            ->setSingletonScope()
            ->setAlias('environment')
        );
        $container->set(
          (new ElementDefinition())
            ->setType(ServerRequestInterface::class)
            ->setBuilder(function (Environment $environment) {
                return Request::createFromEnvironment($environment);
            })
            ->setSingletonScope()
            ->setAlias('request')
        );
        $container->set(
          (new ElementDefinition())
            ->setType(ResponseInterface::class)
            ->setBuilder(function () {
                $headers = new Headers(['Content-Type' => 'text/html; charset=UTF-8']);
                $response = new Response(200, $headers);
                return $response;
            })
            ->setSingletonScope()
            ->setAlias('response')
        );
        $container->set(
          (new ElementDefinition())
            ->setType(RouterInterface::class)
            ->setBuilder(function () {
                return new Router();
            })
            ->setSingletonScope()
            ->setAlias('router')
        );
        $container->set(
          (new ElementDefinition())
            ->setType(DispatcherInterface::class)
            ->setBuilder(function (ContainerInterface $container) {
                return new Dispatcher($container);
            })
            ->setSingletonScope()
            ->setAlias('dispatcher')
        );
    }
}

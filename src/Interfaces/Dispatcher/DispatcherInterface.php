<?php
/**
 * This file is part of Spark Framework.
 *
 * @link     https://github.com/spark-php/framework
 * @document https://github.com/spark-php/framework
 * @contact  itwujunze@gmail.com
 * @license  https://github.com/spark-php/framework
 */

namespace Spark\Framework\Interfaces\Dispatcher;

use Psr\Http\Message\ServerRequestInterface;
use Spark\Framework\Router\Route;

/**
 * Interface DispatcherInterface
 * @package Spark\Framework\Interfaces\Dispatcher
 */
interface DispatcherInterface
{
    /**
     * @param Route $route
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function dispatch(Route $route, ServerRequestInterface $request);
}

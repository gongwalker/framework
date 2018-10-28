<?php
/**
 * Created by PhpStorm.
 * User: wujunze
 * Date: 2018/10/28
 * Time: 3:56 PM
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
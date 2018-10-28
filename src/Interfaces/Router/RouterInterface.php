<?php
/**
 * This file is part of Spark Framework.
 *
 * @link     https://github.com/spark-php/framework
 * @document https://github.com/spark-php/framework
 * @contact  itwujunze@gmail.com
 * @license  https://github.com/spark-php/framework
 */

namespace Spark\Framework\Interfaces\Router;

use Spark\Framework\exceptions\RouterException;
use Spark\Framework\router\Route;

interface RouterInterface
{
    /**
     * 添加一个路由规则
     * @param Route $route
     * @throws RouterException
     */
    public function addRoute(Route $route);

    /**
     * 解析一个 URL, 返回路由规则
     *
     * @param string $method 请求方法
     * @param string $url URL
     * @return Route
     * @throws RouterException
     */
    public function resolve($method, $url);

    /**
     * 根据路由规则名称和参数返回路径 (可用于 URL 生成)
     *
     * @param string $name
     * @param array|null $parts
     * @return string
     */
    public function generatePath($name, array $parts = []);
}

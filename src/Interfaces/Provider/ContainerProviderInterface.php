<?php
/**
 * Created by PhpStorm.
 * User: wujunze
 * Date: 2018/10/28
 * Time: 4:08 PM
 */

namespace Spark\Framework\Interfaces\Provider;


use Spark\Framework\Interfaces\Di\ContainerInterface;

interface ContainerProviderInterface
{
    /**
     * 容器初始化Provider
     *
     * @param ContainerInterface $container
     */
    public function setupContainer(ContainerInterface $container);
}
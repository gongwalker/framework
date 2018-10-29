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

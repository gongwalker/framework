<?php
/**
 * This file is part of Spark Framework.
 *
 * @link     https://github.com/spark-php/framework
 * @document https://github.com/spark-php/framework
 * @contact  itwujunze@gmail.com
 * @license  https://github.com/spark-php/framework
 */

namespace Spark\Framework\Interfaces\Http;

use Spark\Framework\Interfaces\Helper\MapInterface;

/**
 * Interface HeadersInterface
 * @package Spark\Framework\Interfaces\Http
 */
interface HeadersInterface extends MapInterface
{
    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function add($key, $value);

    /**
     * @param $key
     * @return mixed
     */
    public function normalizeKey($key);
}

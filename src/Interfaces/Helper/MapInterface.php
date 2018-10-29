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

namespace Spark\Framework\Interfaces\Helper;

use ArrayAccess;

/**
 * Interface MapInterface
 * @package Spark\Framework\Interfaces\Helper
 */
interface MapInterface extends ArrayAccess
{
    /**
     * @param $key
     * @param null $defaultValue
     * @return mixed
     */
    public function get($key, $defaultValue = null);

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @return mixed
     */
    public function keys();

    /**
     * @param $key
     * @return mixed
     */
    public function has($key);

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value);

    /**
     * @param $key
     * @return mixed
     */
    public function remove($key);

    /**
     * @return mixed
     */
    public function clear();
}

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

/**
 * Interface CookiesInterface
 * @package Spark\Framework\Interfaces\Http
 */
interface CookiesInterface
{
    /**
     * @param $name
     * @param null $default
     * @return mixed
     */
    public function get($name, $default = null);

    /**
     * @param $name
     * @param $value
     * @return mixed
     */
    public function set($name, $value);

    /**
     * @return mixed
     */
    public function toHeaders();

    /**
     * @param $header
     * @return mixed
     */
    public static function parseHeader($header);
}

<?php
/**
 * Created by PhpStorm.
 * User: wujunze
 * Date: 2018/10/28
 * Time: 8:35 AM
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
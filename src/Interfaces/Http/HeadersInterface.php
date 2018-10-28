<?php
/**
 * Created by PhpStorm.
 * User: wujunze
 * Date: 2018/10/28
 * Time: 8:43 AM
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
<?php
/**
 * This file is part of Spark Framework.
 *
 * @link     https://github.com/spark-php/framework
 * @document https://github.com/spark-php/framework
 * @contact  itwujunze@gmail.com
 * @license  https://github.com/spark-php/framework
 */

namespace Spark\Framework\Helper;

use Spark\Framework\Interfaces\Helper\MapInterface;

/**
 * Class Map
 * @package Spark\Framework\Helper
 */
class Map implements MapInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * Map constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @param $key
     * @param null $defaultValue
     * @return mixed|null
     */
    public function get($key, $defaultValue = null)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        } else {
            return $defaultValue;
        }
    }

    /**
     * @return array|mixed
     */
    public function getAll()
    {
        return $this->data;
    }

    /**
     * @return array|mixed
     */
    public function keys()
    {
        return array_keys($this->data);
    }

    /**
     * @param $key
     * @return bool|mixed
     */
    public function has($key)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed|void
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed|void
     */
    public function remove($key)
    {
        unset($this->data[$key]);
    }

    /**
     * @return mixed|void
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * @param mixed $offset
     * @return bool|mixed
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }
}

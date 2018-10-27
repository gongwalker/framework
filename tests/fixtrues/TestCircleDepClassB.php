<?php
/**
 * Created by PhpStorm.
 * User: wujunze
 * Date: 2018/10/27
 * Time: 7:58 PM
 */

namespace Spark\Framework\Tests\fixtrues;


class TestCircleDepClassB
{
    public function __construct(TestCircleDepClassC $a)
    {
    }
}
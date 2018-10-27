<?php
/**
 * Created by PhpStorm.
 * User: wujunze
 * Date: 2018/10/27
 * Time: 7:58 PM
 */

namespace Spark\Framework\Tests\fixtrues;


class TestCircleDepClassC
{
    public function __construct(TestCircleDepClassA $a)
    {
    }
}
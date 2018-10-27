<?php
/**
 * Created by PhpStorm.
 * User: wujunze
 * Date: 2018/10/27
 * Time: 7:57 PM
 */

namespace Spark\Framework\Tests\fixtrues;


class TestCircleDepClassA
{
    public function __construct(TestCircleDepClassB $a)
    {
    }
}

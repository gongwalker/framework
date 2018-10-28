<?php
/**
 * This file is part of Spark Framework.
 *
 * @link     https://github.com/spark-php/framework
 * @document https://github.com/spark-php/framework
 * @contact  itwujunze@gmail.com
 * @license  https://github.com/spark-php/framework
 */

namespace Spark\Framework\Tests\fixtrues;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spark\Framework\Controller\BaseController;

class AnotherTestController extends BaseController
{
    public function hello(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $response->withJson(['Hello Spark']);
    }
}

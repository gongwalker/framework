<?php
/**
 * This file is part of Spark Framework.
 *
 * @link     https://github.com/spark-php/framework
 * @document https://github.com/spark-php/framework
 * @contact  itwujunze@gmail.com
 * @license  https://github.com/spark-php/framework
 */

namespace Spark\Framework\Exceptions;

use Psr\Http\Message\ServerRequestInterface;

class InvalidMethodException extends \InvalidArgumentException
{
    protected $request;

    public function __construct(ServerRequestInterface $request, $method)
    {
        $this->request = $request;
        parent::__construct(sprintf('Unsupported HTTP method "%s" provided', $method));
    }

    public function getRequest()
    {
        return $this->request;
    }
}

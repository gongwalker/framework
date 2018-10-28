<?php


namespace Spark\Framework\Controller;


use Spark\Framework\Interfaces\Di\ContainerInterface;

abstract class BaseController
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

}
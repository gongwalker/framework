<?php
/**
 * Created by PhpStorm.
 * User: wujunze
 * Date: 2018/10/27
 * Time: 3:57 PM
 */

namespace Spark\Framework\Tests\Di;

use Spark\Framework\Exceptions\ContainerException;
use Spark\Framework\Di\Container;
use Spark\Framework\Di\ElementDefinition;
use Spark\Framework\Interfaces\Di\ContainerInterface;
use Spark\Framework\Tests\fixtrues\TestCircleDepClassA;
use Spark\Framework\Tests\fixtrues\TestCircleDepClassB;
use Spark\Framework\Tests\fixtrues\TestCircleDepClassC;
use Spark\Framework\Tests\fixtrues\TestClassA;
use Spark\Framework\Tests\fixtrues\TestClassB;
use Spark\Framework\Tests\fixtrues\TestClassC;
use Spark\Framework\Tests\TestCase;

/**
 * Class DefaultContainerImplTest
 * @package Smile\Test\DI
 */
class ContainerTest extends TestCase
{
    public static function containerProvider()
    {
        $container = new Container();

        //之所以这里是个二维数组, 是因为phpunit每次都会扫描这里的一个一维数组作为用dataProvider注入的函数
        return [
            [$container]
        ];
    }



    /**
     *
     * 测试命名空间自动组装
     *
     * @dataProvider containerProvider
     * @param ContainerInterface $container
     * @throws ContainerException
     */
    public function testAutoWired(ContainerInterface $container)
    {
        $container->enableAutoWiredForNamespace("Spark\\Framework\\Tests\\fixtrues");
        $object = $container->getByType(TestClassA::class);
        $this->assertInstanceOf(TestClassA::class, $object);
    }


    /**
     * 测试立即初始化
     *
     * @dataProvider containerProvider
     * @param ContainerInterface $container
     * @throws ContainerException
     */
    public function testEagerInit(ContainerInterface $container)
    {
        $container->set(
            (new ElementDefinition())
                ->setType(TestClassB::class)
                ->setEager()
                ->setSingletonScope()
        );

        $object = $container->getByType(TestClassB::class);
        $this->assertInstanceOf(TestClassB::class, $object);

        $this->expectException(ContainerException::class);
        $this->expectExceptionMessageRegExp('/原型作用域不支持立即实例化/');
        $container->set(
            (new ElementDefinition())
                ->setType(TestClassC::class)
                ->setEager()
        );
        $object = $container->getByType(TestClassC::class);
        $this->assertInstanceOf(TestClassB::class, $object);

    }



    /**
     *  测试延迟初始化
     *
     * @dataProvider containerProvider
     * @param ContainerInterface $container
     * @throws ContainerException
     */
    public function testDeferredInit(ContainerInterface $container)
    {
        $container->set(
            (new ElementDefinition())
                ->setType(TestClassB::class)
                ->setDeferred()
        );
        $object = $container->getByType(TestClassB::class);
        $this->assertInstanceOf(TestClassB::class, $object);
    }

    /**
     * 测试原型作用域
     *
     * @dataProvider containerProvider
     * @param ContainerInterface $container
     * @throws ContainerException
     */
    public function testPrototype(ContainerInterface $container)
    {
        $container->set(
            (new ElementDefinition())
                ->setType(TestClassB::class)
                ->setDeferred()
                ->setPrototypeScope()
        );

        $obj1 = $container->getByType(TestClassB::class);
        $obj2 = $container->getByType(TestClassB::class);

        $this->assertNotSame($obj1, $obj2);
    }


    /**
     * 测试单例作用域
     *
     * @dataProvider containerProvider
     * @param ContainerInterface $container
     * @throws ContainerException
     */
    public function testSingleton(ContainerInterface $container)
    {
        $container->set(
            (new ElementDefinition())
                ->setType(TestClassB::class)
                ->setDeferred()
                ->setSingletonScope()
        );

        $obj1 = $container->getByType(TestClassB::class);
        $obj2 = $container->getByType(TestClassB::class);

        $this->assertSame($obj1, $obj2);
    }


    /**
     * 测试循环引用报错
     *
     * @dataProvider containerProvider
     * @param ContainerInterface $container
     * @throws ContainerException
     */
    public function testCircleDep(ContainerInterface $container)
    {
        $this->expectException(ContainerException::class);
        $this->expectExceptionMessageRegExp('/循环/');
        $container->enableAutoWiredForNamespace("Spark\\Framework\\Tests\\fixtrues");
        $container->getByType(TestCircleDepClassA::class);
    }


    /**
     * 测试别名
     *
     * @dataProvider containerProvider
     * @param ContainerInterface $container
     * @throws ContainerException
     */
    public function testAlias(ContainerInterface $container)
    {
        $container->set(
            (new ElementDefinition())
                ->setType(ElementDefinition::TYPE_ARRAY)
                ->setBuilder(function ($hello, $helloCharCount) {
                    return [$hello, $helloCharCount];
                })
                ->setAlias('helloWorldAndItsLength')
        );

        $container->set(
            (new ElementDefinition())
                ->setType(ElementDefinition::TYPE_STRING)
                ->setInstance('hello, world')
                ->setAlias('hello')
        );

        $container->set(
            (new ElementDefinition())
                ->setType(ElementDefinition::TYPE_INT)
                ->setBuilder(function ($hello) {
                    return strlen($hello);
                })
                ->setAlias('helloCharCount')

        );

        $arrayResult = $container->getByAlias('helloWorldAndItsLength');

        $this->assertEquals(['hello, world', 12], $arrayResult);
    }
}
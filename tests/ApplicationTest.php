<?php



namespace Spark\Framework\Tests;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spark\Framework\Application;
use Spark\Framework\Common\Environment;
use Spark\Framework\Controller\BaseController;
use Spark\Framework\Interfaces\Di\ContainerInterface;
use Spark\Framework\Interfaces\Router\RouterInterface;
use Spark\Framework\Router\Route;

class ApplicationTest extends TestCase
{
    public function initializeProvider()
    {
        return [
            [
                function (ContainerInterface $container) {
                    $container->enableAutowiredForNamespace(__NAMESPACE__);
                },
                function (RouterInterface $router) {
                    $router->addRoute(
                        (new Route)
                            ->put('/{a}[/{b}[/{c}]]')
                            ->setTarget(TestController::class)
                    );
                }
            ],
            [
                function (ContainerInterface $container) {
                    $container->enableAutowiredForNamespace(__NAMESPACE__);
                },
                function (RouterInterface $router) {
                    $router->addRoute(
                        (new Route)
                            ->put('/{a}[/{b}[/{c}]]')
                            ->setTarget([AnotherTestController::class, 'hello'])
                    );
                }
            ]
        ];
    }


    /**
     *
     * @dataProvider initializeProvider
     * @param callable $containerInit
     * @param callable $routerInit
     * @throws \ReflectionException
     * @throws \Spark\Framework\Exceptions\ContainerException
     */
    public function testApplication(callable $containerInit, callable $routerInit)
    {
        $application = new Application($containerInit);
        $this->assertInstanceOf(Application::class, $application);
       // $this->expectOutputString('["abcdefg"]');
        //$this->expectOutputString('["hello"]');
        /** @var Environment $environment */
        $environment = $application->getContainer()->getByAlias('environment');
        $environment->replace([
            'REQUEST_METHOD' => 'PUT',
            'REQUEST_URI' => '/foo/bar/test',
            'QUERY_STRING' => 'abc=123&foo=bar',
            'SERVER_NAME' => 'example.com',
            'CONTENT_TYPE' => 'application/json;charset=utf8',
            'CONTENT_LENGTH' => 15
        ]);
        $application->loadRouterConfig($routerInit);
        $application->run();
    }

}

class TestController extends BaseController
{
    public function test(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $response->withJson(['abcdefg']);
    }
}


class AnotherTestController extends BaseController
{
    public function hello(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $response->withJson(['hello']);
    }
}
<?php
/**
 * This file is part of Spark Framework.
 *
 * @link     https://github.com/spark-php/framework
 * @document https://github.com/spark-php/framework
 * @contact  itwujunze@gmail.com
 * @license  https://github.com/spark-php/framework
 */
namespace Spark\Framework\Tests\Http;

use Spark\Framework\Common\Environment;
use Spark\Framework\Tests\TestCase;

class EnvironmentTest extends TestCase
{
    /**
     * Server settings for the default HTTP request
     * used by this script's tests.
     */
    public function setUp()
    {
        $_SERVER['DOCUMENT_ROOT'] = '/var/www';
        $_SERVER['SCRIPT_NAME'] = '/foo/index.php';
        $_SERVER['REQUEST_URI'] = '/foo/index.php/bar/xyz';
        $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
        $_SERVER['SERVER_NAME'] = 'spark';
        $_SERVER['SERVER_PORT'] = '80';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['QUERY_STRING'] = 'one=1&two=2&three=3';
        $_SERVER['HTTPS'] = '';
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    }

    /**
     * Test environment from globals
     */
    public function testEnvironmentFromGlobals()
    {
        $env = new Environment($_SERVER);

        $this->assertEquals($_SERVER, $env->all());
    }

    /**
     * Test environment from mock data
     */
    public function testMock()
    {
        $env = Environment::mock([
            'SCRIPT_NAME' => '/foo/bar/index.php',
            'REQUEST_URI' => '/foo/bar?abc=123',
        ]);

        $this->assertInstanceOf('Spark\Framework\Interfaces\Helper\CollectionInterface', $env);
        $this->assertInstanceOf('Spark\Framework\Interfaces\Common\EnvironmentInterface', $env);
        $this->assertEquals('/foo/bar/index.php', $env->get('SCRIPT_NAME'));
        $this->assertEquals('/foo/bar?abc=123', $env->get('REQUEST_URI'));
        $this->assertEquals('localhost', $env->get('HTTP_HOST'));
    }

    /**
     * Test environment from mock data with HTTPS
     */
    public function testMockHttps()
    {
        $env = Environment::mock([
            'HTTPS' => 'on'
        ]);

        $this->assertInstanceOf('Spark\Framework\Interfaces\Helper\CollectionInterface', $env);
        $this->assertInstanceOf('Spark\Framework\Interfaces\Common\EnvironmentInterface', $env);
        $this->assertEquals('on', $env->get('HTTPS'));
        $this->assertEquals(443, $env->get('SERVER_PORT'));
    }

    /**
     * Test environment from mock data with REQUEST_SCHEME
     */
    public function testMockRequestScheme()
    {
        $env = Environment::mock([
            'REQUEST_SCHEME' => 'https'
        ]);

        $this->assertInstanceOf('Spark\Framework\Interfaces\Helper\CollectionInterface', $env);
        $this->assertInstanceOf('Spark\Framework\Interfaces\Common\EnvironmentInterface', $env);
        $this->assertEquals('https', $env->get('REQUEST_SCHEME'));
        $this->assertEquals(443, $env->get('SERVER_PORT'));
    }
}

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

use Spark\Framework\Http\Headers;
use Spark\Framework\Tests\Mocks\MessageStub;
use Spark\Framework\Tests\TestCase;

class MessageTest extends TestCase
{
    /*******************************************************************************
     * Protocol
     ******************************************************************************/

    /**
     * @covers \Spark\Framework\Http\Message::getProtocolVersion
     */
    public function testGetProtocolVersion()
    {
        $message = new MessageStub();
        $message->protocolVersion = '1.0';

        $this->assertEquals('1.0', $message->getProtocolVersion());
    }

    /**
     * @covers \Spark\Framework\Http\Message::withProtocolVersion
     */
    public function testWithProtocolVersion()
    {
        $message = new MessageStub();
        $clone = $message->withProtocolVersion('1.0');

        $this->assertEquals('1.0', $clone->protocolVersion);
    }

    /**
     * @covers \Spark\Framework\Http\Message::withProtocolVersion
     * @expectedException \InvalidArgumentException
     */
    public function testWithProtocolVersionInvalidThrowsException()
    {
        $message = new MessageStub();
        $message->withProtocolVersion('3.0');
    }

    /**
     * Ensure that we support HTTP '2'
     *
     * @see https://http2.github.io/faq/#is-it-http20-or-http2
     * @covers \Spark\Framework\Http\Message::withProtocolVersion
     */
    public function testWithProtocolVersionForHttp2()
    {
        $message = new MessageStub();
        $clone = $message->withProtocolVersion('2');

        $this->assertEquals('2', $clone->protocolVersion);
    }

    /*******************************************************************************
     * Headers
     ******************************************************************************/

    /**
     * @covers \Spark\Framework\Http\Message::getHeaders
     */
    public function testGetHeaders()
    {
        $headers = new Headers();
        $headers->add('X-Foo', 'one');
        $headers->add('X-Foo', 'two');
        $headers->add('X-Foo', 'three');

        $message = new MessageStub();
        $message->headers = $headers;

        $shouldBe = [
            'X-Foo' => [
                'one',
                'two',
                'three',
            ],
        ];

        $this->assertEquals($shouldBe, $message->getHeaders());
    }

    /**
     * @covers \Spark\Framework\Http\Message::hasHeader
     */
    public function testHasHeader()
    {
        $headers = new Headers();
        $headers->add('X-Foo', 'one');

        $message = new MessageStub();
        $message->headers = $headers;

        $this->assertTrue($message->hasHeader('X-Foo'));
        $this->assertFalse($message->hasHeader('X-Bar'));
    }

    /**
     * @covers \Spark\Framework\Http\Message::getHeaderLine
     */
    public function testGetHeaderLine()
    {
        $headers = new Headers();
        $headers->add('X-Foo', 'one');
        $headers->add('X-Foo', 'two');
        $headers->add('X-Foo', 'three');

        $message = new MessageStub();
        $message->headers = $headers;

        $this->assertEquals('one,two,three', $message->getHeaderLine('X-Foo'));
        $this->assertEquals('', $message->getHeaderLine('X-Bar'));
    }

    /**
     * @covers \Spark\Framework\Http\Message::getHeader
     */
    public function testGetHeader()
    {
        $headers = new Headers();
        $headers->add('X-Foo', 'one');
        $headers->add('X-Foo', 'two');
        $headers->add('X-Foo', 'three');

        $message = new MessageStub();
        $message->headers = $headers;

        $this->assertEquals(['one', 'two', 'three'], $message->getHeader('X-Foo'));
        $this->assertEquals([], $message->getHeader('X-Bar'));
    }

    /**
     * @covers \Spark\Framework\Http\Message::withHeader
     */
    public function testWithHeader()
    {
        $headers = new Headers();
        $headers->add('X-Foo', 'one');
        $message = new MessageStub();
        $message->headers = $headers;
        $clone = $message->withHeader('X-Foo', 'bar');

        $this->assertEquals('bar', $clone->getHeaderLine('X-Foo'));
    }

    /**
     * @covers \Spark\Framework\Http\Message::withAddedHeader
     */
    public function testWithAddedHeader()
    {
        $headers = new Headers();
        $headers->add('X-Foo', 'one');
        $message = new MessageStub();
        $message->headers = $headers;
        $clone = $message->withAddedHeader('X-Foo', 'two');

        $this->assertEquals('one,two', $clone->getHeaderLine('X-Foo'));
    }

    /**
     * @covers \Spark\Framework\Http\Message::withoutHeader
     */
    public function testWithoutHeader()
    {
        $headers = new Headers();
        $headers->add('X-Foo', 'one');
        $headers->add('X-Bar', 'two');
        $response = new MessageStub();
        $response->headers = $headers;
        $clone = $response->withoutHeader('X-Foo');
        $shouldBe = [
            'X-Bar' => ['two'],
        ];

        $this->assertEquals($shouldBe, $clone->getHeaders());
    }

    /*******************************************************************************
     * Body
     ******************************************************************************/

    /**
     * @covers \Spark\Framework\Http\Message::getBody
     */
    public function testGetBody()
    {
        $body = $this->getBody();
        $message = new MessageStub();
        $message->body = $body;

        $this->assertSame($body, $message->getBody());
    }

    /**
     * @covers \Spark\Framework\Http\Message::withBody
     */
    public function testWithBody()
    {
        $body = $this->getBody();
        $body2 = $this->getBody();
        $message = new MessageStub();
        $message->body = $body;
        $this->expectException('TypeError');
        $clone = $message->withBody($body2);

        $this->assertSame($body, $message->body);
        $this->assertSame($body2, $clone->body);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Spark\Framework\Http\Body
     */
    protected function getBody()
    {
        return $this->getMockBuilder('Spark\Framework\Http')->disableOriginalConstructor()->getMock();
    }
}

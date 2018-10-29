<?php
declare(strict_types=1);
/**
 * This file is part of Spark Framework.
 *
 * @link     https://github.com/spark-php/framework
 * @document https://github.com/spark-php/framework
 * @contact  itwujunze@gmail.com
 * @license  https://github.com/spark-php/framework
 */
namespace Spark\Framework\Http;

/**
 * Body
 *
 * This class represents an HTTP message body and encapsulates a
 * streamable resource according to the PSR-7 standard.
 *
 * 根据 PSR-7 标准
 * 这个类用来将一个 HTTP 的消息体封装成可以流化的 resource 类型
 *
 * @link https://github.com/php-fig/http-message/blob/master/src/StreamInterface.php
 */
class Body extends Stream
{
}

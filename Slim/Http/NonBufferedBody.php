<?php
/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/3.x/LICENSE.md (MIT License)
 */

namespace Slim\Http;

use Psr\Http\Message\StreamInterface;

/**
 * Represents a non-readable stream that whenever it is written pushes
 * the data back to the browser immediately.
 */
class NonBufferedBody implements StreamInterface
{
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function detach()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function getSize()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function tell()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function eof()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function isSeekable()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function seek($offset, $whence = SEEK_SET)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function isWritable()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function write($string)
    {
        $buffered = '';
        while (0 < ob_get_level()) {
            $buffered = ob_get_clean() . $buffered;
        }

        echo $buffered . $string;

        flush();

        return strlen($string) + strlen($buffered);
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function isReadable()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function read($length)
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function getContents()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function getMetadata($key = null)
    {
        return null;
    }
}
